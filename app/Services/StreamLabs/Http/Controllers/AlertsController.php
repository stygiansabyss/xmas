<?php

namespace App\Services\StreamLabs\Http\Controllers;

use App\Apis\StreamLabs\Alerts;
use App\Http\Controllers\BaseController;
use App\Services\StreamLabs\Models\Alert;
use App\Services\StreamLabs\Providers\Auth;

class AlertsController extends BaseController
{
        
    /**
     * @var \App\Services\StreamLabs\Models\Alert
     */
    private $alerts;
    
    /**
     * @param \App\Services\StreamLabs\Models\Alert   $alerts
     */
    public function __construct(Alert $alerts)
    {
        
        $this->setPageTitle('StreamLabs Alerts');
        
        $this->alerts = $alerts;
    }
    
    public function index()
    {
        $alerts = $this->alerts->orderBy('minimum_amount', 'desc')->get();
        
        $this->setViewData(compact('alerts'));
        
        return $this->view();
    }
    
    public function create()
    {
        return $this->view();
    }
    
    public function store()
    {
        Alert::create(request()->all());
        
        return redirect(route('stream-labs.alerts.index'))
            ->with('message', 'StreamLabs alert created');
    }
    
    public function edit($id)
    {
        $alert = $this->alerts->find($id);
        
        $this->setViewData(compact('alert'));
        
        return $this->view();
    }
    
    public function update($id)
    {
        $alert = $this->alerts->find($id);
        $alert->update(request()->all());
        
        return redirect(route('stream-labs.alerts.index'))
            ->with('message', 'StreamLabs alert updated');
    }
    
    public function delete($id)
    {
        $this->alerts->delete($id);
        
        return redirect(route('stream-labs.alerts.index'))
            ->with('message', 'StreamLabs alert deleted');
    }
}
