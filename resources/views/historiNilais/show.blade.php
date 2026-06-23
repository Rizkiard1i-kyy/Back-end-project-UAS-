<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Histori Nilai</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
                @if(!auth()->user()->isMahasiswa())
                    <h1>Detail Histori Nilai {{ $historiNilai->mahasiswa->nama }} ({{ $historiNilai->mahasiswa->nim }}) untuk {{ $historiNilai->mataKuliah->kodeMatkul }} {{ $historiNilai->mataKuliah->namaMatkul }}</h1>
                @else
                    <h1>Detail Histori Nilai Kamu untuk {{ $historiNilai->mataKuliah->kodeMatkul }} {{ $historiNilai->mataKuliah->namaMatkul }}</h1>
                @endif
            </div>
    </header>

    <div class="container">
        <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
            <h1>Detail Histori Nilai</h1>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">Nama Dosen</div>
                <div class="detail-value">{{ $historiNilai->dosen->nama }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tahun</div>
                <div class="detail-value">{{ $historiNilai->tahunAkademik }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">SKS</div>
                <div class="detail-value">{{ $historiNilai->mataKuliah->sks }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">nilai</div>
                <div class="detail-value">{{ $historiNilai->nilai }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">bobot</div>
                <div class="detail-value">{{ $historiNilai->bobot }}</div>
            </div>

            @if(auth()->user()->isDosen())
                <div>
                    <h3>Ubah Data Histori Nilai</h3>
                    <form action="{{ route('historiNilai.update', $historiNilai) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="number" name="bobot" step="0.01" min="0" max="4" value="{{ old('bobot', $historiNilai->bobot) }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn-primary btn-submit">Simpan</button>
                    </form>
                <div>
            @endif

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
                <a href="{{ route('historiNilai.index') }}" class="btn-secondary">Kembali</a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('historiNilai.edit', $historiNilai) }}" class="btn-action btn-edit">
                        Edit Data
                    </a>
                    <form action="{{ route('historiNilai.destroy', $historiNilai) }}" method="post" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data kehadiran ini?')">
                            Hapus Data
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>