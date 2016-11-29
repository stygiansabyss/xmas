<?php

use App\Services\Administrating\Models\Asset;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\Finder\SplFileInfo;

class AssetSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table each time.
        $this->truncate('assets');

        $images = File::allFiles(public_path('img/overlay'));

        $this->saveImages($images);
    }

    private function getImageName(SplFileInfo $image)
    {
        $find    = ['.' . $image->getExtension(), '_'];
        $replace = ['', ' '];

        return Str::title(str_replace($find, $replace, $image->getFilename()));
    }

    /**
     * @param $images
     */
    private function saveImages($images)
    {
        foreach ($images as $image) {
            $file = $image->getPath() . '/' . $image->getFilename();
            $path = str_replace(public_path(), '', $file);

            $file = Image::make($file);

            $attributes = [
                'name'   => $this->getImageName($image),
                'path'   => $path,
                'width'  => $file->width(),
                'height' => $file->height(),
            ];

            Asset::create($attributes);
        }
    }
}
