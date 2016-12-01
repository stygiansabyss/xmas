<?php

namespace App\Services\StreamLabs\Providers;

use App\Apis\StreamLabs\Auth as AuthAPI;
use App\Apis\StreamLabs\Token as TokenAPI;
use App\Apis\StreamLabs\User;
use App\Services\StreamLabs\Models\Token;
use Carbon\Carbon;

class Auth
{
    /**
     * @var \App\Apis\StreamLabs\Auth
     */
    private $auth;
    
    /**
     * @var \App\Apis\StreamLabs\Token
     */
    private $token;
    
    /**
     * @var \App\Apis\StreamLabs\User
     */
    private $user;
    
    /**
     * @var \App\Services\StreamLabs\Models\Token
     */
    private $tokens;
    
    /**
     * @param \App\Apis\StreamLabs\Auth             $auth
     * @param \App\Apis\StreamLabs\Token            $token
     * @param \App\Apis\StreamLabs\User             $user
     * @param \App\Services\StreamLabs\Models\Token $tokens
     */
    public function __construct(AuthAPI $auth, TokenAPI $token, User $user, Token $tokens)
    {
        $this->auth   = $auth;
        $this->token  = $token;
        $this->user   = $user;
        $this->tokens = $tokens;
    }
    
    /**
     * Get the redirect URL to authenticate with Twitch Alerts.
     *
     * @param array $scopes
     *
     * @return string
     */
    public function redirect(array $scopes = [])
    {
        return $this->auth->scopes($scopes)->getRedirectUrl();
    }
    
    /**
     * Store an access token set.
     *
     * @param $code
     *
     * @return \App\Services\StreamLabs\Models\Token
     */
    public function save($code)
    {
        $tokens = $this->token->getToken($code);
        $user   = $this->user->setAccessToken($tokens->access_token)->getUser();
        
        $data = [
            'twitch_id'     => $user->id,
            'channel'       => $user->name,
            'access_token'  => $tokens->access_token,
            'refresh_token' => $tokens->refresh_token,
            'expires_at'    => (string)Carbon::now()->addHour(),
        ];
        
        $existingToken = $this->tokens->where('twitch_id', $user->id)->first();
        
        if (! is_null($existingToken)) {
            return $existingToken->update($data);
        }
        
        return $this->tokens->create($data);
    }
    
    /**
     * Refresh an existing access token set.
     *
     * @param $id
     *
     * @return \App\Services\StreamLabs\Models\Token
     */
    public function refresh($id)
    {
        $token  = $this->tokens->find($id);
        $tokens = $this->token->setDetails($token)->refreshToken();
        
        $data = [
            'access_token'  => $tokens->access_token,
            'refresh_token' => $tokens->refresh_token,
            'expires_at'    => (string)Carbon::now()->addHour(),
        ];
        
        return $token->update($data);
    }
}