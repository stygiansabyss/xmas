<?php

namespace App\Console\Commands;

use App\Apis\HumbleBundle\Client;
use App\Services\Donating\Events\GoalWasUpdated;
use App\Services\Donating\Events\IncentiveWasUpdated;
use App\Services\Donating\Events\TotalWasChanged;
use App\Services\Donating\Models\Donation;
use App\Services\Donating\Models\Goal;
use App\Services\Donating\Models\Incentive;
use App\Services\Donating\Models\Total;
use App\Services\Raffling\Events\RaffleEntryAdded;
use App\Services\Raffling\Models\Tier;
use App\Services\Voting\Events\VoteWasUpdated;
use App\Services\Voting\Models\Vote;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Snipe\BanBuilder\CensorWords;

class GetDonations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jj:donations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get donations from humble bundle.';

    /**
     * @var \App\Apis\HumbleBundle\Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param \App\Apis\HumbleBundle\Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '128M');

        $censor = $this->setUpCensor();

        $this->storeDonations($censor);

        $this->updateTotal();

        $this->updateGames();
    }

    /**
     * Create the bad word censor.
     *
     * @return \Snipe\BanBuilder\CensorWords
     */
    private function setUpCensor()
    {
        $censor = new CensorWords;
        $censor->setDictionary('en-uk');
        $censor->badwords = config('censor.badwords');

        return $censor;
    }

    /**
     * Save all new donations.
     *
     * @param $censor
     */
    private function storeDonations($censor)
    {
        $donations = $this->client->donations();

        foreach ($donations as $donation) {
            $comment = $censor->censorString($donation['donorComment']);

            $data = [
                'hb_id'         => $donation['id'],
                'name'          => $donation['donorName'],
                'email'         => $donation['email'],
                'amount'        => $donation['donationAmount'],
                'comment'       => Str::limit($comment['clean'], 500),
                'hb_created_at' => (string)Carbon::createFromTimestamp($donation['timestamp']),
            ];

            Donation::create($data);
        }
    }

    /**
     * Store the new total raised from pub nub.
     */
    private function updateTotal()
    {
        $pubNub = $this->client->getTotal();

        $total         = Total::orderBy('id', 'desc')->first();
        $total->raised = $pubNub[0][0]['stats']['rawtotal'];
        $total->save();

        event(new TotalWasChanged($total));
    }

    /**
     * Send events for any active games.
     */
    private function updateGames()
    {
        $activeGoal = Goal::active()->first();

        if ($activeGoal != null) {
            if ($activeGoal->percent == 100) {
                $activeGoal->reached();
            }
            event(new GoalWasUpdated($activeGoal));
        }

        $activeIncentive = Incentive::active()->first();

        if ($activeIncentive != null) {
            event(new IncentiveWasUpdated($activeIncentive));
        }

        $activeTiers = Tier::active()->get();

        if ($activeTiers != null) {
            $raffles = $activeTiers->raffle;

            foreach ($raffles as $raffle) {
                event(new RaffleEntryAdded($raffle));
            }
        }

        $activeVotes = Vote::active()->get();

        if ($activeVotes != null) {
            foreach ($activeVotes as $activeVote) {
                event(new VoteWasUpdated($activeVote));
            }
        }
    }
}
