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
        ],
        'getregistration' => [
            'success' => 1,
            'failed' => -1,
        ],
        'updateregistration' => [
            'success' => 1,
            'failed' => -1,
            'exist' => -2,
        ],
        'getregistrationhistory' => [
            'success' => 1,
            'failed' => -1,
        ],
        'deleteregistration' => [
            'success' => 1,
            'failed' => -1,
        ],
        'updateobject' => [
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
        ],
        'registration' => [
            'success' => 1,
            'failed' => -1,
            'registered' => -2,
        ]
    ]
];