<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Kuliah</title>
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
            <h1>Detail Mata Kuliah</h1>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">Kode Mata Kuliah</div>
                <div class="detail-value">{{ $mataKuliah->kodeMatkul }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nama Mata Kuliah</div>
                <div class="detail-value">{{ $mataKuliah->namaMatkul }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">SKS</div>
                <div class="detail-value">{{ $mataKuliah->sks }}</div>
            </div>

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
                <a href="{{ route('mataKuliah.index') }}" class="btn-secondary">Kembali</a>
                <a href="{{ route('mataKuliah.edit', $mataKuliah) }}" class="btn-action btn-edit">
                    Edit Data
                </a>
                <form action="{{ route('mataKuliah.destroy', $mataKuliah) }}" method="post" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data mata kuliah ini?')">
                            Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
