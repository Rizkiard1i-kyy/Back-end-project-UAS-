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

@if(auth()->user()->isMahasiswa())
<p>
    NIM:
    {{ $user->nim }}
</p>
@endif

<p>
    Role:
    {{ $user->role }}
</p>
<hr>
<h3>Akademik</h3>
<a href="{{ route('historiNilai.index') }}">Histori Nilai</a>
<br><br>
<a href="{{ route('jadwal.index') }}">Jadwal Kuliah</a>
<br><br>
<a href="{{ route('kalenderAkademik.index') }}">Kalender Akademik</a>
<br><br>
<a href="{{ route('ksm.index') }}">KSM</a>
<br><br>
<a href="{{ route('kehadiran.index') }}">Kehadiran</a>
<br><br>
<a href="{{ route('nilaiKHS.index') }}">Nilai KHS</a>
<br><br>

<h3>Layanan Mahasiswa</h3>
<a href="{{ route('konsultasi.index') }}">Konsultasi Akademik</a>
<br><br>
<a href="{{ route('surat_keterangan.index') }}">Surat Keterangan</a>
<br><br>
<a href="{{ route('surat_permohonan.index') }}">Surat Permohonan</a>
<br><br>

<h3>Bahan Ajar</h3>
<a href="{{ route('rps.index') }}">RPS (rancangan program studi)</a>
<br><br>

<h3>Unit Kegiatan Mahasiswa</h3>
<a href="{{ route('ukm.index') }}">UKM</a>
<br><br>

<h3>SKPI</h3>
<a href="{{ route('skpi.index') }}">SKPI (Penalaran dan Keilmuan)</a>
<br><br>

<h3>Chatbot Asisten Akademik</h3>
<a href="{{ route('chatbot.index') }}">Lintar bot</a>
<br><br>
<a href="{{ route('Pengumuman.index') }}">Pengumuman</a>
<br><br>

@if(auth()->user()->isAdmin())
<h3>Administrasi</h3>
<a href="{{ route('pengguna.index') }}">Manajemen Pengguna</a>
<br><br>
<a href="{{ route('mataKuliah.index') }}">Manajemen Mata Kuliah</a>
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