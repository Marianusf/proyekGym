<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table = 'presensi';
    protected $primaryKey = 'idpresensi';
    protected $allowedFields = ['idmember', 'idadmin', 'jam_masuk', 'status'];


    public function getAllPresensiData()
    {
        return $this->findAll();
    }
}
