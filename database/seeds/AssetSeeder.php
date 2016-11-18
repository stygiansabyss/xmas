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

        foreach ($images as $image) {
            $file = $image->getPath() . '/' . $image->getFilename();

            $file = Image::make($file);

            $attributes = [
                'name'   => $this->getImageName($image),
                'path'   => 'img/overlay/' . $image->getFilename(),
                'width'  => $file->width(),
                'height' => $file->height(),
            ];

            Asset::create($attributes);
        }
    }

    private function getImageName(SplFileInfo $image)
    {
        $find    = ['.' . $image->getExtension(), '_'];
        $replace = ['', ' '];

        return Str::title(str_replace($find, $replace, $image->getFilename()));
    }
}
