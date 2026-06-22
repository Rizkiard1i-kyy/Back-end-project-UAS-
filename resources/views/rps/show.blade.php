<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail RPS</title>
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
        <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">     
<h1>Detail RPS</h1>
        </div>

<div class="detail-card" style="margin: 0 auto;">
            <div class="detail-row">
                <div class="detail-label">Mata Kuliah</div>
                <div class="detail-value">
                    {{ $rps->kode_mk }} - {{ $rps->nama_mk }}
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Fakultas</div>
                <div class="detail-value">Fakultas Teknologi Informasi</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Jurusan</div>
                <div class="detail-value">Teknik Informatika</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">SKS</div>
                <div class="detail-value">
                    <span class="badge badge-approved">
                        {{ $rps->sks }} SKS
                    </span>
                </div>
            </div>
        <div class="detail-row">
                <div class="detail-label">Dokumen RPS</div>
                <div class="detail-value">
                    <a href="{{ $rps->file_rps }}" target="_blank" class="btn-primary" style="padding: 4px 12px; text-decoration: none;">Buka Link Drive</a>
                </div>
            </div>
        </div>

        <div class="form-actions" style="max-width: 600px; margin: 24px auto 0 auto;">
            <a href="{{ route('rps.index') }}" class="btn-secondary">Kembali</a>

@if(!auth()->user()->isMahasiswa())
<a href="{{ route('rps.edit', $rps->id) }}" class="btn-action btn-edit" style="text-decoration: none;">Ubah Data</a>

<form action="{{ route('rps.destroy', $rps->id) }}" method="post" style="display:inline;">
    @csrf 
    @method('DELETE')
    <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data RPS ini?')">Hapus Data</button>
                </form>
@endif
        </div>
    </div>  
</body>
</html>

