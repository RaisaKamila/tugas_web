<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="text"]:focus {
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
            margin-bottom: 10px;
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

        .error-list {
            color: red;
            margin-bottom: 20px;
        }

        .error-list ul {
            list-style-type: none;
            padding: 0;
        }

        .error-list li {
            background-color: #F9D2D2;
            padding: 5px 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<a href="{{ route('siswa.index') }}">
    <button class="back-button">Kembali</button>
</a>

<div class="container">
    <h1>Form Tambah Siswa</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <label for="NISN">NISN:</label>
        <input type="text" name="NISN" id="NISN" required>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="kelas">Kelas:</label>
        <input type="text" name="kelas" id="kelas" required>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required>

        <button type="submit">Simpan</button>
    </form>
</div>

</body>
</html>
