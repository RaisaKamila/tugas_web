<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #257180;
            margin-bottom: 30px;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
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

        .login-link {
            margin-top: 15px;
        }

        .login-link a {
            color: #257180;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
        .back-button {
            background-color: #257180;
            color: #ffffff;
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
<a href="{{ route('login') }}">
    <button class="back-button">Kembali</button>
</a>
<div class="container">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">Daftar</button>
    </form>

    <div class="login-link">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>
</div>

</body>
</html>
