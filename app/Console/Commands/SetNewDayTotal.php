<?php

namespace App\Console\Commands;

use App\Services\Donating\Models\Donation;
use App\Services\Donating\Models\Total;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class SetNewDayTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jj:new-day-total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new total to show what the day started at.';

    /**
     * @var \App\Services\Donating\Models\Total
     */
    private $total;

    /**
     * Create a new command instance.
     *
     * @param \App\Services\Donating\Models\Total $total
     */
    public function __construct(Total $total)
    {
        parent::__construct();

        $this->total = $total;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now('GMT');

        if ($date->format('H') != '00') {
            return true;
        }

        $total = $this->total->orderBy('id', 'desc')->first();

        $data = [
            'raised' => $total->raised,
            'reason' => 'New day',
        ];

        $this->total->create($data);

        $this->call('jj:spreadsheet', ['date' => 'yesterday']);
    }
}
