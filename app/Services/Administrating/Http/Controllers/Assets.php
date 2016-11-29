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

    public function edit($id)
    {
        $this->setViewData('image', $this->assets->find($id));

        return $this->view();
    }

    public function update($id)
    {
        // check that new image exists
        if (! request()->hasFile('image')) {
            return redirect(route('administrating.asset.edit', $id))
                ->with('error', 'No image submitted.');
        }

        $asset = $this->assets->find($id);
        $image = $this->images->make(request()->file('image'));

        // check that new image is the same dimensions as the original
        if ($image->width() !== $asset->width || $image->height() !== $asset->height) {
            return redirect(route('administrating.asset.edit', $id))
                ->with('error', 'Image must be the same dimensions ('. $asset->width .'px wide and '. $asset->height .'px tall).');
        }

        $image->save(public_path($asset->path));

        return redirect(route('administrating.asset'))
            ->with('message', 'New image successfully added.');
    }
}
