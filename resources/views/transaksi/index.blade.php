<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
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
            width: 500px;
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
            padding: 10px;
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
        .notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    animation: fadeOut 3s forwards 2s;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        visibility: hidden;
    }
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
        <a href="{{ route('transaksi.index') }}" class="active">Daftar Transaksi</a>
        <a href="{{ route('dashboard') }}" class="back-button">Kembali</a>
    </nav>

    <div class="content">
        <h1>Daftar Transaksi</h1>

        <div class="search-container">
            <div>
                <select id="searchColumn">
                    <option value="id_transaksi">ID Transaksi</option>
                    <option value="NISN">Siswa NISN</option>
                    <option value="nama_siswa">Nama Siswa</option>
                    <option value="nama_barang">Nama Barang</option>
                    <option value="jumlah">Jumlah</option>
                    <option value="status">Status</option>
                </select>
                <input type="text" id="searchInput" placeholder="Cari..." onkeyup="filterTable()">
            </div>
            <div>
                <a onclick="printTable()" class="add-item-link">Print</a>
                <a href="{{ url('/transaksi/create') }}" class="add-item-link">Tambah Transaksi</a>
            </div>
        </div>

        <table id="transaksiTable">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Siswa NISN</th>
                    <th>Nama Siswa</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id_transaksi }}</td>
                    <td>{{ $transaksi->siswa->NISN }}</td>
                    <td>{{ $transaksi->siswa->nama }}</td>
                    <td>{{ $transaksi->barang->id_barang }}</td>
                    <td>{{ $transaksi->barang->nama_barang }}</td>
                    <td>{{ $transaksi->barang->deskripsi }}</td>
                    <td>{{ $transaksi->jumlah }}</td>
                    <td>{{ $transaksi->status }}</td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>{{ $transaksi->tanggal_kembali }}</td>
                    <td>
                        <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}" class="btn">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(session('success'))
    <div class="notification">
        {{ session('success') }}
    </div>
@endif

    <script>
        function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const column = document.getElementById('searchColumn').value;
    const rows = document.querySelectorAll('#transaksiTable tbody tr');
    
    rows.forEach(row => {
        let cellValue = '';
        // Dapatkan nilai sel berdasarkan kolom yang dipilih
        switch (column) {
            case 'id_transaksi':
                cellValue = row.cells[0].textContent.toLowerCase(); // Kolom 1
                break;
            case 'NISN':
                cellValue = row.cells[1].textContent.toLowerCase(); // Kolom 2
                break;
            case 'nama_siswa':
                cellValue = row.cells[2].textContent.toLowerCase(); // Kolom 3
                break;
            case 'nama_barang':
                cellValue = row.cells[3].textContent.toLowerCase(); // Kolom 4
                break;
            case 'jumlah':
                cellValue = row.cells[5].textContent.toLowerCase(); // Kolom 6
                break;
            case 'status':
                cellValue = row.cells[6].textContent.toLowerCase(); // Kolom 7
                break;
            default:
                break;
        }
        // Tampilkan atau sembunyikan baris berdasarkan pencarian
        row.style.display = cellValue.includes(input) ? '' : 'none';
    });
}
        function printTable() {
    const table = document.getElementById('transaksiTable');
    const printContents = table.cloneNode(true); // Clone the table
    const rows = printContents.getElementsByTagName('tr');

    // Hapus kolom aksi dari header
    const headerCells = rows[0].getElementsByTagName('th');
    if (headerCells.length > 0) {
        rows[0].deleteCell(headerCells.length - 1); // Hapus sel terakhir (kolom aksi)
    }

    // Loop melalui baris dan hapus sel terakhir (kolom aksi)
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            rows[i].deleteCell(cells.length - 1); // Hapus sel terakhir (kolom aksi)
        }
    }

    const originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents.outerHTML;

    window.print();

    document.body.innerHTML = originalContents;
    location.reload(); // Reload the page to restore the original content
}
    </script>
</body>
</html>
