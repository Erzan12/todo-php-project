<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class JWTAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        if (!$header || !preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return Services::response()->setJSON(['error' => 'Token required'])->setStatusCode(401);
        }

        $token = $matches[1];
        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            // Store user info in request for later use
            $request->user = $decoded;
        } catch (\Exception $e) {
            return Services::response()->setJSON(['message' => 'Invalid token.'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}

// try {
//     $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
// } catch (\Exception $e) {
//     return response()->setJSON(['error' => 'Invalid or expired token'])->setStatusCode(401);
// }


// app/Filters/JWTAdminFilter.php
// namespace App\Filters;

// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\HTTP\ResponseInterface;
// use CodeIgniter\Filters\FilterInterface;
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;
// use Config\Services;

// class JWTAdminFilter implements FilterInterface
// {
//     public function before(RequestInterface $request, $arguments = null)
//     {
//         $authHeader = $request->getHeaderLine('Authorization');

//         if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
//             return Services::response()->setJSON(['message' => 'Access denied.'])->setStatusCode(401);
//         }

//         $token = $matches[1];

//         try {
//             $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));

//             if (!isset($decoded->role) || $decoded->role !== 'admin') {
//                 return Services::response()->setJSON(['message' => 'Admins only.'])->setStatusCode(403);
//             }

//             $request->user = $decoded;
//         } catch (\Exception $e) {
//             return Services::response()->setJSON(['message' => 'Invalid token.'])->setStatusCode(401);
//         }
//     }

//     public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
// }
