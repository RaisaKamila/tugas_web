<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body {
            background-color: #F3F4F6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color: #257180 !important;
            padding: 1rem;
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .navbar .btn-danger {
            background-color: #FF6B6B;
            border: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .navbar .btn-danger:hover {
            background-color: #D64545;
        }

        /* Konten Utama */
        .container {
            margin-top: 50px;
            text-align: center;
        }

        h1 {
            color: #257180;
            font-size: 28px;
            font-weight: bold;
        }

        p {
            color: #444;
        }

        /* Card */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .menu-card {
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-align: center;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: scale(1.05);
        }

        .menu-card i {
            font-size: 40px;
            color: #257180;
        }

        .menu-card h4 {
            color: #257180;
            font-weight: bold;
            font-size: 20px;
            margin-top: 15px;
        }

        .menu-card p {
            color: #666;
            margin-top: 10px;
        }

        .btn-success {
            background-color: #257180;
            border: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-success:hover {
            background-color: #003A4A;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }
            .menu-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand" href="#">INVENTORY WEB</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h1>Selamat Datang di Website Inventory Barang</h1>
        <p>Pilih menu untuk melanjutkan:</p>
        
        <div class="menu-container">
            <div class="menu-card">
                <i data-feather="users"></i>
                <h4>Daftar Siswa</h4>
                <a href="{{ route('siswa.index') }}" class="btn btn-success">Lihat Detail</a>
            </div>

            <div class="menu-card">
                <i data-feather="package"></i>
                <h4>Daftar Barang</h4>
                <a href="{{ route('barang.index') }}" class="btn btn-success">Lihat Detail</a>
            </div>

            <div class="menu-card">
                <i data-feather="file-text"></i>
                <h4>Daftar Transaksi</h4>
                <a href="{{ route('transaksi.index') }}" class="btn btn-success">Lihat Detail</a>
            </div>

            <div class="menu-card">
                <i data-feather="user"></i>
                <h4>Daftar Pengguna</h4>
                <a href="{{ route('users.index') }}" class="btn btn-success">Lihat Detail</a>
            </div>
        </div>
    </div>

    <script>
        feather.replace(); // Untuk mengganti ikon Feather.js
    </script>
</body>
</html>
