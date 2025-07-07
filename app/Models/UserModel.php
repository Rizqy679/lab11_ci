<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // sesuaikan dengan nama tabel
    protected $allowedFields = ['username', 'password'];
}
