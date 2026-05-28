<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Menu Utama</h1>

<h3>Profil Login</h3>

<p>
    Nama:
    {{ $user->nama }}
</p>

<p>
    Email:
    {{ $user->email }}
</p>

<p>
    NIM:
    {{ $user->nim }}
</p>

<p>
    Role:
    {{ $user->role }}
</p>

<form method="POST" action="/logout">

    @csrf

    <button type="submit">
        Logout
    </button>

</form>
</body>
</html>