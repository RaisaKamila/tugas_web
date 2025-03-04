<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F3F4F6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #257180;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #257180;
        }

        select, input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        select:focus, input[type="number"]:focus, input[type="date"]:focus {
            border-color: #257180;
            outline: none;
        }

        button {
            background-color: #257180;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #003A4A;
        }

        .back-button {
            background-color: #257180;
            color: white;
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #bbb;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<a href="{{ route('transaksi.index') }}">
    <button class="back-button">Kembali</button>
</a>

<div class="container">
    <h1>Tambah Transaksi</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <label for="siswa_nisn">Siswa NISN</label>
        <select name="siswa_nisn" id="siswa_nisn" required>
            @foreach($siswas as $siswa)
                <option value="{{ $siswa->NISN }}">{{ $siswa->NISN }} - {{ $siswa->nama }}</option>
            @endforeach
        </select>
        @error('siswa_nisn') <span class="error-message">{{ $message }}</span> @enderror

        <label for="barang_id">Nama Barang</label>
        <select name="barang_id" id="barang_id" required>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id_barang }}">{{ $barang->id_barang }} - {{ $barang->nama_barang }} - {{ $barang->deskripsi }}</option>
            @endforeach
        </select>
        @error('barang_id') <span class="error-message">{{ $message }}</span> @enderror

        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
        @error('jumlah') <span class="error-message">{{ $message }}</span> @enderror

        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Dipinjam">Dipinjam</option>
            <option value="Dikembalikan">Dikembalikan</option>
        </select>
        @error('status') <span class="error-message">{{ $message }}</span> @enderror

        <label for="tanggal_transaksi">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="{{ old('tanggal_transaksi') }}" required>
        @error('tanggal_transaksi') <span class="error-message">{{ $message }}</span> @enderror

        <button type="submit">Tambah Transaksi</button>
    </form>

</div>

</body>
</html>
