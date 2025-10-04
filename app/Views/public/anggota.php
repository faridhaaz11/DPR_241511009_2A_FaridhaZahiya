<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Data Anggota DPR</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Gelar Depan</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Gelar Belakang</th>
                    <th>Jabatan</th>
                    <th>Status Pernikahan</th>
                    <th>Jumlah Anak</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anggota)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data anggota.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($anggota as $a): ?>
                        <tr>
                            <td><?= $a['id_anggota'] ?></td>
                            <td><?= $a['gelar_depan'] ?? '-' ?></td>
                            <td><?= $a['nama_depan'] ?></td>
                            <td><?= $a['nama_belakang'] ?></td>
                            <td><?= $a['gelar_belakang'] ?? '-' ?></td>
                            <td><?= $a['jabatan'] ?></td>
                            <td><?= $a['status_pernikahan'] ?></td>
                            <td><?= $a['jumlah_anak'] ?? 0 ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>