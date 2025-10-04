<?= $this->extend('template/template') ?>  

<?= $this->section('content') ?>
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-bold">Dashboard Public</h4>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <p>Selamat datang di dashboard public. Anda dapat melihat data Anngota DPR:</p>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <a href="/anggota" class="btn btn-lg w-100 text-white dashboard-btn" style="background-color: #003366; border-color: #003366;">
                    Lihat Data Anggota DPR
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="/penggajian" class="btn btn-lg w-100 text-white dashboard-btn" style="background-color: #003366; border-color: #003366;">
                    Lihat Data Penggajian
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
