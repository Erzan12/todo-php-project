<?php

namespace App\Controllers;

use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    public function register()
    {
        $data = $this->request->getJSON(true);
        $userModel = new UserModel();

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $userModel->insert($data);

        return $this->respondCreated(['message' => 'User registered']);
    }

    public function login()
    {
        $data = $this->request->getJSON(true);
        $userModel = new UserModel();
        $user = $userModel->where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Invalid login credentials');
        }

        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'uid' => $user['id'],
            'role' => $user['role']
        ];

        $jwt = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

        return $this->respond(['token' => $jwt]);
    }
}

