<?php

use ToxyTech\ACL\Models\User;

return [
    'provider' => [
        'model' => User::class,
        'guard' => 'web',
        'password_broker' => 'users',
        'verify_email' => false,
    ],
];
