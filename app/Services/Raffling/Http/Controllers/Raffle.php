<?php

namespace App\Services\Raffling\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Raffling\Events\RaffleApproved;
use App\Services\Raffling\Events\RaffleEntryAdded;
use App\Services\Raffling\Models\Raffle as RaffleModel;
use App\Services\Raffling\Models\Tier;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class Raffle extends BaseController
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    const FINISHED = 2;

    /**
     * @var \App\Services\Raffling\Models\Raffle
     */
    private $raffles;

    /**
     * @var \App\Services\Raffling\Models\Tier
     */
    private $tiers;

    /**
     * Raffle constructor.
     *
     * @param \App\Services\Raffling\Models\Raffle $raffles
     * @param \App\Services\Raffling\Models\Tier   $tiers
     */
    public function __construct(RaffleModel $raffles, Tier $tiers)
    {
        $this->raffles = $raffles;
        $this->tiers   = $tiers;
    }

    public function index()
    {
        $raffles = $this->raffles->orderBy('created_at', 'desc')->paginate(25);

        $this->setViewData(compact('raffles'));

        return $this->view();
    }

    public function create()
    {
        return $this->view();
    }

    public function store()
    {
        $raffle = $this->raffles->generate(request());

        event(new RaffleEntryAdded($raffle));

        return response()->json('success', 200);
    }

    public function edit($id)
    {
        $raffle = $this->raffles->find($id);

        $this->setJavascriptData(compact('raffle'));

        return $this->view();
    }

    public function update($id)
    {
        $raffle = $this->raffles->find($id);

        $raffle->update(['name' => request('name')]);
        $raffle->updateTiers(request('tiers'));
        $raffle->createTiers(request('new_tiers'));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Raffle updated');
    }

    public function status($id, $statusId)
    {
        $raffle = $this->raffles->find($id);
        $raffle->setStatus($statusId);

        if ($statusId == Raffle::FINISHED) {
            // Generate spreadsheet
            $tiers = $raffle->tiers;

            $donationsArray = [];

            foreach ($tiers as $tier) {
                foreach ($tier->winners as $winner) {
                    $data = [
                        'tier'       => $tier->minimum,
                        'reward'     => $tier->reward,
                        'id'         => $winner->hb_id,
                        'name'       => $winner->name,
                        'amount'     => $winner->amount,
                        'email'      => $winner->email,
                        'comment'    => $winner->comment,
                        'created_at' => (string)$winner->hb_created_at,
                    ];

                    $donationsArray[] = $data;
                }
            }

            Excel::create('raffle_winners_' . Str::slug($raffle->name, '_'), function ($excel) use ($donationsArray) {
                $excel->sheet('Donations', function ($sheet) use ($donationsArray) {
                    // Generate the sheet from the DB results.
                    $sheet->fromArray($donationsArray);

                    // Make the header stand out.
                    $sheet->row(1, function ($row) {
                        $row->setBackground('#000000');
                        $row->setFontColor('#ffffff');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                    });
                });
            })->save('xls', public_path('spreadsheets'))->download('xls');
        }

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Raffle updated');
    }

    public function preview($id)
    {
        $tiers = $this->raffles->find($id)->tiers()->whereHas('winners', function ($query) {
            $query->where('status', 1);
        })->get();

        $this->setViewData(compact('tiers', 'id'));

        $this->setViewLayout('layouts.donation');
        
        return $this->view();
    }
    
    public function watch($id)
    {
        $tiers = $this->raffles->find($id)->tiers()->whereHas('winners', function ($query) {
            $query->where('status', 1);
        })->get();
    
        $this->setJavascriptData(compact('tiers'));

        $this->setViewLayout('layouts.donation');
        
        return $this->view();
    }

    public function approve($id)
    {
        $tiers = $this->raffles->find($id)->tiers()->whereHas('winners', function ($query) {
            $query->where('status', 1);
        })->get();

        event(new RaffleApproved($tiers));

        return redirect(route('raffle.winners.show', [$id]))
            ->with('message', 'Raffle approved for view.');
    }

    public function overlay()
    {
        return response()->json($this->raffles->active()->first());
    }
}
