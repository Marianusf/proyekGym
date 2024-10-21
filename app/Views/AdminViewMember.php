<?= $this->extend('layout/TemplateAdmin'); ?>

<?= $this->section('contentAdmin'); ?>

<link href="<?= base_url('css/AdminView.css') ?>" rel="stylesheet">
<div class="header">
    <h1 class="ml-3">Daftar Member Gym-Go</h1>
</div>
<div class="container-fluid">
    <?php if (session()->getFlashdata('sukseshapus')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukseshapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('gagalhapus')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('gagalhapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('presensiin')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('presensiin'); ?>
        </div>
    <?php endif; ?>
</div>
<div class="container-fluid" style="border-radius: 5px; border: 1px solid black; margin-top: 20px;">
    <div class="container form-container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <label for="jumlahtampilan" class="mr-2 mb-0">Jumlah Tampilan</label>
                <div class="dropdowm-container">
                    <!-- Jumlah Tampilan Dropdown -->
                    <select id="jumlahtampilan" class="form-control form-control-inline">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
            </div>
        </div>
    </div>

    <ol class="list-group">
        <?php if (!empty($members) && is_array($members)) : ?>
            <!-- Judul kolom -->
            <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center font-weight-bold">
                <div class='col-1 text-center'>No.</div>
                <div class='col'>Id Member</div>
                <div class='col'>Username</div>
                <div class='col'>Nama Lengkap</div>
                <div class='col'>Status Membership</div>
                <div class='col'>Tanggal Berakhir Membership</div>
                <div class='col'>Tindakan</div>
            </li>

            <!-- Data member -->
            <?php $index = 1; ?>
            <?php foreach ($members as $member) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <!-- Nomor -->
                    <div class='col-1 text-center'><?= $index ?></div>
                    <!-- Data Member -->
                    <div class='col'><?= esc($member['idmember']) ?></div>
                    <div class='col'><?= esc($member['username']) ?></div>
                    <div class='col'><?= esc($member['full_name']) ?></div>
                    <div class='col'><?= esc($member['membership_status']) ?></div>
                    <div class='col'><?= esc($member['membership_end_date']) ?></div>
                    <div class='col-2 text-end'>
                        <?php if ($member['membership_status'] == 'active') : ?>
                            <a href="<?= base_url('/admin/catatpresensi/' . esc($member['idmember']) . '/' . esc(session()->get('idadmin'))) ?>" class="btn btn-success btn-sm me-2" onclick="return handlePresensiClick(event)">
                                Presensi
                            </a>
                        <?php endif; ?>
                        <a href="<?= base_url('/admin/deleteMember/' . esc($member['idmember'])) ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">Hapus</a>
                    </div>

                </li>
                <?php $index++; ?>
            <?php endforeach ?>
        <?php else : ?>
            <li class="list-group-item">Tidak ada data member.</li>
        <?php endif ?>
    </ol>
    <form action="/dashboardadmin">
        <div class="mt-7">
            <button class="btn btn-danger me-4">Kembali</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('jumlahtampilan').addEventListener('change', function() {
        const jumlahTampilan = this.value;
        window.location.href = `<?= base_url('/lihatmember') ?>?limit=${jumlahTampilan}`;
    });
</script>
<script>
    document.getElementById('hapusLink').addEventListener('click', function(event) {

        event.preventDefault();

        var confirmation = confirm("Apakah Anda yakin ingin menghapus member ini?");

        if (confirmation) {
            // Ambil href dari tautan
            var url = this.getAttribute('href');

            // Arahkan ke URL
            window.location.href = url;
        } else {
            // Jika pengguna memilih Batal (false), tidak ada tindakan yang dilakukan
            return false;
        }
    });
</script>
<script>
    function handlePresensiClick(event) {

        event.preventDefault();


        var confirmation = confirm("Apakah Anda yakin ingin mencatat presensi untuk member ini?");

        if (confirmation) {
            var url = event.target.href; // Ambil URL dari tautan yang diklik
            window.location.href = url; // Arahkan pengguna ke halaman presensi
        } else {
            // Jika pengguna memilih Batal (false), tidak ada tindakan yang dilakukan
            return false;
        }
    }
</script>
<script>
    function confirmDelete(event) {

        event.preventDefault();

        var confirmation = confirm("Apakah Anda yakin ingin menghapus member ini?");

        // Jika pengguna menekan tombol OK (true), arahkan ke halaman penghapusan
        if (confirmation) {
            var url = event.target.href;
            window.location.href = url;
        } else {

            return false;
        }
    }
</script>
<?= $this->endSection(); ?>