<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Data Mata Kuliah Baru</title>
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
            <h1>Buat Data Mata Kuliah Baru</h1>
        </div>
        <div class="form-card">
            <form method="POST" action="{{ route('mataKuliah.store') }}">
                @csrf
                <div class="form-group">
                    <label for="kodeMatkul">Kode Mata Kuliah</label>
                    <input name="kodeMatkul" value="{{ old('kodeMatkul') }}" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label for="namaMatkul">Nama Mata Kuliah</label>
                    <input name="namaMatkul" value="{{ old('namaMatkul') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sks">SKS</label>
                    <input type="number" name="sks" value="{{ old('sks') }}" class="form-control" required>
                </div>
                <div class="form-actions">
                    <a href="{{ route('mataKuliah.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>