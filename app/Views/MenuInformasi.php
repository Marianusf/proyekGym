<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM GO</title>
    <link href="<?= base_url('css/MenuInformasi.css') ?>" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background: url("/gambar/bgAwal.png") no-repeat center center/cover;
            padding: 50px 0;
            background-repeat: no-repeat;
            background-size: cover;
            /* Menyesuaikan ukuran gambar agar menutupi seluruh latar belakang */
            background-attachment: fixed;
            /* Membuat latar belakang tetap */
            background-position: center;
        }
    </style>
</head>

<body style="height:2000px">
    <nav class="container-fluid navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: rgb(6, 6, 50);">
        <div>
            <a class="navbar-brand">
                <img src="<?= base_url('gambar/LogoGym.png') ?>" alt="logo">
            </a>
        </div>
        <div class="judul container-fluid text-center">
            <h1>Energy is for everyone!</h1>
        </div>
        <div class="navbar-nav ml-auto">
            <div class="nav-item">
                <a class="nav-link" href="/registrasiview" style="color: black;font-size: 18px;">Register</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/login" style="color: black;font-size: 18px;">Login</a>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="info">
            <div class="logo">
                <img src="/gambar/LogoGym.png" alt="Gym GO Logo">
                <h1>GYM-GO</h1>
                <h2>HEALTHY LIFE</h2>
            </div>
            <div class="details">
                <header>
                    <h1 style="color: yellow;">Welcome To Gym-Go</h1>
                    <br>
                    <h5>GYM GO Untuk Pria dan Wanita</h5>
                    <p>Pusat Kebugaran Stamina Gym menyediakan pelatihan dan pengkondisian yang tepat bagi para anggota
                        yang
                        ingin meningkatkan dan mengubah tubuh mereka dengan program yang tergantung pada komposisi
                        tubuh.
                    </p>
                    <div class="hours">
                        <h4>07.00 s/d 21.00</h4>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <td>Alamat</td>
                                <td> : Jalan Kaki Saja No.69</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : gymgo@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td> : 080808080808</td>
                            </tr>
                        </table>
                    </div>
                    <div class="social-media">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
            </div>
        </div>

        <div class="foto">
            <img src="<?= base_url('gambar/Fotogym.jpg') ?>" class="float-left img-fluid rounded" alt="Paris" width="304" height="236" style="background-color: black;">
            <img src="<?= base_url('gambar/Fotogym2.jpg') ?>" class="float-center img-fluid rounded" alt="Paris" width="304" height="236" style="background-color: black;">
            <img src="<?= base_url('gambar/fotogym3.jpg') ?>" class="float-right img-fluid rounded" alt="Paris" width="304" height="236" style="background-color: black;">

        </div>

        <div class="announcement">
            <p>Pengumuman: Tanggal 17 Juni 2024 Gym tidak buka dikarenakan libur Idul Adha <i class="material-icons">&#xe85a;</i></p>
        </div>

        <div class="membership-options row">
            <div>
                <h1>Paket <br>Membership</h1>
            </div>

            <div class="bulan1 col" id="one-month">
                <i class="fas fa-user-shield fa-3x"></i>
                <h3>1 Bulan</h3>
            </div>
            <div class="bulan3 col" id="three-months">
                <i class="fas fa-crown fa-3x"></i>
                <h3>3 Bulan</h3>
            </div>
            <div class="bulan6 col" id="six-months">
                <i class="fas fa-crown fa-3x"></i>
                <h3>6 Bulan</h3>
            </div>
        </div>
        <div class="menu">
            <a href="/login" class="btn btn-primary btn-lg" style="background-color: #FFE600;border-color: #FFE600; color: black; width: 500px; font-size: 42px; border-radius: 10px;">Join Sekarang!!</a>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>