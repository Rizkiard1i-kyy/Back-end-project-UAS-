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
    <h1>Daftar SKPI (Penalaran dan Keilmuan)</h1>

        @if(auth()->user() && in_array(auth()->user()->role, ['mahasiswa']))
            <a href="{{ route('skpi.create') }}" class="btn-primary">Tambah Data SKPI Baru</a>
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
        @if ($skpis->isEmpty())
            <p>Belum ada data kegiatan SKPI yang tersimpan.</p>
        @else
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        @if(auth()->user() && !in_array(auth()->user()->role, ['mahasiswa']))
                            <th>Nama Mahasiswa</th>
                        @endif
                        <th>Nama Kegiatan</th>
                        <th>Jenis</th>
                        <th>Klasifikasi</th>
                        <th>Validasi</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skpis as $skpi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if(auth()->user() && !in_array(auth()->user()->role, ['mahasiswa']))
                            <td>{{ $skpi->pengguna->nama ?? 'Tidak Diketahui' }}</td>
                        @endif
                        <td>{{ $skpi->kegiatan }}</td>
                        <td>{{ $skpi->jenis }}</td>
                        <td>{{ $skpi->klasifikasi }}</td>
                        <td>{{ $skpi->validasi }}</td>
                        <td>{{ $skpi->point }}</td>
                        <td>
                            <a href="{{ route('skpi.show', $skpi->id) }}" class="btn-secondary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="{{ auth()->user() && !in_array(auth()->user()->role, ['mahasiswa']) ? 7 : 6 }}">
                            <div style="margin-top: 16px; font-weight: bold;">            
                                <b>Total Point Terkumpul (Tervalidasi)</b>
                            </div>
                        </td>
                        <td>
                            <b>{{ $totalPoint }}</b>
                        </td>
                        <td>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="/dashboard" class="btn-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali Ke Dashboard
        </a>
    @endif
</body>
</html>