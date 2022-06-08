<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    // index size
    'index-images-size' => [
        'large' => ['width' => 735, 'height' => 410],
        'medium' => ['width' => 400, 'height' => 320],
        'small' => ['width' => 300, 'height' => 160],
    ],

    'default-current-index-image' => 'medium',

    // cache size
    'cache-images-size' => [
        'large' => ['width' => 800, 'height' => 600],
        'medium' => ['width' => 400, 'height' => 300],
        'small' => ['width' => 80, 'height' => 60],
    ],

    'default-current-cache-image' => 'medium',
    'image-cache-life-time' => 10,
    'image-not-found' => '',

];
