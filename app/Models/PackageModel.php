<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'idpackage';
    protected $allowedFields = ['name', 'price', 'duration'];
    public function getPackages()
    {
        return $this->findAll(); // Ambil semua data dari tabel package
    }
}
