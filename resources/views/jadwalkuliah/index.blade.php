<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal Kuliah</title>
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
            <h1>Daftar Jadwal Kuliah</h1>
            @if(!auth()->user()->isMahasiswa())
                <a href="{{ route('jadwal.create') }}" class="btn-primary">
                    + Tambah Jadwal
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

        <div class="table-container">

            <form action="{{ route('jadwal.index') }}" method="GET">
                <div class="form-group">
                    <label for="tahun">Pilih Tahun akademik</label>
                    <select name="tahun" id="tahun" class="form-control" onchange="this.form.submit()">
                        <option value=""> Semua Jadwal </option>
                        @if(isset($pilihanTahun))
                            @foreach($pilihanTahun as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </form>

            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode MK</th>
                        <th>Nama MK</th>
                        <th>SKS</th>
                        <th>Kelas</th>
                        <th>Dosen Pengajar</th>
                        <th>Ruang & Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 
                        <td>{{ $jadwal->mataKuliah->kodeMatkul }}</td>
                        <td>{{ $jadwal->mataKuliah->namaMatkul }}</td>
                        <td>
                            <span class="badge badge-pending">{{ $jadwal->mataKuliah->sks }} SKS</span>
                        </td>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->dosen->nama }}</td>
                        <td>{{ $jadwal->ruangDanWaktu }}</td>
                        <td>
                            <a href="{{ route('jadwal.show', $jadwal->id) }}" class="btn-action btn-detail">Detail</a>
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