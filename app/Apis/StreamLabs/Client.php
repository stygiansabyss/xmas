<?php

namespace App\Apis\StreamLabs;

use App\Apis\BaseClient;
use App\Services\StreamLabs\Models\Token as TokenModel;

class Client extends BaseClient
{
    protected $url = 'https://streamlabs.com/api/v1.0/';

    protected $accessToken = null;

    /**
     * @var \App\Services\StreamLabs\Models\Token
     */
    protected $channelToken = null;

    public function setDetails(TokenModel $token)
    {
        $this->channelToken = $token;

        return $this;
    }

    public function verifyAccessToken()
    {
        if (is_null($this->channelToken)) {
            throw new \InvalidArgumentException('You must add a channel token to make API calls.');
        }

        if ($this->channelToken->expires_at->lt(carbonParse('now'))) {
            $this->channelToken = (new Token)->setDetails($this->channelToken)->refreshToken();
        }
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    protected function getUrl()
    {
        if (! isset($this->section)) {
            throw new \InvalidArgumentException('The section property needs to be set on ' . get_called_class());
        }

        return $this->url . $this->section;
    }
}
