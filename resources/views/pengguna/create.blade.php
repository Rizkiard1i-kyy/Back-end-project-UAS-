<!DOCTYPE html>
<html>
<head>
<title>tambah pengguna</title>
<link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>halo! selamat datang {{ auth()->user()->nama ?? 'admin' }} di lintar x!</h1>
    </div>
</header>

<div class="container">

<div class="page-header">
    <h1>tambah pengguna baru</h1>
</div>

@if($errors->any())
<p class="badge badge-rejected">
    @foreach($errors->all() as $e)
    {{ $e }}<br>
    @endforeach
</p>
@endif

<div class="form-card">
<form method="POST" action="{{ route('pengguna.store') }}">
    @csrf

    <div class="form-group">
        <label>nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
    </div>

    <div class="form-group">
        <label>email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label>nim <small>(kosongin aja klo bukan mahasiswa)</small></label>
        <input type="text" name="nim" class="form-control" value="{{ old('nim') }}">
    </div>

    <div class="form-group">
        <label>password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>konfirmasi password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="form-group">
        <label>role</label>
        <select name="role" class="form-control" required>
            <option value="">-- pilih role --</option>
            <option value="mahasiswa" @selected(old('role')=='mahasiswa')>mahasiswa</option>
            <option value="dosen" @selected(old('role')=='dosen')>dosen</option>
            <option value="admin" @selected(old('role')=='admin')>admin</option>
        </select>
    </div>

    <div class="form-actions">
        <a href="{{ route('pengguna.index') }}" class="btn-secondary">batal</a>
        <button class="btn-primary btn-submit">simpan</button>
    </div>
</form>
</div>

</div>
</body>
</html>