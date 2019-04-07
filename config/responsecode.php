<?php
return [
    'user' => [
        'registered' => [
            'success' => 1,
            'failed' => -1,
            'exist' => -2,
        ],
        'submit' => [
            'success' => 1,
            'failed' => -1,
            'notexist' => -2,     
        ],
        'get' => [
            'success' => 1,
            'failed' => -1,
        ],
        'update' => [
            'success' => 1,
            'failed' => -1,
        ]
    ],
    'auth' => [
        'login' => [
            'success' => 1,
            'failed' => -1,
            'authfailed' => -2,
        ],
        'logout' => [
            'success' => 1,
            'failed' => -1,
        ]
    ],
    'public' => [
        'get' => [
            'success' => 1,
            'failed' => -1,
        ]
    ]
];