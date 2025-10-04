<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4 mx-auto" style="max-width: 500px;">
    <div class="card-header">
        <h4>Ubah Data Anggota DPR</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/anggota/update/<?= $anggota['id_anggota'] ?>">
            <div class="mb-3">
                <label for="gelar_depan" class="form-label">Gelar Depan</label>
                <input type="text" name="gelar_depan" id="gelar_depan" class="form-control" value="<?= set_value('gelar_depan', $anggota['gelar_depan'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="nama_depan" class="form-label">Nama Depan</label>
                <input type="text" name="nama_depan" id="nama_depan" class="form-control" value="<?= set_value('nama_depan', $anggota['nama_depan']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" value="<?= set_value('nama_belakang', $anggota['nama_belakang']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control" value="<?= set_value('gelar_belakang', $anggota['gelar_belakang'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-select" required>
                    <option value="Ketua" <?= $anggota['jabatan'] === 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                    <option value="Wakil Ketua" <?= $anggota['jabatan'] === 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                    <option value="Anggota" <?= $anggota['jabatan'] === 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                <select name="status_pernikahan" id="status_pernikahan" class="form-select" required>
                    <option value="Kawin" <?= $anggota['status_pernikahan'] === 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                    <option value="Belum Kawin" <?= $anggota['status_pernikahan'] === 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                    <option value="Cerai Hidup" <?= $anggota['status_pernikahan'] === 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                    <option value="Cerai Mati" <?= $anggota['status_pernikahan'] === 'Belum Kawin' ? 'selected' : '' ?>>Cerai Mati</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                <input type="number" name="jumlah_anak" id="jumlah_anak" class="form-control" value="<?= set_value('jumlah_anak', $anggota['jumlah_anak'] ?? 0) ?>" min="0" max="10">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>