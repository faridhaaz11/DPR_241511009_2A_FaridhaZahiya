<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4 mx-auto" style="max-width: 500px;">
    <div class="card-header">
        <h4>Tambah Data Anggota DPR</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= site_url('anggota/save') ?>">
            <?= csrf_field() ?> 
            <div class="mb-3">
                <label for="id_anggota" class="form-label">ID Anggota</label>
                <input type="number" name="id_anggota" id="id_anggota" class="form-control" value="<?= set_value('id_anggota') ?>" required>
            </div>
            <div class="mb-3">
                <label for="gelar_depan" class="form-label">Gelar Depan</label>
                <input type="text" name="gelar_depan" id="gelar_depan" class="form-control" value="<?= set_value('gelar_depan') ?>">
            </div>
            <div class="mb-3">
                <label for="nama_depan" class="form-label">Nama Depan</label>
                <input type="text" name="nama_depan" id="nama_depan" class="form-control" value="<?= set_value('nama_depan') ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" value="<?= set_value('nama_belakang') ?>" required>
            </div>
            <div class="mb-3">
                <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control" value="<?= set_value('gelar_belakang') ?>">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-select" required>
                    <option value="Ketua" <?= set_select('jabatan', 'Ketua') ?>>Ketua</option>
                    <option value="Wakil Ketua" <?= set_select('jabatan', 'Wakil Ketua') ?>>Wakil Ketua</option>
                    <option value="Anggota" <?= set_select('jabatan', 'Anggota') ?>>Anggota</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                <select name="status_pernikahan" id="status_pernikahan" class="form-select" required>
                    <option value="Kawin" <?= set_select('status_pernikahan', 'Kawin') ?>>Kawin</option>
                    <option value="Belum Kawin" <?= set_select('status_pernikahan', 'Belum Kawin') ?>>Belum Kawin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                <input type="number" name="jumlah_anak" id="jumlah_anak" class="form-control" value="<?= set_value('jumlah_anak') ?>" min="0" max="10">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
