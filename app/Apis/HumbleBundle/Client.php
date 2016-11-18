<?php

namespace App\Apis\HumbleBundle;

use App\Apis\BaseClient;

class Client extends BaseClient
{
    protected $url = 'http://www.humblebundle.com/hbycjj2015';

    protected $cacheKey = 'hb:cursor';

    public function donations()
    {
        $response  = $this->getDonations();
        $donations = $response['data'];

        while (count($response['data']) == 100) {
            $response  = $this->getDonations();
            $donations = array_merge($donations, $response['data']);
        }

        return $donations;
    }

    /**
     * @return mixed
     */
    private function getDonations()
    {
        $cursor = null;

        if (cache()->has($this->cacheKey)) {
            $cursor = cache($this->cacheKey);
        }

        $response = $this->get('?cursor=' . $cursor)->json();

        cache()->forever($this->cacheKey, $response['cursor']);

        return $response;
    }

    public function getTotal()
    {
        return $this->get(config('jinglejam.pubNubLink'))->json();
    }
}
