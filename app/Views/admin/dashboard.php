<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Dashboard Admin</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <p>Selamat datang di dashboard admin. Pilih menu di bawah ini untuk mengelola data:</p>
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <a href="/anggota" class="btn btn-primary btn-lg w-100" style="background-color: #003366; border-color: #003366;">
                    Kelola Data Anggota DPR
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/anggota/lihatKomponenGaji" class="btn btn-primary btn-lg w-100" style="background-color: #003366; border-color: #003366;">
                    Kelola Komponen Gaji & Tunjangan
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="/penggajian" class="btn btn-primary btn-lg w-100" style="background-color: #003366; border-color: #003366;">
                    Kelola Data Penggajian
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
