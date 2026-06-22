<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data kegiatan SKPI</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Halo! Selamat datang {{ auth()->user()->nama ?? 'User' }} di Lintar X!</h1>
    </div>
</header>

<div class="container" style="display: block;">
    <div class="page-header">
        <h1>Tambah Data Kegiatan SKPI</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" style="padding: 12px; margin-bottom: 20px;">
        @foreach($errors->all() as $error)
            <div style="margin-bottom: 4px;">{{ $error }}</div>
        @endforeach
    </div>
    @endif

<div class="form-card">
        <form method="POST" action="{{ route('skpi.store') }}">
            @csrf

    <div class="form-group">
        <label>Nama Kegiatan</label>
        <input type="text" name="kegiatan" class="form-control" placeholder="Contoh: Welcoming Party 2025" required>
    </div>

    <div class="form-group">
        <label>Jenis Kegiatan</label>
        <input type="text" name="jenis" class="form-control" placeholder="Contoh: Organisasi / Bakat dan Minat / Seminar" required>
    </div>

    <div class="form-group">
    <label>Klasifikasi (Peran)</label>
    <select name="klasifikasi" class="form-control" required>
        <option value="Peserta">Peserta</option>
        <option value="Panitia">Panitia</option>
        <option value="Ketua Umum">Ketua Umum</option>
    </select>
    </div>
    <div class="form-group">
    <label>Link Bukti Sertifikat (Google Drive)</label>
    <input type="url" name="bukti" class="form-control" required>
    </div>
    <div class="form-actions">
                <a href="{{ route('skpi.index') }}" class="btn-secondary">Kembali</a>
    <button type="submit" class="btn-primary">Simpan</button>
    </div>
</form>
</div>
</div>
</body>
</html>
