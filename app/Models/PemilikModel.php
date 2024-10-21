<?php

namespace App\Models;

use CodeIgniter\Model;

class PemilikModel extends Model
{
    protected $table      = 'pemilik';
    protected $primaryKey = 'idpemilik';

    protected $allowedFields = ['idpemilik', 'nama', 'email', 'username', 'password', 'no_telepon'];

    public function login($username, $password)
    {
        $user = $this->where('username', $username)
            ->where('password', $password)
            ->first();
        return $user;
    }
    public function getAccount($username, $password)
    {
        return $this->where('username', $username)
            ->where('password', $password)
            ->first();
    }
}
