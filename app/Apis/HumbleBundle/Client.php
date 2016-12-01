<?php

namespace App\Apis\HumbleBundle;

use App\Apis\BaseClient;
use GuzzleHttp\Exception\ConnectException;

class Client extends BaseClient
{
    protected $url = 'link';

    protected $cacheKey = 'hb:cursor';

    public function donations()
    {
        $response  = $this->getDonations();
        $donations = $response->data;

        while (count($response->data) == 100) {
            $response  = $this->getDonations();
            $donations = array_merge($donations, $response->data);
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

        $response = $this->get(config('jinglejam.apiLink') .'?cursor=' . $cursor);
        $response = json_decode($response->getBody()->getContents());

        cache()->forever($this->cacheKey, $response->cursor);

        return $response;
    }

    public function getTotal()
    {
        try {
            $response = $this->get(config('jinglejam.pubNubLink'), ['timeout' => 5]);

            return json_decode($response->getBody()->getContents());
        } catch (ConnectException $exception) {
            return [];
        }
    }
}
