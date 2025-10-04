<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Daftar Data Penggajian</h4>
        <a href="/anggota/tambahPenggajian" class="btn btn-primary">Tambah Penggajian</a>
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
                    <th>Aksi</th>
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
                            <td>
                                <a href="/anggota/editPenggajian/<?= $p['id_anggota'] ?>/<?= $p['id_komponen_gaji'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="/anggota/deletePenggajian/<?= $p['id_anggota'] ?>/<?= $p['id_komponen_gaji'] ?>" method="post" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <a href="/anggota/detailPenggajian/<?= $p['id_anggota'] ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>