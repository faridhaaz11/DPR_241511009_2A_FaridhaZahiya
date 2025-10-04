<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Gaji DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #003366; }
        .sidebar { background-color: #e9ecef; height: 100vh; padding: 20px; border-right: 1px solid #dee2e6; }
        .content { padding: 20px; }
        .card { border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .sidebar .btn { 
            display: block; 
            width: 100%; 
            margin-bottom: 10px; 
            text-align: left; 
            padding: 10px; 
            border-radius: 5px; 
            text-decoration: none; 
            color: white; 
            font-weight: 500; 
        }
        .sidebar .btn:hover { 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
            opacity: 0.9; 
        }
        .dashboard-btn {
            transition: all 0.3s ease;
            display: inline-block; 
            text-decoration: none; 
            color: white;
        }
        .dashboard-btn:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); 
            opacity: 0.9; 
        }
        .navbar-brand {
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">APLIKASI TRANSPARANSI GAJI DPR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('logged_in')): ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <?php if (session()->get('role') == 'Admin'): ?>
                    <h5 class="fw-bold">Menu Admin</h5>
                    <a href="/anggota" class="btn" style="background-color: #003366; border-color: #003366;">Data Anggota DPR</a>
                    <a href="/anggota/lihatKomponenGaji" class="btn" style="background-color: #003366; border-color: #003366;">Data Komponen Gaji</a>
                    <a href="/penggajian" class="btn" style="background-color: #003366; border-color: #003366;">Data Penggajian</a>
                <?php elseif (session()->get('role') == 'Public'): ?>
                    <h5 class="fw-bold">Menu Public</h5>
                    <a href="/data-anggota" class="btn" style="background-color: #003366; border-color: #003366;">Data Anggota DPR</a>
                    <a href="/penggajian" class="btn" style="background-color: #003366; border-color: #003366;">Data Penggajian</a>
                <?php endif; ?>
            </div>
            <div class="col-md-10 content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>