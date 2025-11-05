<?php

return [
    'pdf_to_image' => [
        'default_converter' => 'imagick', 
        'converters' => [
            'imagick' => [
                'path' => '', 
                'quality' => 90,
                'page' => 1,
            ],
        ],
    ],
];
