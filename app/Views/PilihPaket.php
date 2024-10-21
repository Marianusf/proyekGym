<?= $this->extend('layout/TemplateMember'); ?>

<?= $this->section('contentMember'); ?>
<link href="<?= base_url('css/MenuPembayaran1.css') ?>" rel="stylesheet">

<!DOCTYPE html>
<html>

<head>
    <title>Choose Package</title>
</head>

<body>
    <div class="header" style="margin-top: 20px;">
        <h1>PILIHAN MEMBERSHIP GYM-GO</h1>
    </div>
    <div class="container-fluid" id="main-content">

        <div class="main">
            <?php if (session()->getFlashdata('pemesanan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pemesanan'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('gagalpesananpaket')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('gagalpesananpaket'); ?>
                </div>
            <?php endif; ?>

            <div class="membership-options">
                <div class="bulan selected" id="one-month-option">
                    <div class="membership-option" id="one-month"><i class="fas fa-chess-rook fa-3x"></i>
                        <h3>1 Bulan</h3>
                        <p><b>Harga: Rp 210000</b></p>
                    </div>
                </div>

                <div class="bulan" id="three-months-option">
                    <div class="membership-option" id="three-months"><i class="fas fa-chess-queen fa-3x"></i>
                        <h3>3 Bulan</h3>
                        <p><b>Harga: Rp 600000</b></p>
                    </div>
                </div>

                <div class="bulan" id="six-months-option">
                    <div class="membership-option" id="six-months"><i class="fas fa-chess-king fa-3x"></i>
                        <h3>6 Bulan</h3>
                        <p><b>Harga: Rp 1100000</b></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="membership-options" style="color: white;">
            <form id="membership-form" action="/membership/order" method="post" style="background-color: #332f64;">

                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="package">Pilih Paket:</label>
                    <select class="form-control" name="package_id" id="package">
                        <option value="1">1 Bulan - Rp 210000</option>
                        <option value="2">3 Bulan - Rp 600000</option>
                        <option value="3">6 Bulan - Rp 1100000</option>
                    </select>
                </div>

                <div class="details">
                    <p id="purchase-detail">Pembelian: Paket 1 Bulan</p>
                    <p id="price-detail">Rp 210000</p>
                </div>

                <!-- Clue nya dibawah -->
                <div class="code" id="code-container" style="display:none;">
                    <input type="hidden" id="unique_code" name="unique_code">
                </div>

                <div class="buttons">
                    <button type="button" id="proceed-button" class="btn btn-primary">Proses Order Membership</button>
                </div>
            </form>
        </div>

        <?php if (session()->getFlashdata('pemesanan2')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pemesanan2'); ?>
            </div>
        <?php endif; ?>

        <form class="membership-options1" id="validation-form" action="/payment/validate" method="post" style="color: white;background-color: #332f64;">
            <?= csrf_field() ?>
            <div class="container-fluid confirm">
                <h5>Setelah Process Order selesai, Silahkan Meminta Kode Unik Kepada Admin di Gym</h5>
                <div class="form-group" style="display: flex; align-items: center;">

                    <label for="unique_code_input" style="flex-wrap: auto;">Masukkan Kode Unik:</label>

                    <input class="form-control" type="text" id="unique_code_input" name="unique_code_input" required style="flex: auto;">

                    <button class="btn btn-primary" type="submit" style="flex: auto; width: 400px; margin-left: 20px;" onclick="return confirmValidation()">Validasi pembayaran</button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = document.querySelectorAll('.membership-option');
            const packageSelect = document.getElementById('package');
            const purchaseDetail = document.getElementById('purchase-detail');
            const priceDetail = document.getElementById('price-detail');
            const proceedButton = document.getElementById('proceed-button');
            const codeContainer = document.getElementById('code-container');
            const uniqueCodeInput = document.getElementById('unique_code');

            options.forEach(option => {
                option.addEventListener('click', () => {
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    updateDetails(option.id);
                });
            });

            packageSelect.addEventListener('change', function() {
                updateDetails(packageSelect.value);
            });

            function updateDetails(selection) {
                let packageValue = selection;
                switch (selection) {
                    case 'one-month':
                    case '1':
                        packageValue = '1';
                        packageSelect.value = "1";
                        purchaseDetail.innerText = 'Pembelian: Paket 1 Bulan';
                        priceDetail.innerText = 'Harga: Rp 210000';
                        break;
                    case 'three-months':
                    case '2':
                        packageValue = '2';
                        packageSelect.value = "2";
                        purchaseDetail.innerText = 'Pembelian: Paket 3 Bulan';
                        priceDetail.innerText = 'Harga: Rp 600000';
                        break;
                    case 'six-months':
                    case '3':
                        packageValue = '3';
                        packageSelect.value = "3";
                        purchaseDetail.innerText = 'Pembelian: Paket 6 Bulan';
                        priceDetail.innerText = 'Harga: Rp 1100000';
                        break;
                    default:
                        packageValue = '2';
                        packageSelect.value = "2";
                        purchaseDetail.innerText = 'Pembelian: Paket Tidak Diketahui';
                        priceDetail.innerText = 'Harga: -';
                        break;
                }

                // Update the selected class on the membership-option divs
                const allMonths = document.querySelectorAll('.bulan');
                allMonths.forEach(month => month.classList.remove('selected'));
                const selectedOption = document.getElementById(`${packageValue === '1' ? 'one-month-option' : packageValue === '2' ? 'three-months-option' : 'six-months-option'}`);
                if (selectedOption) {
                    selectedOption.classList.add('selected');
                }
            }

            proceedButton.addEventListener('click', () => {
                document.getElementById('membership-form').submit();
                // Generate a unique code for the payment
                const code = Math.floor(100000 + Math.random() * 900000).toString();
                uniqueCodeInput.value = code;

                // Show the validation form
                document.getElementById('validation-form').style.display = 'block';
            });

            updateDetails(packageSelect.value);
        });
    </script>
    <script>
        document.getElementById('proceed-button').addEventListener('click', function() {
            var confirmation = confirm("Apakah Anda yakin ingin memproses order membership ini?");

            if (confirmation) {
                processMembership();
            }
        });

        function processMembership() {
            console.log("Proses order membership dilakukan!");
        }
    </script>
    <script>
        function confirmValidation() {

            var confirmation = confirm("Apakah Anda yakin ingin melakukan validasi pembayaran?");
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>

<?= $this->endSection(); ?>