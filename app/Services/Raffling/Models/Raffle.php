<?php

namespace App\Services\Raffling\Models;

use App\Models\BaseModel;

class Raffle extends BaseModel
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    const FINISHED = 2;

    protected $table = 'raffles';

    protected $fillable = [
        'name',
        'status',
    ];

    protected $appends = [
        'entries',
    ];

    protected $with = [
        'tiers',
    ];

    public static function generate($request)
    {
        $raffleData = [
            'name' => $request->get('name'),
        ];

        $raffle = static::create($raffleData);

        $tiers = $request->get('tiers');

        foreach ($tiers as $tier) {
            $tierData = [
                'raffle_id' => $raffle->id,
                'minimum'   => $tier['minimum'],
                'reward'    => $tier['reward'],
            ];

            Tier::create($tierData);
        }

        $raffle->setTierLevels();

        return $raffle;
    }

    public function setTierLevels()
    {
        $tiers = $this->tiers()->orderBy('minimum', 'asc')->get();

        $level = 1;

        foreach ($tiers as $tier) {
            $tier->level = $level;
            $tier->save();

            $level++;
        }
    }

    public function updateTiers($tiers)
    {
        foreach ($tiers as $tierId => $tier) {
            $tierData = [
                'raffle_id' => $this->id,
                'minimum'   => $tier['minimum'],
                'reward'    => $tier['reward'],
            ];

            $tier = Tier::find($tierId);
            $tier->update($tierData);
        }

        $this->setTierLevels();
    }

    public function createTiers($tiers)
    {
        foreach ($tiers as $tier) {
            $tierData = [
                'raffle_id' => $this->id,
                'minimum'   => $tier['minimum'],
                'reward'    => $tier['reward'],
            ];

            Tier::create($tierData);
        }

        $this->setTierLevels();
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function scopeFinished($query)
    {
        return $query->where('status', self::FINISHED);
    }

    public function getEntriesAttribute()
    {
        return $this->tiers->donations->count();
    }

    public function setFinished()
    {
        $this->status = self::FINISHED;
        $this->save();

        $this->tiers->setFinished();
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();

        $this->tiers->setStatus($status);
    }

    public function tiers()
    {
        return $this->hasMany(Tier::class, 'raffle_id')->orderBy('level', 'desc');
    }
}
