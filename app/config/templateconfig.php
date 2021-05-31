<?php

return [
    'template' =>[
        'wrapper_start' => TEMPLATE_PATH . 'wrapper.php',
        'header'  => TEMPLATE_PATH . 'header.php',
        'nav'     => TEMPLATE_PATH . 'nav.php',
        ':view'   => ':action_view',
        'wrapper_end' =>TEMPLATE_PATH . 'wrapperend.php'
    ],
    'header_resources' => [
        'css' => [
            'bootstrap' => CSS . 'bootstrap.css',
            'fawsome' => CSS . 'fawsome.min.css',
            'main' => CSS . 'style.css'
        ],
        'js' => [
            'bootstrap' => JS . 'bootstrap.js'
        ]
    ],
    'footer_resources' => [
        'jquery'  => JS . '',
        'helper' => JS . 'helper.js',
        'main'   => JS . 'main.js'
    ]
];