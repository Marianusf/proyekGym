<?php

namespace App\Controllers;

use App\Models\MemberModel;

class AdminController extends BaseController
{
    public function index()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->getMembers();

        return view('AdminViewMember', $data);
    }
    public function lihatdaftarmember()
    {
        $data = [
            'title' => 'lihatdaftarmember',
        ];
        return view('AdminViewMember', $data);
    }
    public function profiladmin()
    {
        $data = [
            'title' => 'profiladmin',
        ];
        return view('AdminProfile', $data);
    }
    public function dashboard()
    {
        // Tampilkan halaman dashboard admin
        return view('DashboardAdmin');
    }
}
