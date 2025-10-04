<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Daftar Komponen Gaji</h4>
        <a href="/anggota/tambahKomponenGaji" class="btn btn-primary">Tambah Komponen</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Komponen</th>
                    <th>Nama Komponen</th>
                    <th>Kategori</th>
                    <th>Jabatan</th>
                    <th>Nominal</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($komponen)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data komponen gaji.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($komponen as $k): ?>
                        <tr>
                            <td><?= $k['id_komponen_gaji'] ?></td>
                            <td><?= $k['nama_komponen'] ?></td>
                            <td><?= $k['kategori'] ?></td>
                            <td><?= $k['jabatan'] ?></td>
                            <td><?= number_format($k['nominal'], 2) ?></td>
                            <td><?= $k['satuan'] ?></td>
                            <td>
                                <a href="/anggota/editKomponenGaji/<?= $k['id_komponen_gaji'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/anggota/deleteKomponenGaji/<?= $k['id_komponen_gaji'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>