<?= $this->extend('layout/TemplateMember'); ?>

<?= $this->section('contentMember'); ?>
<?php
$session = session();
$userData = $session->get();
// print_r($userData);
// $path_to_image = session()->get('potoprofil'); // Gantilah dengan cara pengambilan sesi Anda

// Buat URL lengkap dari direktori gambar
// $image_url = 'public/gambar/' . $path_to_image; // Sesuaikan dengan URL base dan struktur direktori Anda

// Tampilkan gambar menggunakan tag <img>

?>
<div class="dashboard">
    <div class="header">
        <h2>Dashboard</h2>
    </div>
    <div class="logo">
        <img src=" <?= base_url('gambar/LogoGym.png') ?>" alt="logo" style="width: 20%;">
    </div>
    <div class="informasi-pemilik">
        <h3 style="text-align: center;">Informasi Member</h3>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="float-start">
                                    <?php if (session()->get('logged_in') && session()->get('potoprofil')) : ?>
                                        <?php
                                        $image_url = base_url('gambar/' . session()->get('potoprofil'));
                                        ?>
                                        <img src="<?= $image_url ?>" alt="Foto Profil" style="width: 150px;">
                                    <?php else : ?>
                                        <p>Gambar profil tidak ditemukan.</p>
                                    <?php endif; ?>
                                </div>
                                <form action="/profile">
                                    <input type="submit" name="keProfile" id="profile" value="Lihat Profil Anda" class="btn btn-secondary">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h6 class="card-title"><?= $session->get('full_name') ?></h6>
                                <h7>Email : <?= $session->get('email') ?></h7>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Second Column -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Status Member
                            <span class="badge <?= ($session->get('membership_status') === 'active') ? 'badge-success' : 'badge-danger' ?>">
                                <?= $session->get('membership_status') ?>
                            </span>
                        </h6>
                        <h5><?= $session->get('membership_end_date') ?></h5>
                        <form action="/membershippesan">
                            <input type="submit" name="keMembership" value="Beli Membership" class="btn btn-secondary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard">
    <div class="informasi-pemilik">
        <h5>Tentang Kami</h5>
        <div class="row  container p-4">
            <div class="about col-sm-6">
                <div class="info">
                    <h6>Hubungi Kami</h6>
                </div>
                <div>
                    <ul style="list-style-type: none;">
                        <li><i class="bi bi-telephone"></i> 081264378293 (Agus)</li>
                        <li><i class="bi bi-envelope"></i> <a href="">gymgogogo@yahoo.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="about col-sm-6">
                <div class="info">
                    <h6>Lokasi</h6>
                </div>
                <div>
                    <p><i class="bi bi-geo-alt"></i> Komp. Ruko Bintan Center Blok O No. 10-11 Lt 2
                        Kota Tanjungpinang, Kepualauan Riau</p>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>