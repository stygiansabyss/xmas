<?php

namespace App\Services\Goals\Models\Observers;

use App\Services\Goals\Events\GoalWasUpdated;

class Goal
{
    public function created($model)
    {
        event(new GoalWasUpdated($model));
    }
}
