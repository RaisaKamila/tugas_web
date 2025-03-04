<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
         body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F3F4F6;
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #257180;
            font-size: 32px;
            margin-bottom: 20px;
        }

        nav {
            background-color: #257180;
            width: 240px;
            height: 100vh;
            padding-top: 40px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease;
            padding-left: 10px;
        }

        nav .logo {
            color: white;
            font-weight: bold;
            font-size: 26px;
            text-align: center;
            margin-bottom: 40px;
            padding: 10px 0;
            border-bottom: 2px solid #003A4A;
        }

        nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 5px;
            margin: 5px 0;
        }

        nav a:hover {
            background-color: #003A4A;
            color: #FFF5E1;
        }

        nav a.active {
            background-color: #003A4A;
            color: #FFF5E1;
        }
        nav a.back-button {
    background-color: #FF6B6B; /* Warna merah lembut */
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin-top: 15px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-size: 14px;
}

nav a.back-button:hover {
    background-color: #D64545; /* Warna saat hover */
    transform: scale(1.05);
}
        .content {
            margin-left: 260px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-container select{
        padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 200px;
        }
        .search-container input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 600px;
        }

        .add-item-link {
            background-color: #257180;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .add-item-link:hover {
            background-color: #003A4A;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #003A4A;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #F7F7F7;
        }

        tr:hover {
            background-color: #E8F5FF;
        }

        .btn {
            background-color: #257180;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #003A4A;
        }

        @media (max-width: 768px) {
            nav {
                width: 100%;
                height: auto;
                position: relative;
                padding-left: 20px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<nav>
        <div class="logo">WEB PEMINJAMAN</div>
        <a href="{{ route('siswa.index') }}">Daftar Siswa</a>
        <a href="{{ route('barang.index') }}">Daftar Barang</a>
        <a href="{{ route('transaksi.index') }}" >Daftar Transaksi</a>
        <a href="{{ route('users.index') }}"class="active">Daftar Pengguna</a>
        <a href="{{ route('dashboard') }}" class="back-button">Kembali</a>
    </nav>

    <div class="content">
        <h1>Daftar Pengguna</h1>

        <table id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
