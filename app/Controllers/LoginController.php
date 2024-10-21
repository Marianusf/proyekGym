<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\PemilikModel;
use App\Models\MemberModel;

class LoginController extends Controller
{
    public function index()
    {
        $session = session();
        $session->destroy();
        return view('Login');
    }
    public function awalan()
    {
        $session = session();
        $session->destroy();
        $data = [
            'title' => 'Selamat Datang di gym go',
            'validation' => \Config\Services::validation()
        ];
        return view('MenuInformasi', $data);
    }
    public function login()
    {
        helper('form');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan Password harus diisi');
        }


        $redirectPath = '';
        $user = null;
        $userType = '';
        $allowedFields = [];
        $adminModel = new AdminModel();
        $pemilikModel = new PemilikModel();
        $memberModel = new MemberModel();


        // Memeriksa apakah username mengandung 'admin_'
        if (substr($username, 0, 5) === 'admin') {
            $user = $adminModel->getAccount($username, $password);
            $redirectPath = 'admin/dashboard';
            $userType = 'admin';
            $allowedFields = $adminModel->allowedFields;
        }
        // Memeriksa apakah username mengandung 'pemilik_'
        elseif (substr($username, 0, 7) === 'pemilik') {
            $user = $pemilikModel->getAccount($username, $password);
            $redirectPath = 'pemilik/lihathasil';
            $userType = 'pemilik';
            $allowedFields = $pemilikModel->allowedFields;
        } else {
            // Login sebagai member
            $user = $memberModel->getAccount($username, $password);
            $redirectPath = 'member/dashboard';
            $userType = 'member';
            $allowedFields = $memberModel->allowedFields;
        }
        // Memeriksa apakah user ditemukan dan password sesuai
        if ($user) { // Assuming password is hashed
            // Set session untuk user yang berhasil login
            $session = session();
            // Menyimpan seluruh data pengguna dalam session
            $sessionData = [];
            foreach ($allowedFields as $field) {
                if (isset($user[$field])) {
                    $sessionData[$field] = $user[$field];
                }
            }
            $sessionData['user_type'] = $userType;
            $sessionData['logged_in'] = true;
            $session->set($sessionData);

            return redirect()->to($redirectPath);
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Username atau Password salah, Silahkan coba lagi');
        }
    }
}
