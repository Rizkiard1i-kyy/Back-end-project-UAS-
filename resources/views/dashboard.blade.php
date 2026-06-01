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

<h3>Akademik</h3>
<a href="{{ route('kehadiran.index') }}">Kehadiran</a>
<br><br>
<a href="{{ route('historiNilai.index') }}">Histori Nilai</a>
<br><br>
<a href="{{ route('jadwal.index') }}">Jadwal Kuliah</a>
<br><br>
<a href="{{ route('ksm.index') }}">KSM</a>
<br><br>
<a href="{{ route('nilaiKHS.index') }}">Nilai KHS</a>
<br><br>

<h3>Surat Keterangan</h3>
<a href="{{ route('surat_keterangan.index') }}">Daftar Surat Keterangan</a>
<br><br>

<h3>SKPI</h3>
<a href="{{ route('skpi.index') }}">SKPI (Penalaran dan Keilmuan)</a>
<br><br>

@if(auth()->user()->isAdmin())
<h3>Administrasi</h3>
<a href="{{ route('pengguna.index') }}">Manajemen Pengguna</a>
<br><br>
@endif

<form method="POST" action="/logout">

    @csrf
    <button type="submit">
        Logout
    </button>

</form>
</body>
</html>