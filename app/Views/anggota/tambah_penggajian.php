<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4 mx-auto" style="max-width: 500px;">
    <div class="card-header">
        <h4 class="fw-bold">Tambah Data Penggajian</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/anggota/savePenggajian">
            <div class="mb-3">
                <label for="id_anggota" class="form-label">ID Anggota</label>
                <select name="id_anggota" id="id_anggota" class="form-select" required>
                    <option value="">Pilih Anggota</option>
                    <?php foreach ($anggota as $a): ?>
                        <option value="<?= $a['id_anggota'] ?>"><?= $a['id_anggota'] ?> - <?= $a['nama_depan'] ?> <?= $a['nama_belakang'] ?> (<?= $a['jabatan'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_komponen_gaji" class="form-label">Komponen Gaji</label>
                <select name="id_komponen_gaji" id="id_komponen_gaji" class="form-select" required>
                    <option value="">Pilih Komponen Gaji</option>
                    <?php foreach ($komponen as $k): ?>
                        <option value="<?= $k['id_komponen_gaji'] ?>"><?= $k['nama_komponen'] ?> (<?= $k['jabatan'] ?>, Rp <?= number_format($k['nominal'], 2) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>