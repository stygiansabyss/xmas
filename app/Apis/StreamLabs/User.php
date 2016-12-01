<?php

namespace App\Apis\StreamLabs;

class User extends Client
{
    protected $section = 'user';

    public function getUser()
    {
        $response = $this->get($this->getUrl(), [
            'query' => [
                'access_token' => $this->accessToken
            ],
        ]);

        $result = json_decode($response->getBody()->getContents());

        return $result->twitch;
    }
}
