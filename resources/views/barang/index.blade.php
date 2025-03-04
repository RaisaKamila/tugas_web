<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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
            margin: 30px 0;
            font-size: 30px;
            font-weight: 700;
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

        nav a:hover, nav a.active {
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

        .search-container select, .search-container input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-container select {
            width: 200px;
        }

        .search-container input {
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
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #FFFFFF;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 12px 15px;
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
    </style>
</head>
<body>
<nav>
    <div class="logo">WEB PEMINJAMAN</div>
    <a href="{{ route('siswa.index') }}">Daftar Siswa</a>
    <a href="{{ route('barang.index') }}" class="active">Daftar Barang</a>
    <a href="{{ route('transaksi.index') }}">Daftar Transaksi</a>
    <a href="{{ route('dashboard') }}" class="back-button">Kembali</a>
</nav>
<div class="content">
    <h1>Daftar Barang</h1>
    <div class="search-container">
        <div>
            <select id="searchColumn">
                <option value="id_barang">ID Barang</option>
                <option value="nama_barang">Nama Barang</option>
                <option value="deskripsi">Deskripsi</option>
                <option value="stok">Stok</option>
            </select>
            <input type="text" id="searchInput" placeholder="Cari..." onkeyup="filterTable()">
        </div>
            <a onclick="printTable()" class="add-item-link">Print</a>
            <a href="{{ route('barang.create') }}" class="add-item-link">Tambah Barang</a>
        </div>
    <table id="barangTable">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $item)
                <tr>
                    <td>{{ $item->id_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
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
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        let column = document.getElementById("searchColumn").value;
        table = document.getElementById("barangTable");
        tr = table.getElementsByTagName("tr");

        let columnIndex;
        switch (column) {
            case "id_barang":
                columnIndex = 0;
                break;
            case "nama_barang":
                columnIndex = 1;
                break;
            case "deskripsi":
                columnIndex = 2;
                break;
            case "stok":
                columnIndex = 3;
                break;
            default:
                columnIndex = 0;
        }

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[columnIndex];
            if (td) {
                txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }

    function printTable() {
    const table = document.getElementById('barangTable');
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
