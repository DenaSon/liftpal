<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'center',
        'timer' => 3200,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false
    ],
    'confirm' => [
        'icon' => 'question',
        'position' => 'center',
        'toast' => true,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'لغو',
        'confirmButtonText' => 'تایید',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#6c757d'
    ]
];
