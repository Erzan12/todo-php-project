<?php

require 'vendor/autoload.php'; // ensure this path is correct

use Firebase\JWT\JWT;

$secret = getenv('JWT_SECRET') ?: ''; // fallback in case .env not loaded

$payload = [
    'iat' => time(),
    'exp' => time() + 3600,
    'uid' => 1
];

$jwt = JWT::encode($payload, $secret, 'HS256');

echo "JWT Token:\n$jwt\n";
