<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users_admins';
    protected $allowedFields = ['name', 'email', 'password', 'role'];
    protected $primaryKey = 'id';
}
