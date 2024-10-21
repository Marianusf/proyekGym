<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\OrderModel;
use App\Models\MemberModel;

class PaymentController extends BaseController
{
    public function pilihpaket()
    {
        $packageModel = new PackageModel();
        $data['package'] = $packageModel->findAll();
        return view('PilihPaket', $data);
    }
    public function processOrder()
    {
        // Ambil package_id dari form
        $packageId = $this->request->getPost('package_id');

        // Ambil idmember dari session
        $idmember = session()->get('idmember');

        // Generate unique code
        $uniqueCode = rand(100000, 999999); // Ini hanya sementara, gunakan metode yang lebih aman di produksi

        // Simpan order ke database menggunakan model
        $orderModel = new OrderModel();
        $orderModel->insert([
            'idmember' => $idmember,
            'idpackage' => $packageId,
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 'pending',
            'unique_code' => $uniqueCode,
        ]);
        session()->setFlashdata('pemesanan', 'Pemesanan Berhasil Silahkan Meminta Kode Unik Pada Admin Untuk Konfirmasi Pemesanan');

        return redirect()->to('payment/confirm')->with('unique_code', $uniqueCode);
    }
    public function validatePayment()
    {
        $uniqueCode = $this->request->getPost('unique_code_input');

        $idmember = session()->get('idmember');

        $orderModel = new OrderModel();

        $order = $orderModel->where('idmember', $idmember)->where('unique_code', $uniqueCode)->first();

        if ($order) {

            $packageModel = new PackageModel();
            $package = $packageModel->find($order['idpackage']);


            $orderModel->update($order['id'], ['status' => 'confirmed']);

            $memberModel = new MemberModel();
            $memberModel->updateMembership($idmember, $package['duration']);


            // Redirect dengan pesan sukses
            session()->setFlashdata('pemesanan2', 'Proses Pemesanan disetujui,Membership Berhasil di Perpanjang');

            return redirect()->to('/membershippesan')->with('message', 'Payment confirmed and membership extended!');
        } else {
            session()->setFlashdata('gagalpesananpaket', 'Proses Permintaan Perpanjang Anda Gagal!, Periksa Kembali Kode Anda!');
            // Jika validasi gagal, redirect dengan pesan error
            return redirect()->to('/payment/confirm')->with('error', 'Invalid payment details.');
        }
    }

    public function confirmPayment()
    {
        return view('PilihPaket');
    }

    public function pendingOrders()
    {
        // Instance of OrderModel
        $orderModel = new OrderModel();

        // Get pending orders using the validateOrder method from the model
        $pendingOrders = $orderModel->getPendingOrders();

        // Pass data to the view
        $data['pendingOrders'] = $pendingOrders;

        // Load the view
        return view('ViewKode', $data);
    }


    public function laporanbulanan()
    {
        // Instance dari model OrderModel
        $orderModel = new OrderModel();

        $laporan = $orderModel->getlaporanbulanan();

        $totalPendapatan = [
            'idpackage_1' => 0,
            'idpackage_2' => 0,
            'idpackage_3' => 0,

        ];

        // Total keseluruhan pendapatan
        $totalPendapatanKeseluruhan = 0;

        foreach ($laporan as $order) {
            switch ($order['idpackage']) {
                case 1:
                    $totalPendapatan['idpackage_1'] += 210000;
                    break;
                case 2:
                    $totalPendapatan['idpackage_2'] += 600000;
                    break;
                case 3:
                    $totalPendapatan['idpackage_3'] += 1100000;
                    break;

                default:

                    break;
            }

            // Tambahkan ke total keseluruhan pendapatan
            $totalPendapatanKeseluruhan += $totalPendapatan['idpackage_' . $order['idpackage']];
        }

        $data['laporan'] = $laporan;
        $data['totalPendapatan'] = $totalPendapatan;
        $data['totalPendapatanKeseluruhan'] = $totalPendapatanKeseluruhan;
        return view('ViewLaporanBulanan', $data);
    }
    public function lihathasil()
    {
        $orderModel = new OrderModel();
        $memberModel = new MemberModel();

        $data['jumlah_member_terjual'] = $orderModel->getJumlahMemberTerjual();
        $data['pendapatan_keanggotaan'] = $orderModel->getPendapatanKeanggotaan();
        $data['jumlah_member_aktif'] = $memberModel->getJumlahMemberAktif();
        $data['jumlah_member_tidak_aktif'] = $memberModel->getJumlahMemberTidakAktif();
        $data['tren_pertumbuhan'] = $this->calculateTrenPertumbuhan($data['jumlah_member_aktif'], $data['jumlah_member_tidak_aktif']);

        return view('DashboardPemilik', $data);
    }
    private function calculateTrenPertumbuhan($jumlahAktif, $jumlahTidakAktif)
    {
        $totalMember = $jumlahAktif + $jumlahTidakAktif;

        if ($totalMember === 0) {
            return 0;
        }

        return ($jumlahTidakAktif / $totalMember) * 100;
    }
}
