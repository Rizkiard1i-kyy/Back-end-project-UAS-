<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data RPS</title>
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
    <div class="page-header" style="justify-content: center; margin-bottom: 24px;">

<h1>Tambah Data RPS Baru</h1>
</div> @if($errors->any())
        <div class="alert alert-danger" style="max-width: 600px; margin: 0 auto 24px auto;">
            <strong style="display: block; margin-bottom: 8px;">Gagal menyimpan RPS! Cek kesalahan berikut:</strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                
            </ul>
        </div>
    @endif

<div class="form-card">
<form method="POST" action="{{ route('rps.store') }}">
    @csrf

    <div class="form-group">
    <label for="kode_mk">Kode Mata Kuliah</label>
    <input type="text" name="kode_mk" id="kode_mk" class="form-control" required>
    </div>
    
    <div class="form-group">
    <label for="nama_mk">Nama Mata Kuliah</label>
    <input type="text" name="nama_mk" id="nama_mk" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="sks">SKS</label>
        <input type="number" name="sks" id="sks" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="file_rps">Link Google Drive:</label>
        <input type="url" name="file_rps" id="file_rps" class="form-control" required>
    </div>
    
    <div class="form-actions">
<a href="{{ route('rps.index') }}" class="btn-secondary">Kembali</a>
<button type="submit" class="btn-primary btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>