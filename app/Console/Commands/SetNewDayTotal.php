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

        $this->makeSpreadsheet();
    }

    private function makeSpreadsheet()
    {
        ini_set('memory_limit', '64M');

        $donations = Donation::select(['hb_id', 'name', 'email', 'comment', 'hb_created_at'])
                             ->where('hb_created_at', '>', date('Y-m-d 00:00:00', strtotime('yesterday')))
                             ->where('hb_created_at', '<', date('Y-m-d 00:00:00'))
                             ->get();

        $donationsArray = [];

        foreach ($donations as $donation) {
            $data = [
                'id'         => $donation->hb_id,
                'name'       => $donation->name,
                'email'      => $donation->email,
                'amount'     => $donation->amount,
                'comment'    => $donation->comment,
                'created_at' => (string)$donation->hb_created_at,
            ];

            $donationsArray[] = $data;
        }

        Excel::create('donations_' . date('Y-m-d', strtotime('yesterday')), function ($excel) use ($donationsArray) {
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
        })->save('xls', public_path('spreadsheets'));
    }
}
