<?php

namespace App\Services\Administrating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Administrating\Models\Asset;
use Intervention\Image\ImageManager;

class Assets extends BaseController
{
    /**
     * @var \Intervention\Image\ImageManager
     */
    private $images;

    /**
     * @var \App\Services\Administrating\Models\Asset
     */
    private $assets;

    /**
     * @param \Intervention\Image\ImageManager          $images
     * @param \App\Services\Administrating\Models\Asset $assets
     */
    public function __construct(ImageManager $images, Asset $assets)
    {
        $this->images = $images;
        $this->assets = $assets;
    }

    public function index()
    {
        $images = $this->assets->orderByNameAsc()->get();

        $this->setViewData(compact('images'));

        return $this->view();
    }
}
