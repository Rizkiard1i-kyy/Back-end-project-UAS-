<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kehadiran</title>
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
            <h1>Edit Data Kehadiran</h1>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('kehadiran.update', $kehadiran) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="matkul">Mata Kuliah</label>
                    <select name="matkul" class="form-control" required>
                        <option value = "">-Pilih Mata Kuliah-</option>
                        @foreach($matkuls as $matakuliah)
                            <option value = "{{ $matakuliah->id }}" {{ old('matkul', $kehadiran->matkul) == $matakuliah->id ? 'selected' : '' }}>
                                {{ $matakuliah->kodeMatkul }} - {{ $matakuliah->namaMatkul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahunAkademik">Tahun Akademik</label>
                    <select name="tahunAkademik" class="form-control" required>
                        <option value="">Pilih Tahun Akademik</option>
                        <option value = "2026 Ganjil" {{ old('tahunAkademik', $kehadiran->tahunAkademik) == '2026 Ganjil' ? 'selected' : '' }}>2026 Ganjil</option>
                        <option value="2025 Genap" {{ old('tahunAkademik', $kehadiran->tahunAkademik) == '2025 Genap' ? 'selected' : '' }}>2025 Genap</option>
                        <option value="2025 Ganjil" {{ old('tahunAkademik', $kehadiran->tahunAkademik) == '2025 Ganjil' ? 'selected' : '' }}>2025 Ganjil</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaDosen">Dosen</label>
                    <select name="namaDosen" class="form-control" required>
                        <option value = "">-Pilih Dosen-</option>
                        @foreach($dosens as $dosen)
                            <option value = "{{ $dosen->id }}" {{ old('namaDosen', $kehadiran->namaDosen) == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nim">Mahasiswa</label>
                    <select name="nim" class="form-control" required>
                        <option value = "">-Pilih Mahasiswa-</option>
                        @foreach($mahasiswas as $mhs)
                            <option value = "{{ $mhs->id }}" {{ old('nim', $kehadiran->nim) == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nim }} - {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input name="kelas" value="{{ old('kelas', $kehadiran->kelas) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="jumlahPertemuan">Jumlah Pertemuan</label>
                    <input type="number" name="jumlahPertemuan" value="{{ old('jumlahPertemuan', $kehadiran->jumlahPertemuan) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="jumlahKehadiran">Jumlah Kehadiran</label>
                    <input type="number" name="jumlahKehadiran" value="{{ old('jumlahKehadiran', $kehadiran->jumlahKehadiran) }}" class="form-control" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('kehadiran.show', $kehadiran) }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>