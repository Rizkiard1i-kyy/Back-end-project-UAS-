<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jadwal Kuliah</title>
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
            <h1>Informasi Jadwal</h1>
        </div>

        <div class="detail-card">
            
            <div class="detail-row">
                <div class="detail-label">Mata Kuliah</div>
                <div class="detail-value">
                    {{ $jadwal->mataKuliah->kodeMatkul }} - {{ $jadwal->mataKuliah->namaMatkul }}
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tahun Akademik</div>
                <div class="detail-value">{{ $jadwal->tahun_akademik }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">SKS</div>
                <div class="detail-value">
                    <span class="badge badge-approved">
                        {{ $jadwal->mataKuliah->sks }} SKS
                    </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Kelas</div>
                <div class="detail-value">{{ $jadwal->kelas }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Dosen Pengajar</div>
                <div class="detail-value">{{ $jadwal->dosen->nama }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Email Dosen</div>
                <div class="detail-value">{{ $jadwal->dosen->email }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Ruang & Waktu</div>
                <div class="detail-value">{{ $jadwal->ruangDanWaktu }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Kode Join Teams</div>
                <div class="detail-value">
                    {{ $jadwal->kodeMSteams ?? '-' }}
                </div>
            </div>
        </div>

<div class="form-actions">
    <a href="{{ route('jadwal.index') }}" class="btn-secondary">Kembali</a>
@if(!auth()->user()->isMahasiswa())
<a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn-action btn-edit" style="text-decoration: none;">Ubah Data</a>
</a>

<form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="post" style="display:inline;">
    @csrf 
    @method('DELETE')
    <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data jadwal ini?')">Hapus Data</button>
</form>
@endif
</div>
</div> 
</div> 
</body>
</html>
