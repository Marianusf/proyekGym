<?php

namespace App\Controllers;

use App\Models\MemberModel;

class MemberController extends BaseController
{
    protected $memberModel;

    public function __construct()
    {

        $validation = \Config\Services::validation();
        $this->memberModel = new MemberModel();
    }
    public function profilmember()
    {
        // $validation = \Config\Services::validation()
        $data = [
            'title' => 'profilmember',

        ];
        return view('ProfileMember', $data);
    }
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboardmember',
        ];
        // Tampilkan halaman dashboard member
        return view('DashboardMember', $data);
    }

    //ini terbaru
    public function deleteMember($idmember)
    {
        $db = \Config\Database::connect();
        $db->transStart();  // Memulai transaksi

        // Hapus pesanan yang terkait dengan anggota, kondisi ini memaksa semua yang berhubungan di delete
        $orderModel = new \App\Models\OrderModel();
        $orderModel->where('idmember', $idmember)->delete();

        // Hapus anggota
        $memberModel = new \App\Models\MemberModel();
        $memberModel->delete($idmember);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            session()->setFlashdata('gagalhapus', 'Member Gagal Di Hapus Silahkan Coba Lagi!');
            return redirect()->back();
        } else {
            session()->setFlashdata('sukseshapus', 'Member Berhasil Di Hapus!');
            return redirect()->back();
        }
    }

    public function listMembers()
    {
        // Instance dari model MemberModel
        $memberModel = new MemberModel();
        $limit = $this->request->getGet('limit') ?? 10;

        // Ambil data member dengan batasan limit
        $members = $memberModel->findAll($limit);


        // Ambil data member dengan field-field tertentu
        $members = $memberModel->select('idmember, username, full_name, membership_status, membership_end_date')
            ->findAll();

        // Kirim data ke view
        $data['members'] = $members;

        // Load view 'list_members' dengan data
        return view('AdminViewMember', $data, [
            'members' => $members,
            'limit' => $limit
        ]);
    }


    public function index()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->getSelectedMembers; // Ambil semua data member
        $data['keyword'] = ''; // Inisialisasi keyword kosong

        return view('AdminViewMember', $data);
    }


    public function register()
    {
        // helper(['form']);
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric|min_length[3]|is_unique[members.username]|not_in_list[admin,pemilik]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'alpha_numeric' => '{field} hanya boleh mengandung huruf dan angka.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
                    'not_in_list' => 'Username tidak boleh "admin" atau "pemilik".'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[members.email]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'valid_email' => '{field} harus berupa email yang valid.',
                    'is_unique' => '{field} sudah digunakan.'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                    'regex_match' => '{field} harus kombinasi karakter besar, kecil, dan angka, minimal 8 karakter.'
                ]
            ],
            'UlangPsw' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => '{field} tidak sesuai dengan password.'
                ]
            ],
            'noTelp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.'
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'poto' => [
                'rules' => 'uploaded[poto]|max_size[poto,1024]|is_image[poto]|mime_in[poto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harus upload gambar',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Harus upload gambar',
                    'mime_in' => 'Harus upload gambar dengan format jpg, jpeg, atau png'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/registrasiview')->withInput('validation', $validation);
            // return redirect()->to('/registrasiview')->withInput();
        }
        $filepoto = $this->request->getFile('poto');
        $filepoto->move('gambar');
        $namapoto = $filepoto->getName();
        $this->memberModel->save(
            [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'full_name' => $this->request->getVar('nama'),
                'password' => $this->request->getVar('password'),
                'no_telepon' => $this->request->getVar('noTelp'),
                'birth_date' => $this->request->getVar('tanggal_lahir'),
                'adress' => $this->request->getVar('alamat'),
                'potoprofil' => $namapoto
            ]
        );
        session()->setFlashdata('pesan', 'Registrasi Berhasil, Silahkan Login');

        return redirect()->to('/registrasiview'); // Redirect ke halaman login setelah registrasi sukses

    }

    public function registrasiview()
    {
        session();
        $data = [
            'title' => 'Registrasi Member',
            'validation' => \Config\Services::validation()
        ];
        // Tampilkan halaman dashboard member
        return view('Register', $data);
    }

    public function editMember($idmember)
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|alpha_numeric|min_length[3]|is_unique[members.username]|not_in_list[admin,pemilik]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'alpha_numeric' => '{field} hanya boleh mengandung huruf dan angka.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
                    'not_in_list' => 'Username tidak boleh "admin" atau "pemilik".'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[members.email]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'valid_email' => '{field} harus berupa email yang valid.',
                    'is_unique' => '{field} sudah digunakan.'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                    'regex_match' => '{field} harus kombinasi karakter besar, kecil, dan angka, minimal 8 karakter.'
                ]
            ],
            'UlangPsw' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => '{field} tidak sesuai dengan password.'
                ]
            ],
            'noTelp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.'
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'poto' => [
                'rules' => 'uploaded[poto]|max_size[poto,1024]|is_image[poto]|mime_in[poto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harus upload gambar',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Harus upload gambar',
                    'mime_in' => 'Harus upload gambar dengan format jpg, jpeg, atau png'
                ]
            ]
        ])) {
            $filepoto = $this->request->getFile('poto');
            $filepoto->move('gambar');
            $namapoto = $filepoto->getName();
            $this->memberModel->save(
                [
                    'idmember' => $idmember,
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'full_name' => $this->request->getVar('nama'),
                    'password' => $this->request->getVar('password'),
                    'no_telepon' => $this->request->getVar('noTelp'),
                    'birth_date' => $this->request->getVar('tanggal_lahir'),
                    'adress' => $this->request->getVar('alamat'),
                    'potoprofil' => $namapoto
                ]

            );
            session()->setFlashdata('pesanupdate', 'Data diri anda Berhasil di Update, jangan lupa untuk selalu bayar membership');

            return redirect()->to('/profile');
        }
    }
}
