<?= $this->extend('layout/TemplateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>
<link href="<?= base_url('css/AdminView.css') ?>" rel="stylesheet">

<div class="header">
    <h1 class="ml-3"><?= $title ?></h1>
</div>
<div class="container-fluid">
    <?php if (session()->getFlashdata('presensiin')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('presensiin'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('hpspresensi')) : ?> <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('hpspresensi'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('gagalhapuspresensi')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('gagalhapuspresensi'); ?>
        </div>
    <?php endif; ?>
</div>
<div class="container-fluid">
    <div class="container form-container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <label for="jumlahtampilan" class="mr-2 mb-0">Jumlah Tampilan</label>
                <div class="dropdown-container">
                    <select id="jumlahtampilan" class="form-control form-control-inline">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Presensi</th>
                    <th>ID Member</th>
                    <th>Jam Masuk</th>
                    <th>Status</th>
                    <th>ID Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($presensiModel) && is_array($presensiModel)) : ?>
                    <?php foreach ($presensiModel as $presensi) : ?>
                        <tr>
                            <td><?= $presensi['idpresensi'] ?></td>
                            <td><?= $presensi['idmember'] ?></td>
                            <td><?= $presensi['jam_masuk'] ?></td>
                            <td><?= $presensi['status'] ?></td>
                            <td><?= $presensi['idadmin'] ?></td>
                            <td>
                                <a href="/presensi/hapus/<?= $presensi['idpresensi'] ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Tidak ada data presensi.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <form action="/dashboardadmin">
            <div class="mt-7">
                <button class="btn btn-danger me-4">Kembali</button>
            </div>
        </form>
    </div>

</div>

<script>
    function confirmDelete(event) {
        event.preventDefault();
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data presensi ini?");
        if (confirmation) {
            var url = event.target.href;
            window.location.href = url;
        } else {
            return false;
        }
    }
</script>
<?= $this->endSection(); ?>