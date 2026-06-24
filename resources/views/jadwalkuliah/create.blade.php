<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kuliah</title>
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
        <div class="page-header" style="justify-content: center; margin-bottom: 24px;">
            <h1>Tambah Jadwal Kuliah Baru</h1>
        </div>

        @if($errors->any())
            <div class="alert alert-danger" style="max-width: 600px; margin: 0 auto 24px auto;">
                <strong style="display: block; margin-bottom: 8px;">Gagal menyimpan jadwal! Cek kesalahan berikut:</strong>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('jadwal.store') }}">
                @csrf

                <div class="form-group">
                    <label>Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" class="form-control" placeholder="Contoh: 2025/2026 Ganjil" required>
                </div>

                <div class="form-group">
                    <label>Mata Kuliah</label>
                    <select name="matkul" class="form-control" required>
                        <option value="">-Pilih Mata Kuliah-</option>
                        @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id }}">{{ $matkul->kodeMatkul }} - {{ $matkul->namaMatkul }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: A, B, C" required>
                </div>

                <div class="form-group">
                    <label>Dosen Pengajar</label>
                    <select name="dosenPengajar" class="form-control" required>
                        <option value = "">-Pilih Dosen-</option>
                        @foreach($dosens as $dosen)
                            <option value = "{{ $dosen->id }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>   
                </div>
    
                <div class="form-group">
                    <label>Ruang & Waktu</label>
                    <input type="text" name="ruangDanWaktu" class="form-control" placeholder="Contoh: R.0304 / Senin 08:00" required>
                </div>

                <div class="form-group">
                    <label>Kode Join Teams</label>
                    <input type="text" name="kodeMSteams" class="form-control">
                </div>

                <div class="form-actions">
                    <a href="{{ route('jadwal.index') }}" class="btn-secondary">Kembali</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>