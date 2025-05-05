<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    public function getAllUsers()
    {
        $model = new UserModel();
        $users = $model->findAll();

        //remove password field from each user
        foreach ($users as &$user) {
            unset($user['password']);
        }

        return $this->respond($users); 
    }

    public function getUser($id = null)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return $this->failNotFound(('User not found'));
        }
            return $this->respond($user);

    }
}

