<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>

<h2 class="fw-bold">Detail Penggajian Anggota</h2>

<div class="card">
    <div class="card-body">
        <h4><?= esc($anggota['gelar_depan'] . ' ' . $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] . ' ' . $anggota['gelar_belakang']) ?></h4>
        <p><strong>Jabatan:</strong> <?= esc($anggota['jabatan']) ?></p>
    </div>
</div>

<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Komponen</th>
            <th>Kategori</th>
            <th>Nominal</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($penggajian)): ?>
            <?php foreach ($penggajian as $pg): ?>
                <tr>
                    <td><?= esc($pg['nama_komponen']) ?></td>
                    <td><?= esc($pg['kategori']) ?></td>
                    <td>Rp <?= number_format($pg['nominal'], 0, ',', '.') ?></td>
                    <td><?= esc($pg['satuan']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" class="text-center">Belum ada komponen gaji</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<h4 class="text-end">Total Take Home Pay: Rp <?= number_format($total, 0, ',', '.') ?></h4>

<a href="/anggota/lihatPenggajian" class="btn btn-secondary">Kembali</a>

<?= $this->endSection() ?>
