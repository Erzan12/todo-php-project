<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    public function getAllUsers()
    {
        $model = new UserModel();
        $users = $model->findAll();

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

    public function delete($id = null)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        if ($model->delete($id)){
            return $this->respond(['message' => 'User deleted']);
        } else {
            return $this->fail('Delete failed');
        }
        
    }

    public function update($id = null)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $data = $this->request->getJSON(true);
        //apply encryption to password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $model->insert($data);
        if ($model->update($id, $data)) {
            return $this->respond(['message' => 'User updated successfully!'], 200);
        } else {
            return $this->fail('Update failed');
        }
    }
}
