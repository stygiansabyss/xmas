<?php

namespace App\Apis\StreamLabs;

use App\Apis\StreamLabs\Models\Token as TokenModel;

class Token extends Client
{
    protected $section = 'token';

    public function getToken($code)
    {
        $response = $this->post($this->getUrl(), [
            'form_params' => [
                'grant_type'    => 'authorization_code',
                'client_id'     => config('services.stream-labs.client_id'),
                'client_secret' => config('services.stream-labs.client_secret'),
                'redirect_uri'  => config('services.stream-labs.redirect'),
                'code'          => $code,
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        return new TokenModel((array)$result);
    }

    public function refreshToken()
    {
        try {
            $response = $this->post($this->getUrl(), [
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'client_id'     => config('services.stream-labs.client_id'),
                    'client_secret' => config('services.stream-labs.client_secret'),
                    'redirect_uri'  => config('services.stream-labs.redirect') . '/' . $this->channelToken->id,
                    'refresh_token' => $this->channelToken->refresh_token,
                ],
            ]);

            $result = json_decode($response->getBody()->getContents());

            // Add the expires at to the token
            $newTokens = new TokenModel((array)$result);
            $newTokens = array_merge($newTokens->toArray(), [
                'expires_at' => \Carbon\Carbon::now()->addHour(),
            ]);

            $this->channelToken->update($newTokens);

            return $this->channelToken;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
