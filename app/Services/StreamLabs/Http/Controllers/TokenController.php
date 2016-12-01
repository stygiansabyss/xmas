<?php

namespace App\Services\StreamLabs\Http\Controllers;

use App\Apis\StreamLabs\Alerts;
use App\Http\Controllers\BaseController;
use App\Services\StreamLabs\Models\Token;
use App\Services\StreamLabs\Providers\Auth;

class TokenController extends BaseController
{
    /**
     * @var \App\Services\StreamLabs\Providers\Auth
     */
    private $auth;

    /**
     * @var \App\Services\StreamLabs\Models\Token
     */
    private $tokens;

    /**
     * @param \App\Services\StreamLabs\Providers\Auth $auth
     * @param \App\Services\StreamLabs\Models\Token   $tokens
     */
    public function __construct(Auth $auth, Token $tokens)
    {
        $this->setPageTitle('StreamLabs Tokens');

        $this->auth   = $auth;
        $this->tokens = $tokens;
    }

    public function index()
    {
        $tokens = $this->tokens->all();

        $this->setViewData(compact('tokens'));

        return $this->view();
    }

    public function create()
    {
        return redirect($this->auth->redirect(['alerts.create']));
    }

    public function store()
    {
        $this->auth->save(request('code'));

        return redirect(route('stream-labs.token.index'))
            ->with('message', 'StreamLabs token created');
    }

    public function refresh($id)
    {
        $this->auth->refresh($id);

        return redirect(route('stream-labs.token.index'))
            ->with('message', 'StreamLabs token refreshed');
    }

    public function edit($id)
    {
        $token = $this->tokens->find($id);

        $this->setViewData(compact('token'));

        return $this->view();
    }

    public function update($id)
    {
        $token = $this->tokens->find($id);
        $token->update(request()->all());

        return redirect(route('stream-labs.token.index'))
            ->with('message', 'StreamLabs token updated');
    }

    public function delete($id)
    {
        $this->tokens->delete($id);

        return redirect(route('stream-labs.token.index'))
            ->with('message', 'StreamLabs token deleted');
    }
}
