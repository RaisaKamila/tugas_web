<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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

        select, input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        select:focus, input[type="text"]:focus, input[type="password"]:focus {
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
            background-color: #ddd;
            color: black;
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #bbb;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<a href="{{ route('users.index') }}">
    <button class="back-button">Kembali</button>
</a>

<div class="container">
    <h1>Edit User</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')

        <label>Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required>

        <label>Password (kosongkan jika tidak ingin mengubah):</label>
        <input type="password" name="password">

        <label>Role:</label>
        <select name="role" required>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
