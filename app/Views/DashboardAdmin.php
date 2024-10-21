<?= $this->extend('layout/TemplateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>
<link href="<?= base_url('css/DashboardAdmin.css') ?>" rel="stylesheet">
<?php
$session = session();
$userData = $session->get();
?>
<div class="container-fluid" id="main-content">

    <div id="dashboard" class="content-section" style="padding-left:35px;">
        <div class="header">
            <h1 class="ml-3">Dashboard</h1>
        </div>
        <div class="container">
            <h2><?= $session->get('email') ?></h2>
            <h3><?= $session->get('username') ?></h3>
            <br>
        </div>

        <div class="packages container">
            <div class="row justify-content-center" style="border: 2px solid skyblue; border-radius: 10px; padding: 15px; background-color: #ffe600;">
                <div class="col-md-4">
                    <button class="container text-white" style="width: 250px; height: 250px; background-color:#1a1363; border-radius: 10px;">
                        <i class="fas fa-chess-rook" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">1 Bulan</h5>
                        <p>Harga : Rp 210,000,-</p>
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="container text-white" style="width: 250px; height: 250px;background-color:#1a1363;border-radius: 10px;">
                        <i class="fas fa-chess-queen" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">3 Bulan</h5>
                        <p>Harga : Rp 600,000,-</p>
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="container text-white" style="width: 250px; height: 250px;background-color:#1a1363;border-radius: 10px;">
                        <i class="fas fa-chess-king" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">6 Bulan</h5>
                        <p>Harga : 1,100,000,-</p>
                    </button>
                </div>
            </div>
        </div>


        <br><br><br><br>
        <div class="row justify-content-center">
            <form action="<?= site_url('/lihatpresensi'); ?>" method="get">
                <div class="col-md-3">
                    <button class="btn btn-lg btn-block text-white" style="width: 200px; height: 125px ;background-color :#1A1363;">
                        <i class="fas fa-chess-knight" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">Daftar presensi</h5>
                    </button>
                </div>
            </form>
            <form action="<?= site_url('/lihatmember'); ?>" method="get">
                <div class="col-md-3">
                    <button class="btn btn-lg btn-block text-white" style="width: 200px; height: 125px; background-color :#1A1363;">
                        <i class="fas fa-chess-rook" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">Data Member</h5>
                    </button>
                </div>
            </form>
            <form action="<?= site_url('admin/orders/pending'); ?>" method="get">
                <div class="col-md-3">
                    <button class="btn btn-lg btn-block text-white" style="width: 200px; height: 125px; background-color :#1A1363;">
                        <i class="fas fa-chess-king" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <h5 class="mb-0">Lihat Kode Unik </h5>
                    </button>
                </div>
            </form>
        </div>
        <br><br><br><br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2>GYM GO Untuk Pria dan Wanita</h2>
                    <p>Pusat kebugaran stamina Gym menyediakan pelatihan dan pengkondisian yang tepat bagi para anggota yang ingin meningkatkan dan mengubah tubuh mereka dengan program yang tergantung pada komposisi tubuh.</p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <p><strong>Tentang Gym Go :</strong></p>
            <p>Alamat: Jalan Kaki Saja No.69<br>
                Email: gymgo@gmail.com<br>
                Contact Number: 08080808080<br>
                Sosial Media:
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
            </p>
            <p><strong>Jam Operasional:</strong></p>
            <p>07.00 /sd 21.00</p>
        </div>

        <div class="row">
            <div class="col text-left">
                <p>Pengumuman: Tanggal 17 Juni 2024 Gym tidak buka dikarenakan libur Idul Adha</p>
            </div>
            <div class="col text-right">
                <p>Join Sekarang!</p>
            </div>
        </div>

    </div>
</div>

</div>
<?= $this->endSection(); ?>