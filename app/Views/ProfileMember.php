<?= $this->extend('layout/TemplateMember'); ?>

<?= $this->section('contentMember'); ?>

<?php
$session = session();
$userData = $session->get();
$validation = \Config\Services::validation();
?>

<link href="<?= base_url('css/ProfileMember.css') ?>" rel="stylesheet">
<style>
    .hidden {
        display: none;
    }
</style>

<div class="header">
    <h1 style="margin: auto; text-align: center;">Member Profile</h1>
</div>
<div class="container p-3">
    <div class="row">
        <div class="col-lg-12 mb-4 mb-sm-5">
            <div class="card card-style1 border-0 gray-background">
                <div class="card-body profile-info">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                            <div class="float-start">
                                <?php if (session()->get('logged_in') && session()->get('potoprofil')) : ?>
                                    <?php
                                    $image_url = base_url('gambar/' . session()->get('potoprofil'));
                                    ?>
                                    <img src="<?= $image_url ?>" class="img-fluid" width="250" height="250">
                                <?php else : ?>
                                    <img src="/gambar/LogoGym.png">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="">
                                <h3 class="h2 mb-0"><?= $userData['full_name'] ?></h3>
                                <h4>ID Member : <?= $userData['idmember'] ?></h4>
                            </div>
                            <ul class="list-unstyled mb-1-9">
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-800">Tanggal Lahir : </span><?= $userData['birth_date'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-800">Email : </span> <?= $userData['email'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-800">Alamat : </span><?= $userData['adress'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28">
                                    <span class="display-26 text-secondary me-2 font-weight-600">Akhir Masa Berlaku : </span>
                                    <?php if (isset($userData['membership_end_date']) && !empty($userData['membership_end_date'])) : ?>
                                        <?= $userData['membership_end_date'] ?>
                                    <?php else : ?>
                                        Belum Memiliki Membership
                                    <?php endif; ?>
                                </li>
                                <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-800">Phone:</span><?= $userData['no_telepon'] ?></li>
                                <li class="edit-button">
                                    <button class="btn btn-primary" id="edit-profile-btn">Edit Profile</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="edit-profile-form" class="hidden" style="margin-top: 75px;">
                <div class="container p-5 gray-background form-edit">
                    <h2>Edit Profile Member</h2>
                    <?php if (session()->getFlashdata('pesanupdate')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesanupdate'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="/profile/editmember/<?= $userData['idmember']; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="old_poto" value="<?= $userData['potoprofil']; ?>">
                        <div class="form-group row">
                            <label for="username" class="col-sm-2-form-label">Username:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Masukkan Username" autofocus value="<?= old('username', $userData['username']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2-form-label">Email:</label>
                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Masukkan email" value="<?= old('email', $userData['email']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2-form-label">Nama Lengkap:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= old('nama', $userData['full_name']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2-form-label">Password:</label>
                            <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Masukkan password" value="<?= old('password', $userData['password']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="UlangPsw" class="col-sm-2-form-label">Ulangi Password:</label>
                            <input type="password" class="form-control <?= ($validation->hasError('UlangPsw')) ? 'is-invalid' : '' ?>" id="UlangPsw" name="UlangPsw" placeholder="Ulangi password" value="<?= old('UlangPsw', $userData['password']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('UlangPsw') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="noTelp" class="col-sm-2-form-label">No Telp:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('noTelp')) ? 'is-invalid' : '' ?>" id="noTelp" name="noTelp" placeholder="Masukkan No Telepon" value="<?= old('noTelp', $userData['no_telepon']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('noTelp') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-2-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir', $userData['birth_date']); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_lahir') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2-form-label">Alamat:</label>
                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Masukkan alamat"><?= old('alamat', $userData['adress']); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="poto" class="form-label <?= ($validation->hasError('poto')) ? 'is-invalid' : '' ?>">Upload Foto Profil :</label>
                            <input class="form-control" type="file" id="poto" name="poto">
                            <div class="invalid-feedback">
                                <?= $validation->getError('poto') ?>
                            </div>
                        </div>

                        <div style="text-align: center; margin-bottom: -20px;">
                            <button type="submit" class="btn btn-primary" style="text-align: center;" onclick="return confirmSubmission()">Simpan Perubahan</button>
                            <button type="button" class="btn" id="cancel-edit" style="text-align: center; background-color: red; color: white;">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('edit-profile-btn').addEventListener('click', function() {
        document.getElementById('edit-profile-form').classList.toggle('hidden');
    });

    document.getElementById('cancel-edit').addEventListener('click', function() {
        document.getElementById('edit-profile-form').classList.add('hidden');
    });
</script>
<script>
    function confirmSubmission() {

        var confirmation = confirm("Apakah Anda yakin ingin menyimpan perubahan ini?");

        if (confirmation) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?= $this->endSection(); ?>