<?php

return [
    'Upload' => [
        'TmpFolder' => WWW_ROOT . 'tmp/',
        'UploadFolder' => WWW_ROOT . 'uploads/',
        'CacheFolder' => WWW_ROOT . 'uploads/cache/',
        'PhotoFolder' => WWW_ROOT . 'uploads/photos/',
        'VideoFolder' => WWW_ROOT . 'uploads/videos/',
        'MultiPhotoFolder' => WWW_ROOT . 'uploads/multi_photos/',
        'ProfileFolder' => WWW_ROOT . 'uploads/profile/',
        'FileCsvFolder' => WWW_ROOT . 'uploads/csv/',
    ],
    'LinkStatic' => [
        'TmpFolder' => '/tmp/',
        'UploadFolder' => '/uploads/',
        'CacheFolder' => '/uploads/cache/',
        'PhotoFolder' => '/uploads/photos/',
        'VideoFolder' => '/uploads/videos/',
        'MultiPhotoFolder' => '/uploads/multi_photos/',
        'ProfileFolder' => '/uploads/profile/',
        'FileCsvFolder' => '/uploads/csv/',
    ],
//=== Minify js and css
    'Minify' => [
        'cssInline' => false,
        'jsInline' => false,
        'min' => false,
        'ver' => '0.0.1'
    ],
];

