<?php

    return [
        'template' => [
            'wrapper_start' => TEMPLATE_PATH . 'wrapperstart.php',
            'nav'           => TEMPLATE_PATH . 'nav.php',
            'header'        => TEMPLATE_PATH . 'header.php',
            ':view'         => ':action_view',
            'wrapper_end'   => TEMPLATE_PATH . 'wrapperend.php',
        ],
        'header_resources'  => [
            'css' => [
                'all.min'   => CSS . 'all.min.css',
                'styleMoon' => CSS . 'style.css',
                'normalize' => CSS . 'normalize.css',
                'sbootstrap'=> CSS . 'styleBootstrap.css',
                'main'      => CSS . 'main.css',
            ],
            'js' => [
                'modernizr' => JS . 'vendor/modernizr-2.6.2.min.js'
            ]
        ],
        'footer_resources'  => [
            'bootstrap'     => JS . 'bootstrap.js',
            'jquery'        => JS . 'vendor/jquery-1.10.2.min.js',
            // 'helper'        => JS . 'helper.js',
            'main'          => JS . 'main.js',
            'app'          => JS . 'app.js',
        ]
    ];