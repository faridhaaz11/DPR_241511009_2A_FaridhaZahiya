<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4 mx-auto" style="max-width: 500px;">
    <div class="card-header">
        <h4>Ubah Data Penggajian</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="/anggota/updatePenggajian/<?= $penggajian['id_anggota'] ?>/<?= $penggajian['id_komponen_gaji'] ?>">
            <div class="mb-3">
                <label for="id_anggota" class="form-label">ID Anggota</label>
                <select name="id_anggota" id="id_anggota" class="form-select" required disabled>
                    <option value="<?= $penggajian['id_anggota'] ?>"><?= $penggajian['id_anggota'] ?> - <?= $penggajian['nama_depan'] ?? '' ?> <?= $penggajian['nama_belakang'] ?? '' ?> (<?= $penggajian['jabatan'] ?? '' ?>)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_komponen_gaji" class="form-label">Komponen Gaji</label>
                <select name="id_komponen_gaji" id="id_komponen_gaji" class="form-select" required>
                    <?php foreach ($komponen as $k): ?>
                        <option value="<?= $k['id_komponen_gaji'] ?>" <?= $k['id_komponen_gaji'] == $penggajian['id_komponen_gaji'] ? 'selected' : '' ?>>
                            <?= $k['nama_komponen'] ?> (<?= $k['jabatan'] ?>, Rp <?= number_format($k['nominal'], 2) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>