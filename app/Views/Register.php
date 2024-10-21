<!DOCTYPE html>
<html lang="id">
<?php $validation = \Config\Services::validation(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/Register.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="img">
            <img src="<?= base_url('gambar/LogoGym.png') ?>" alt="Pemilik Gym">
        </div>
        <h1 class="text-center">Registrasi Gym-Go</h1>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/registermember" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group row">
                <label for="username" class="col-sm-2-form-label">Username:</label>
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Masukkan Username" autofocus value="<?= old('username'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('username') ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2-form-label">Email:</label>
                <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Masukkan email" value="<?= old('email'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2-form-label">Nama Lengkap:</label>
                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= old('nama'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2-form-label">Password:</label>
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Masukkan password">
                <div class="invalid-feedback">
                    <?= $validation->getError('password') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="UlangPsw" class="col-sm-2-form-label">Konfirmasi Password:</label>
                <input type="password" class="form-control <?= ($validation->hasError('UlangPsw')) ? 'is-invalid' : '' ?>" id="UlangPsw" name="UlangPsw" placeholder="Ulangi password">
                <div class="invalid-feedback">
                    <?= $validation->getError('UlangPsw') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="noTelp" class="col-sm-2-form-label">Nomor Telepon:</label>
                <input type="text" class="form-control <?= ($validation->hasError('noTelp')) ? 'is-invalid' : '' ?>" id="noTelp" name="noTelp" placeholder="Masukkan No Telepon" value="<?= old('noTelp'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('noTelp') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_lahir" class="col-sm-2-form-label">Tanggal Lahir:</label>
                <input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_lahir') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2-form-label">Alamat:</label>
                <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" placeholder="Masukkan alamat" value="<?= old('username'); ?>"></textarea>
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
            <button type="submit" class="btn btn-primary btn-block" style="width: 370px;" onclick="return confirmRegistration()">Registrasi</button>
        </form>
        <form action="/login" method="post">
            <button type="submit" class="btn btn-secondary btn-succes" style="width:370px;">Login</button=>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmRegistration() {
            var confirmation = confirm("Apakah Anda yakin ingin melakukan registrasi?");
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>