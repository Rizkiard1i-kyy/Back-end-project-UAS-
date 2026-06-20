<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Data Kalender Akademik Baru</title>
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

<div class="container">
    
    <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
        <h1>Buat Data Kalender Akademik Baru</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('kalenderAkademik.store') }}">
            @csrf
            <div class="form-group">
                <label for="tanggalMulai">Tanggal Mulai</label>
                <input type="date" name="tanggalMulai" value="{{ old('tanggalMulai') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tanggalSelesai">Tanggal Selesai</label>
                <input type="date" name="tanggalSelesai" value="{{ old('tanggalSelesai') }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="tahunAkademik">Tahun Akademik</label>
                <select name="tahunAkademik" class="form-control" required>
                    <option value = "2026 Ganjil">2026 Ganjil</option>
                    <option value="2025 Genap">2025 Genap</option>
                    <option value="2025 Ganjil">2025 Ganjil</option>
                </select>
            </div>

            <div class="form-group">
                <label for="namaKegiatan">Nama Kegiatan</label>
                <input name="namaKegiatan" value="{{ old('namaKegiatan') }}" class="form-control" required>
            </div>
            <br>
            
            <div class="form-actions">
                <a href="{{ route('kalenderAkademik.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>