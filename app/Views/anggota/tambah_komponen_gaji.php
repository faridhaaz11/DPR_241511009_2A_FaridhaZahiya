<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4 mx-auto" style="max-width: 500px;">
    <div class="card-header">
        <h4 class="fw-bold">Tambah Komponen Gaji</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/anggota/saveKomponenGaji">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="id_komponen_gaji" class="form-label">ID Komponen</label>
                <input type="number" name="id_komponen_gaji" id="id_komponen_gaji" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama_komponen" class="form-label">Nama Komponen</label>
                <input type="text" name="nama_komponen" id="nama_komponen" class="form-control" value="<?= set_value('nama_komponen') ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Gaji Pokok" <?= set_value('kategori') === 'Gaji Pokok' ? 'selected' : '' ?>>Gaji Pokok</option>
                    <option value="Tunjangan Melekat" <?= set_value('kategori') === 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                    <option value="Tunjangan Lain" <?= set_value('kategori') === 'Tunjangan Lain' ? 'selected' : '' ?>>Tunjangan Lain</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-select" required>
                    <option value="">Pilih Jabatan</option>
                    <option value="Ketua" <?= set_value('jabatan') === 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                    <option value="Wakil Ketua" <?= set_value('jabatan') === 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                    <option value="Anggota" <?= set_value('jabatan') === 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                    <option value="Semua" <?= set_value('jabatan') === 'Semua' ? 'selected' : '' ?>>Semua</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal (Rp)</label>
                <input type="number" name="nominal" id="nominal" class="form-control" step="0.01" value="<?= set_value('nominal') ?>" required>
            </div>
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select name="satuan" id="satuan" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Bulan" <?= set_value('satuan') === 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                    <option value="Hari" <?= set_value('satuan') === 'Hari' ? 'selected' : '' ?>>Hari</option>
                    <option value="Periode" <?= set_value('satuan') === 'Periode' ? 'selected' : '' ?>>Periode</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>