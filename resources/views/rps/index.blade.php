<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar SKPI</title>
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
    <div class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
<h1>Daftar Rencana Pembelajaran Semester (RPS)</h1>
@if(!auth()->user()->isMahasiswa())
            <a href="{{ route('rps.create') }}" class="btn-primary">
                + Tambah RPS Baru
            </a>
        @endif
    </div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

@if ($semua_rps->isEmpty())
<div style="margin-top: 20px; text-align: center; color: #64748b;">
    <p>Belum ada data RPS yang tersimpan.</p>
</div>

@else
   <div class="table-container">
            <table class="modern-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>File RPS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semua_rps as $rps)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td> 
                <td>Fakultas Teknologi Informasi</td>
                <td>TEKNIK INFORMATIKA</td>
                <td>{{ $rps->kode_mk }} | {{ $rps->nama_mk }}</td>
                <td>
                            <span class="badge badge-pending">{{ $rps->sks }} SKS</span>
                        </td>
                        <td>
                            <a href="{{ $rps->file_rps }}" target="_blank" class="btn-primary" style="padding: 4px 12px; font-size: 0.8rem; text-decoration: none;">Lihat PDF</a>
                        </td>
                        <td>
                            <a href="{{ route('rps.show', $rps->id) }}" class="btn-action btn-detail">Detail</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>
</div>
</body>
</html>