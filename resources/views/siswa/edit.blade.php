<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
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
            max-width: 600px; /* Make it wider */
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

        input[type="text"][readonly] {
            background-color: #e9ecef;
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
       

    </style>
</head>
<body>

<a href="{{ route('siswa.index') }}">
    <button class="back-button">Kembali</button>
</a>

<div class="container">
    <h1>Edit Data Siswa</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.update', $siswa->NISN) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="NISN">NISN</label>
        <input type="text" id="NISN" name="NISN" value="{{ $siswa->NISN }}" readonly>

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}">

        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" name="kelas" value="{{ $siswa->kelas }}">

        <label for="jurusan">Jurusan</label>
        <input type="text" id="jurusan" name="jurusan" value="{{ $siswa->jurusan }}">

        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
