<?php

namespace App\Console\Commands;

use App\Services\Donating\Models\Donation;
use App\Services\Donating\Models\Total;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class MakeSpreadsheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jj:spreadsheet {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a spreadsheet all donations on the specified day.';

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
        ini_set('memory_limit', '64M');

        $date = Carbon::parse($this->argument('date'));

        $donations = Donation::select(['hb_id', 'name', 'email', 'comment', 'amount', 'hb_created_at'])
                             ->where('hb_created_at', '>', $date->copy()->startOfDay())
                             ->where('hb_created_at', '<', $date->copy()->endOfDay())
                             ->get();

        $this->comment('Creating spreadsheet from ' . $donations->count() . ' donations.');

        $donations = $donations->map(function ($donation) {
            return [
                'id'         => $donation->hb_id,
                'name'       => preg_replace('/[\x{10000}-\x{10FFFF}]/u', "\xEF\xBF\xBD", $donation->name),
                'email'      => $donation->email,
                'amount'     => $donation->amount,
                'comment'    => preg_replace('/[\x{10000}-\x{10FFFF}]/u', "\xEF\xBF\xBD", $donation->comment),
                'created_at' => (string)$donation->hb_created_at,
            ];
        })->toArray();

        Excel::create($date->format('d_m_Y') .'_donations', function ($excel) use ($donations) {
            $excel->sheet('Donations', function ($sheet) use ($donations) {
                // Generate the sheet from the DB results.
                $sheet->fromArray($donations);

                // Make the header stand out.
                $sheet->row(1, function ($row) {
                    $row->setBackground('#000000');
                    $row->setFontColor('#ffffff');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
            });
        })->save('xls', public_path('spreadsheets'));

        $this->comment('Spreadsheet saved to ' . public_path('spreadsheets') . '/donations_' . $date->format('Y-m-d') . '.xls');
    }
}
