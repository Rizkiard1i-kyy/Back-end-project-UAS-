<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kehadiran</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
                @if(!auth()->user()->isMahasiswa())
                    <h1>Detail Kehadiran {{ $kehadiran->mahasiswa->nama }} ({{ $kehadiran->mahasiswa->nim }}) untuk {{ $kehadiran->mataKuliah->kodeMatkul }} {{ $kehadiran->mataKuliah->namaMatkul }}</h1>
                @else
                    <h1>Detail Kehadiran Kamu untuk {{ $kehadiran->mataKuliah->kodeMatkul }} {{ $kehadiran->mataKuliah->namaMatkul }}</h1>
                @endif
            </div>
    </header>

    <div class="container">
        <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
            <h1>Detail Kehadiran</h1>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">Nama Dosen</div>
                <div class="detail-value">{{ $kehadiran->dosen->nama }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tahun Akademik</div>
                <div class="detail-value">{{ $kehadiran->tahunAkademik }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Kelas</div>
                <div class="detail-value">{{ $kehadiran->kelas }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Jumlah Pertemuan</div>
                <div class="detail-value">{{ $kehadiran->jumlahPertemuan }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Jumlah Kehadiran</div>
                <div class="detail-value">{{ $kehadiran->jumlahKehadiran }}</div>
            </div>

            @if(auth()->user()->isDosen())
                <div>
                    <h3>Ubah Data Kehadiran</h3>
                    <form action="{{ route('kehadiran.update', $kehadiran) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="jumlahPertemuan">Jumlah Pertemuan</label>
                            <input type="number" name="jumlahPertemuan" value="{{ old('jumlahPertemuan', $kehadiran->jumlahPertemuan) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlahKehadiran">Jumlah Kehadiran</label>
                            <input type="number" name="jumlahKehadiran" value="{{ old('jumlahKehadiran', $kehadiran->jumlahKehadiran) }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn-primary btn-submit">Simpan</button>
                    </form>
                <div>
            @endif

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
                <a href="{{ route('kehadiran.index') }}" class="btn-secondary">Kembali</a>
                
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('kehadiran.edit', $kehadiran) }}" class="btn-action btn-edit">
                        Edit Data
                    </a>
                    <div class="btn-action btn-primary">
                        <form action="{{ route('kehadiran.destroy', $kehadiran) }}" method="post" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data kehadiran ini?')" class="untar-btn-login">Hapus Data</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>