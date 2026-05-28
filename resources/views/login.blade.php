<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

@if ($errors->any())

    <p>{{ $errors->first() }}</p>

@endif

<form method="POST" action="/login">

    @csrf

    <label>Email</label>

    <input
        type="email"
        name="email"
        required
    >

    <br><br>

    <label>Password</label>

    <input
        type="password"
        name="password"
        required
    >

    <br><br>

    <button type="submit">
        Login
    </button>

</form>

<h4>Akun Demo: admin@untar.ac.id dengan password 12345678, lakukan php artisan migrate:fresh --seed untuk menginisialisasi.</h4>

</body>
</html>