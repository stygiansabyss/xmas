<?php

namespace App\Services\Goals\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Goals\Events\GoalWasUpdated;
use App\Services\Goals\Models\Goal as GoalModel;
use App\Services\Donating\Models\Total;

class Goal extends BaseController
{
    /**
     * @var \App\Services\Goals\Models\Goal;
     */
    private $goals;
    
    /**
     * @var \App\Services\Donating\Models\Total
     */
    private $totals;
    
    public function __construct(GoalModel $goals, Total $totals)
    {
        $this->goals  = $goals;
        $this->totals = $totals;
    }
    
    public function index()
    {
        $goals = $this->goals->orderBy('created_at', 'desc')->paginate(25);
        
        $this->setViewData(compact('goals'));
    
        return $this->view();
    }
    
    public function create()
    {
        $total = $this->totals->orderBy('id', 'desc')->first();
        
        $this->setViewData(compact('total'));
    
        $this->setJavascriptData('csrfToken', csrf_token());
    
        return $this->view();
    }
    
    public function store()
    {
        $goal = $this->goals->create(request()->all());
        
        event(new GoalWasUpdated($goal));
        
        return redirect(route('administrating.dashboard'))
            ->with('message', 'New goal created');
    }
    
    public function edit($id)
    {
        $goal  = $this->goals->find($id);
        $total = $this->totals->orderBy('id', 'desc')->first();
        
        $this->setViewData(compact('goal', 'total'));
    
        return $this->view();
    }
    
    public function update($id)
    {
        $goal = $this->goals->find($id);
        $goal->update(request()->all());

        event(new GoalWasUpdated($this->goals->find($id)));
        
        return redirect(route('administrating.dashboard'))
            ->with('message', 'Goal updated');
    }
    
    public function reached($id)
    {
        $goal = $this->goals->find($id);
        $goal->reached();

        event(new GoalWasUpdated($this->goals->find($id)));
        
        return redirect(route('administrating.dashboard'))
            ->with('message', 'Goal finished!');
    }
}
