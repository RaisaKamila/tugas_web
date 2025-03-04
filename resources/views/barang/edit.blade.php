<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input:focus, textarea:focus {
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

<a href="{{ route('barang.index') }}">
    <button class="back-button">Kembali</button>
</a>

<div class="container">
    <h1>Edit Barang</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama_barang">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
        @error('nama_barang') <span class="error-message">{{ $message }}</span> @enderror

        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        @error('deskripsi') <span class="error-message">{{ $message }}</span> @enderror

        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" value="{{ old('stok', $barang->stok) }}" required>
        @error('stok') <span class="error-message">{{ $message }}</span> @enderror

        <button type="submit">Perbarui Barang</button>
    </form>
</div>

</body>
</html>
