<?php

namespace App\Apis\StreamLabs;

class Alerts extends Client
{
    protected $section = 'alerts';
    
    /**
     * @param array $query
     *
     * @return void
     */
    public function createAlert(array $query = [])
    {
        $this->verifyAccessToken();
        
        $defaultQuery = [
            'access_token' => $this->channelToken->access_token,
            'type'         => 'donation',
            'duration'     => 5,
        ];
        
        try {
            $this->post($this->getUrl(), [
                'form_params' => array_merge($defaultQuery, $query),
            ]);
        } catch (\Exception $e) {
            //$error              = $e->getResponse()->json();
            $error['exception'] = $e->getMessage();
            
            dd($error);
        }
    }
}
