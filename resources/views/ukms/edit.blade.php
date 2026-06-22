<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data UKM</title>
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
            <h1>Edit Data UKM</h1>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('ukm.update', $ukm) }}">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nama">NAMA UKM</label>
                <input name="nama" value="{{ old('nama', $ukm->nama) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nim">NAMA KETUA</label>
                <select name="nim" class="form-control" required>
                    <option value = "">-Pilih NIM Mahasiswa-</option>
                    @foreach($mahasiswas as $mhs)
                        <option value = "{{ $mhs->id }}"{{ old('nim', $ukm->nim) == $mhs->id ? 'selected' : '' }}>
                            {{ $mhs->nim }} - {{ $mhs->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="anggota">JUMLAH ANGGOTA</label>
                <input type="number" name="anggota" value="{{ old('anggota', $ukm->anggota) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="detail">DETAIL</label>
                <input name="detail" value="{{ old('detail', $ukm->detail) }}" class="form-control" required>
            </div>
        
            <div class="form-actions">
                    <a href="{{ route('ukm.show', $ukm) }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>