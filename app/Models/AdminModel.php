<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'idadmin';
    protected $allowedFields = ['idadmin', 'nama', 'username', 'email', 'password', 'no_telepon'];

    public function getSelectedMembers()
    {
        return $this->select(['idmember', 'username', 'full_name', 'membership_status', 'membership_end_date'])->findAll();
    }


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
