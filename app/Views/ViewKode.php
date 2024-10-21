<?= $this->extend('layout/TemplateAdmin'); ?>
<?= $this->section('contentAdmin'); ?>
<link rel="stylesheet" href="<?= base_url('css/StylePemilik.css') ?>">
</head>

<body>
    <div class="container mt-4">
        <div class="header">
            <h2>Permintaan Pemesanan Membership</h2>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Member</th>
                    <th>ID Package</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Unique Code</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pendingOrders)) : ?>
                    <?php foreach ($pendingOrders as $order) : ?>
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
                        <td colspan="5" class="text-center">No pending orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
    <form action="/dashboardadmin">
        <div class="mt-5">
            <button class="btn btn-danger me-4">Kembali</button>
        </div>
    </form>
    <?= $this->endSection(); ?>