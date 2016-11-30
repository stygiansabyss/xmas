<?php

namespace App\Services\StreamLabs\Jobs;

use App\Apis\StreamLabs\Alerts;
use App\Services\Donating\Models\Donation;
use App\Services\StreamLabs\Models\Alert;
use App\Services\StreamLabs\Models\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AlertStreamLabs implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var  \App\Services\Donating\Models\Donation
     */
    public $donation;

    /**
     * @var \App\Services\StreamLabs\Models\Token
     */
    public $channel;

    /**
     * Create a new job instance.
     *
     * @param \App\Services\Donating\Models\Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
        $this->channel  = Token::whereChannel(config('services.stream-labs.alert_channel'))->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->channel)) {
            return;
        }

        $alert = Alert::getByDonation($this->donation);
        
        $message = str_replace(['{name}', '{amount}'], [$this->donation->name, $this->donation->amount], $alert->template);
        
        (new Alerts)
            ->setDetails($this->channel)
            ->createAlert([
                'message'    => $message ?: "*{$this->donation->name}* donated {$this->donation->amount}. Thanks!",
                'sound_href' => $alert->sound_href,
                'image_href' => $alert->image_href,
            ]);
    }
}
