<?php

namespace App\Services\Donating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Donating\Models\Total;

class Api extends BaseController
{
    /**
     * @var \App\Services\HumbleBundle\Models\Total
     */
    private $totals;

    /**
     * @param \App\Services\Donating\Models\Total $totals
     */
    public function __construct(Total $totals)
    {
        $this->totals = $totals;
    }

    public function total()
    {
        $total = $this->totals->orderBy('id', 'desc')->first()->raised;

        return response()->json($total, 200);
    }

    public function dayStart()
    {
        $total = $this->totals->where('updated_at', '>', carbonParse('now')->startOfDay())
                              ->where('updated_at', '<', carbonParse('now')->endOfDay())
                              ->orderBy('id', 'asc')
                              ->first()
            ->raised;

        return response()->json($total, 200);
    }

    public function milestone()
    {
        $reason = request('reason');

        if ($reason == null) {
            return response()->json(['error' => 'You must specify a reason'], 400);
        }

        $total = $this->totals->orderBy('id', 'desc')->first();

        $data = array_merge(
            $total->toArray(),
            ['reason' => request('reason')]
        );

        $this->totals->create($data);

        return response()->json($data, 201);
    }
}
