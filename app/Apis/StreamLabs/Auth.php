<?php

namespace App\Apis\StreamLabs;

class Auth extends Client
{
    protected $section = 'authorize';

    protected $scopes;

    public function scopes(array $scopes = [])
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function getRedirectUrl()
    {
        return $this->getUrl() . $this->generateQueryString();
    }

    protected function generateQueryString()
    {
        $query = [
            'response_type' => 'code',
            'client_id'     => config('services.stream-labs.client_id'),
            'redirect_uri'  => config('services.stream-labs.redirect'),
            'scope'         => implode(',', $this->scopes),
        ];

        return '?'. http_build_query($query);
    }
}
