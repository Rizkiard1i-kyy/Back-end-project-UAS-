<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Keterangan</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Detail Pengajuan Surat</h1>
    </div>
</header>

<div class="container">
    
    <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
        <h1>Informasi Surat</h1>
    </div>

    <div class="detail-card">

        <div class="detail-row">
            <div class="detail-label">Jenis Surat</div>
            <div class="detail-value">{{ $suratKeterangan->jenis_surat }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Bahasa Pengantar</div>
            <div class="detail-value">
                <span style="background-color: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 0.9rem;">
                    {{ $suratKeterangan->bahasa }}
                </span>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-label">NIM Mahasiswa</div>
            <div class="detail-value">{{ $suratKeterangan->nim }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">Status Pengajuan</div>
            <div class="detail-value">
                @if(strtolower($suratKeterangan->status) == 'approved' || strtolower($suratKeterangan->status) == 'disetujui')
                    <span class="badge badge-approved">{{ $suratKeterangan->status }}</span>
                @elseif(strtolower($suratKeterangan->status) == 'rejected' || strtolower($suratKeterangan->status) == 'ditolak')
                    <span class="badge badge-rejected">{{ $suratKeterangan->status }}</span>
                @else
                    <span class="badge badge-pending">{{ $suratKeterangan->status }}</span>
                @endif
            </div>
        </div>

        <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
            <a href="{{ route('surat_keterangan.index') }}" class="btn-secondary" style="width: 100%;"> kembali ke daftar </a>
            
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('surat_keterangan.edit', $suratKeterangan->no) }}" class="btn-primary" style="justify-content: center; text-decoration: none;">
                    Ubah Status
                </a>
            @endif
        </div>

    </div>

</div>

</body>
</html>