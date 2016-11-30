<?php

namespace App\Services\Donating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Donating\Models\Donation;
use Illuminate\Support\Facades\DB;

class Search extends BaseController
{
    /**
     * @var \App\Services\Donating\Models\Donation
     */
    private $donations;

    /**
     * Search constructor.
     *
     * @param \App\Services\Donating\Models\Donation $donations
     */
    public function __construct(Donation $donations)
    {
        $this->donations = $donations;
    }

    public function search()
    {
        $start  = carbonParse('yesterday')->startOfDay();
        $end    = carbonParse('yesterday')->endOfDay();
        $length = 300;

        $this->setJavascriptData(compact('start', 'end', 'length'));

        return $this->view('donation.search');
    }

    public function update($id)
    {
        $set  = request('set');

        $donation = $this->donations->find($id);

        switch ($set) {
            case 'shown':
                $donation->markShown();
                break;
            case 'read':
                $donation->markRead();
                break;
            case 'both':
                $donation->markRead();
                $donation->markShown();
                break;
            case 'not_read':
                $donation->markNotRead();
                break;
            case 'not_shown':
                $donation->markNotShown();
                break;
            case 'neither':
                $donation->markNotRead();
                $donation->markNotShown();
                break;
        }

        $donation = $this->donations->find($id);

        return response()->json($donation);
    }

    public function updateAll()
    {
        $set  = request('set');

        $donations = $this->getDonationsBySearch();

        switch ($set) {
            case 'shown':
                $donations->markShown();
                break;
            case 'read':
                $donations->markRead();
                break;
            case 'both':
                $donations->markRead();
                $donations->markShown();
                break;
        }

        return response()->json($donations);
    }

    public function find()
    {
        $donations = $this->getDonationsBySearch();

        return response()->json($donations);
    }

    /**
     * @return mixed
     */
    private function getDonationsBySearch()
    {
        ini_set('memory_limit', '64M');

        $mode = request('mode');

        switch ($mode) {
            case 'date':
                $donations = $this->getDonationsByDateRange();
                break;
            case 'length':
                $donations = $this->getDonationsByCommentLength();
                break;
            case 'word':
                $donations = $this->getDonationsByWordSearch();
                break;
        }

        return $donations;
    }

    /**
     * Search donations by a date range.
     *
     * @return mixed
     */
    private function getDonationsByDateRange()
    {
        $start = request('start');
        $end   = request('end');

        $donations = $this->donations->withComment()
                                     ->select(['*', DB::raw('LENGTH(comment) as comment_length')])
                                     ->where('hb_created_at', '>=', $start)
                                     ->where('hb_created_at', '<=', $end)
                                     ->orderBy('hb_created_at', 'asc')
                                     ->get();

        return $donations;
    }

    /**
     * Search donations by the comment length.
     *
     * @return mixed
     */
    private function getDonationsByCommentLength()
    {
        $length    = request('length');
        $donations = $this->donations->withComment()
                                     ->select(['*', DB::raw('LENGTH(comment) as comment_length')])
                                     ->whereRaw('LENGTH(comment) > ' . $length)
                                     ->orderBy('comment_length', 'desc')
                                     ->get();

        return $donations;
    }

    /**
     * Search all donations for a string.
     *
     * @return mixed
     */
    private function getDonationsByWordSearch()
    {
        $word      = request('word');
        $donations = $this->donations->whereRaw("INSTR(`name`, '$word')")
                                     ->orwhereRaw("INSTR(`email`, '$word')")
                                     ->orwhereRaw("INSTR(`comment`, '$word')")
                                     ->get();

        return $donations;
    }
}
