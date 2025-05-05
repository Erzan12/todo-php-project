<?php 
namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model 
{
    protected $table = 'tasks';
    protected $primary = 'id';
    protected $allowedFields = ['title', 'description', 'is_completed'];
    protected $useTimestamps = true;
}

?>