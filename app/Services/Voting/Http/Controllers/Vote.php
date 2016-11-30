<?php

namespace App\Services\Voting\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Voting\Events\VoteWasUpdated;
use App\Services\Voting\Models\Vote as VoteModel;

class Vote extends BaseController
{
    /**
     * @var \App\Services\Voting\Models\Vote
     */
    private $votes;

    /**
     * Vote constructor.
     *
     * @param \App\Services\Voting\Models\Vote $votes
     */
    public function __construct(VoteModel $votes)
    {
        $this->votes = $votes;
    }

    public function index()
    {
        $votes = $this->votes->orderBy('created_at', 'desc')->paginate(25);

        $this->setViewData(compact('votes'));

        return $this->view();
    }

    public function create()
    {
        return $this->view();
    }

    public function store()
    {

        $vote = $this->votes->generate(request());

        event(new VoteWasUpdated($vote));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'New vote created');
    }

    public function edit($id)
    {
        $vote = $this->votes->find($id);

        $this->setJavascriptData(compact('vote'));

        return $this->view();
    }

    public function update($id)
    {
        $vote = $this->votes->find($id);

        $vote->update(['name' => request('name')]);
        $vote->updateOptions(request('options'));
        $vote->createOptions(request('new_options'));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Vote updated');
    }

    public function status($id, $statusId)
    {
        $vote = $this->votes->find($id);
        $vote->setStatus($statusId);

        if ($statusId == $this->votes->FINISHED) {
            $vote = null;
        }

        event(new VoteWasUpdated($this->votes->find($id)));

        return response()->json($vote);
    }

    public function acceptance($id, $statusId)
    {
        $vote = $this->votes->find($id);
        $vote->setAccepting($statusId);

        event(new VoteWasUpdated($this->votes->find($id)));

        return response()->json($vote);
    }
}
