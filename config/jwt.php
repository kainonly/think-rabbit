<?php

use Lcobucci\JWT\Signer\Hmac\Sha256;

return [
    'signer' => new Sha256(),
    'expires' => 3600,
    'system' => [
        'issuer' => '',
        'audience' => ''
    ]
];
