<?php

namespace YourNamespace\applications\services\jwtService;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private $key;
    private $algorithm;

    public function __construct($key, $algorithm = 'HS256')
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
    }

    public function createToken($payload): string
    {
        return JWT::encode($payload, $this->key, $this->algorithm);
    }

    public function validateToken($token)
    {
        try {
            return JWT::decode($token, new Key($this->key, $this->algorithm));
        } catch (\Exception $e) {
            return null;
        }
    }
}
