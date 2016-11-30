<?php

namespace App\Services\Incentivizing\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Incentivizing\Events\IncentiveWasUpdated;
use App\Services\Incentivizing\Models\Incentive as IncentiveModel;

class Incentive extends BaseController
{
    /**
     * @var \App\Services\Incentivizing\Models\Incentive
     */
    private $incentives;

    /**
     * IncentiveController constructor.
     *
     * @param \App\Services\Incentivizing\Models\Incentive $incentives
     */
    public function __construct(IncentiveModel $incentives)
    {
        $this->incentives = $incentives;
    }

    public function index()
    {
        $incentives = $this->incentives->orderBy('created_at', 'desc')->paginate(25);

        $this->setViewData(compact('incentives'));

        return $this->view();
    }

    public function create()
    {
        return $this->view();
    }

    public function store()
    {
        $incentive = $this->incentives->create(request()->all());

        event(new IncentiveWasUpdated($incentive));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'New incentive created');
    }

    public function edit($id)
    {
        $incentive = $this->incentives->find($id);

        $this->setViewData(compact('incentive'));

        return $this->view();
    }

    public function update($id)
    {
        $incentive = $this->incentives->find($id);
        $incentive->update(request()->all());

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Incentive updated');
    }

    public function reached($id)
    {
        $incentive = $this->incentives->find($id);
        $incentive->reached();

        event(new IncentiveWasUpdated($this->incentives->find($id)));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Incentive finished!');
    }
}
