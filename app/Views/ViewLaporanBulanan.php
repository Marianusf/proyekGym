<?= $this->extend('layout/TemplatePemilik'); ?>
<?= $this->section('contentPemilik'); ?>

<link rel="stylesheet" href="<?= base_url('css/StylePemilik.css') ?>">
<div class="container-fluid mt-4">
    <div class="header">
        <h1 class="">Laporan Pendapatan</h1>
    </div>
    <table class="table table-striped" style="border: 1px solid black;">
        <thead>
            <tr>
                <th>ID Member</th>
                <th>ID Package</th>
                <th>Tanggal Pemesanan</th>
                <th>Status</th>
                <th>Unique Code</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laporan)) : ?>
                <?php foreach ($laporan as $order) : ?>
                    <tr>
                        <td><?= $order['idmember']; ?></td>
                        <td><?= $order['idpackage']; ?></td>
                        <td><?= $order['order_date']; ?></td>
                        <td><?= $order['status']; ?></td>
                        <td><?= $order['unique_code']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak Ada Permintaan Pemesanan</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
    <div class="container">
        <div class="row container p-2">
            <div class="col-md-6 card-body">
                <div class="cardLaporan p-5">
                    <h3>TOTAL PENDAPATAN GYM-GO</h3>
                    <p>Rp <?= $totalPendapatanKeseluruhan ?></p>
                </div>
            </div>

            <div class="col-md-6 card-body">
                <div class="cardLaporan p-3">
                    <h3>Total Pendapatan per Paket:</h3>
                    <ul>
                        <li>Paket Membership 1 Bulan : <?= $totalPendapatan['idpackage_1'] ?></li>
                        <li>Paket Membership 3 Bulan : <?= $totalPendapatan['idpackage_2'] ?></li>
                        <li>Paket Membership 6 Bulan : <?= $totalPendapatan['idpackage_3'] ?></li>
                    </ul>
                </div>
            </div>
            <form action="/pemilik/lihathasil">
                <div class="mt-4">
                    <button class="btn btn-danger me-4">Kembali</button>
                </div>
            </form>
        </div>

    </div>

</div>

<?= $this->endSection(); ?>