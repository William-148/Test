<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['name', 'email', 'password', 'active', 'administrator', 'token', 'reset_token', 'reset_expires', 'profile_image'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

