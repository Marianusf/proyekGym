<?php

namespace App\Controllers;

class PemilikController extends BaseController
{
    public function dashboard()
    {
        // Tampilkan halaman dashboard pemilik
        return view('DashboardPemilik');
    }
}
