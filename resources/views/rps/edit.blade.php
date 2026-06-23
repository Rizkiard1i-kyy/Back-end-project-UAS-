<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Daftar RPS</title>
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
            <h1>Edit Data RPS</h1>
        </div>

        @if($errors->any())
            <div class="alert alert-danger" style="padding: 12px; margin-bottom: 20px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('rps.update', $rps->id) }}">
                @csrf 
                @method('PUT')

                <div class="form-group">
                    <label for="kode_mk">Kode Mata Kuliah:</label>
                    <input name="kode_mk" id="kode_mk" value="{{ $rps->kode_mk }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nama_mk">Nama Mata Kuliah:</label>
                    <input type="text" name="nama_mk" id="nama_mk" class="form-control" placeholder="Contoh: Backend Programming" required>
                </div>

                <div class="form-group">
                    <label for="sks">SKS:</label>
                    <input type="number" name="sks" id="sks" value="{{ $rps->sks }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="file_rps">Link RPS (Google Drive)</label>
                    <input type="url" name="file_rps" id="file_rps" value="{{ $rps->file_rps }}" class="form-control" required>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('rps.index') }}" class="btn-secondary">Batal dan Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>     
</html>
