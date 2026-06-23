<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kegiatan SKPI</title>
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
        <div class="page-header">
            <h1>Edit Data Kegiatan SKPI</h1>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('skpi.update', $skpi->id) }}">
                @csrf 
                @method('PUT')
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <select name="kegiatan" class="form-control" required>
                    <option value="">Pilih Nama Kegiatan</option>
                    @foreach($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan }}" {{ $skpi->kegiatan == $kegiatan ? 'selected' : '' }}>
                            {{ $kegiatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Kegiatan</label>
                <select name="jenis" class="form-control" required>
                    <option value="">Pilih Jenis Kegiatan</option>
                    @foreach($jenises as $jenis)
                        <option value="{{ $jenis }}" {{ $skpi->jenis == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label>Klasifikasi (Peran)</label>
                <select name="klasifikasi" class="form-control" required>
                    <option value="Peserta" {{ $skpi->klasifikasi == 'Peserta' ? 'selected' : '' }}>Peserta</option>
                    <option value="Panitia" {{ $skpi->klasifikasi == 'Panitia' ? 'selected' : '' }}>Panitia</option>
                    <option value="Ketua Umum" {{ $skpi->klasifikasi == 'Ketua Umum' ? 'selected' : '' }}>Ketua Umum</option>
                </select>
            </div>
            <div class="form-group">
                <label>Link Bukti Sertifikat (Google Drive)</label>
                <input type="url" name="bukti" value="{{ $skpi->bukti }}" class="form-control" required>
                </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="{{ route('skpi.index') }}" class="btn-secondary">Batal dan Kembali</a>
                </div>
            </form>
        </div>
    </body>
</html>
