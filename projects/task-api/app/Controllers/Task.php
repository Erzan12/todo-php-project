<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;

class Task extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $task = $this->model->find($id);

        if ($task)  {
            return $this->respond($task);
        } else {
            return $this->failNotFound('Task not found');
        }
    }
    public function create()
    {
        $data = $this->request->getJSON(true);
        if ($this->model->insert($data)) {
            return $this->respondCreated($data);
        } 
        return $this->failValidationErrors($this->model->errors());
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respond($data);
        }
        return $this->fail('Update failed');
    }
    public function delete ($id = null) 
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        }
        return $this->failNotFound('Task not found');
    }
}