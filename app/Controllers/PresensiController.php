<?php

namespace App\Controllers;

use App\Models\PresensiModel;

class PresensiController extends BaseController
{
    public function lihatpresensi()
    {
        // Instance dari model PresensiModel
        $presensiModel = new PresensiModel();

        $data = [
            'title' => 'Lihat Daftar Presensi',
            'presensiModel' => $presensiModel->getAllPresensiData()
        ];

        return view('AdminLihatPresensi', $data);
    }

    public function catatpresensi($idmember, $idadmin)
    {

        $presensiModel = new PresensiModel();

        $data = [
            'idmember' => $idmember,
            'idadmin' => $idadmin,
            'jam_masuk' => date('Y-m-d H:i:s'),
            'status' => 'Hadir'
        ];

        $presensiModel->insert($data);
        session()->setFlashdata('presensiin', 'Member Berhasil Di Catat Kehadirannya!');
        return redirect()->back();
    }

    public function hapuspresensi($id)
    {
        $presensiModel = new PresensiModel();

        $presensi = $presensiModel->find($id);

        if ($presensi) {
            $presensiModel->delete($id);
            return redirect()->back()->with('hpspresensi', 'Presensi Member Berhasil di Hapus!!!');
        } else {
            session()->setFlashdata('gagalhapuspresensi', 'Gagal Menghapus');
            return redirect()->back()->with('error', 'Presensi tidak ditemukan.');
        }
    }
}
