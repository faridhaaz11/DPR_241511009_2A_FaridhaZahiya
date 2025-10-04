<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Daftar Data Penggajian</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Gelar Depan</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Gelar Belakang</th>
                    <th>Jabatan</th>
                    <th>Take Home Pay (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($penggajian)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data penggajian.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($penggajian as $p): ?>
                        <tr>
                            <td><?= $p['id_anggota'] ?></td>
                            <td><?= $p['gelar_depan'] ?? '-' ?></td>
                            <td><?= $p['nama_depan'] ?></td>
                            <td><?= $p['nama_belakang'] ?></td>
                            <td><?= $p['gelar_belakang'] ?? '-' ?></td>
                            <td><?= $p['jabatan'] ?></td>
                            <td><?= number_format($p['take_home_pay'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>