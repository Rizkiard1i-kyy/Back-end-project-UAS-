<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Nilai KHS</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
                @if(!auth()->user()->isMahasiswa())
                    <h1>Detail Nilai KHS {{ $nilaiHasil->mahasiswa->nama }} ({{ $nilaiHasil->mahasiswa->nim }}) untuk {{ $nilaiHasil->mataKuliah->kodeMatkul }} {{ $nilaiHasil->mataKuliah->namaMatkul }}</h1>
                @else
                    <h1>Detail Nilai KHS Kamu untuk {{ $nilaiHasil->mataKuliah->kodeMatkul }} {{ $nilaiHasil->mataKuliah->namaMatkul }}</h1>
                @endif
            </div>
    </header>

    <div class="container">
        <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
            <h1>Detail Nilai KHS</h1>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">Kode Matkul</div>
                <div class="detail-value">{{ $nilaiHasil->mataKuliah->kodeMatkul }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nama Matkul</div>
                <div class="detail-value">{{ $nilaiHasil->mataKuliah->namaMatkul }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nama Dosen</div>
                <div class="detail-value">{{ $nilaiHasil->dosen->nama }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Tahun</div>
                <div class="detail-value">{{ $nilaiHasil->tahunAkademik }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value">{{ $nilaiHasil->status }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Kredit (SKS)</div>
                <div class="detail-value">{{ $nilaiHasil->mataKuliah->sks }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nilai (Huruf)</div>
                <div class="detail-value">{{ $nilaiHasil->nilaiHuruf }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nilai (Angka)</div>
                <div class="detail-value">{{ $nilaiHasil->nilaiAngka }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Bobot Kulitas</div>
                <div class="detail-value">{{ $nilaiHasil->bobotKualitas }}</div>
            </div>

            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 100px">Tugas</th>
                            <th style="width: 100px">UTS</th>
                            <th style="width: 100px">UAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a> {{ $nilaiHasil->tugas }}</a>
                            </td>
                            <td>
                                <a> {{ $nilaiHasil->uts }}</a>
                            </td>
                            <td>
                                <a> {{ $nilaiHasil->uas }}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if(auth()->user()->isDosen())
                <div>
                    <h3>Ubah Data Nilai KHS</h3>
                    <form action="{{ route('nilaiHasil.update', $nilaiHasil) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="tugas">Tugas</label>
                            <input type="number" name="tugas" value="{{ old('tugas', $nilaiHasil->tugas) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="uts">UTS</label>
                            <input type="number" name="uts" value="{{ old('uts', $nilaiHasil->uts) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="uas">UAS</label>
                            <input type="number" name="uas" value="{{ old('uas', $nilaiHasil->uas) }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn-primary btn-submit">Simpan</button>
                    </form>
                <div>
            @endif

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
                <a href="{{ route('nilaiHasil.index') }}" class="btn-secondary">Kembali</a>
                
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('nilaiHasil.edit', $nilaiHasil) }}" class="btn-action btn-edit">
                        Edit Data
                    </a>
                    <form action="{{ route('nilaiHasil.destroy', $nilaiHasil) }}" method="post" style="display:inline;">
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