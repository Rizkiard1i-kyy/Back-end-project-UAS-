<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body></body>
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
        <h1>Daftar Surat Permohonan</h1>
        <a href="{{ route('surat_permohonan.create') }}" class="btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Surat
        </a>
    </div>

   <div class="table-container">
        <table class="modern-table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th>Jenis Surat</th>
                    <th>Bahasa</th>
                    <th>NIM</th>
                    <th>Status</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suratPermohonan as $surat)
                <tr>
                    <td style="text-align: center; font-weight: 600; color: #64748b;">{{ $loop->iteration }}</td>
                    <td style="font-weight: 600; color: #0f172a;">{{ $surat->jenis_surat }}</td>
                    <td>
                        <span style="background-color: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                            {{ $surat->bahasa }}
                        </span>
                    </td>
                    <td>{{ $surat->nim }}</td>
                    <td>
                        @if(strtolower($surat->status) == 'approved' || strtolower($surat->status) == 'disetujui')
                            <span class="badge badge-approved">{{ $surat->status }}</span>
                        @elseif(strtolower($surat->status) == 'rejected' || strtolower($surat->status) == 'ditolak')
                            <span class="badge badge-rejected">{{ $surat->status }}</span>
                        @else
                            <span class="badge badge-pending">{{ $surat->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('surat_permohonan.show', $surat->no) }}" class="btn-action btn-detail">
                            Detail
                        </a>

                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('surat_permohonan.edit', $surat->no) }}" class="btn-action btn-edit">
                                Edit Status
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>
</div>

</body>
</html>