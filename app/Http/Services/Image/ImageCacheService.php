<?php

namespace App\Http\Services\Image;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class ImageCacheService {
    public function cache($imagePath, $size = '') {
        // set image size
        $imageSizes = Config::get('image.cache-images-size');
        if (!isset($imageSizes[$size]))
            $size = Config::get('image.default-current-cache-image');
        $width = $imageSizes[$size]['width'];
        $height = $imageSizes[$size]['height'];

        // cache image
        if (file_exists($imagePath)) {
            $img = Image::cache(function ($image) use ($imagePath, $width, $height) {
                return $image->make($imagePath)->fit($width, $height);
            }, Config::get('image.image-cache-life-time'), true);
            return $img->response();
        }
        else {
            $watermark = Image::make(public_path('admin-assets/images/notfound.png'))->fit($width, $height)->opacity(50);
            $img = Image::canvas($width, $height, '#cdcdcd')
            //     ->text('image not found - 404', $width / 2, $height - 50 , function ($font) {
            //     $font->color('#333333');
            //     $font->align('center');
            //     $font->valign('center');
            //     $font->file(public_path('admin-assets/fonts/IRANSans/IRANSansWeb.woff'));
            //     $font->size(30);
            // });
            ->insert($watermark, 'center');
            return $img->response();
        }
    }
}