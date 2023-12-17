<?php

return [
    'client' => [
        'id' => env('PLAID_CLIENT_ID'),
        'secret' => env('PLAID_CLIENT_SECRET'),
    ],

    'environment' => env('PLAID_ENVIRONMENT'),
];
