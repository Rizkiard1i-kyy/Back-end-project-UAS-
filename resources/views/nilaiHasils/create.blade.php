<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Data Nilai KHS baru</title>
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
            <h1>Buat Data Nilai KHS Baru</h1>
        </div>

        <div class="form-card">
            <form method= "POST" action="{{ route('nilaiHasil.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <select name="nim" class="form-control" required>
                        <option value = "">-Pilih NIM Mahasiswa-</option>
                        @foreach($mahasiswas as $mhs)
                            <option value = "{{ $mhs->id }}" {{ old('nim') == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nim }} - {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaDosen">DOSEN</label>
                    <select name="namaDosen" class="form-control" required>
                        <option value = "">-Pilih Dosen-</option>
                        @foreach($dosens as $dosen)
                            <option value = "{{ $dosen->id }}" {{ old('namaDosen') == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahunAkademik">TAHUN AKADEMIK</label>
                    <select name="tahunAkademik" class="form-control" required>
                        <option value="">Pilih Tahun Akademik</option>
                        <option value = "20251" {{ old('tahunAkademik') == '20251' ? 'selected' : '' }}>Gasal 2025</option>
                        <option value="20252" {{ old('tahunAkademik') == '20252' ? 'selected' : '' }}>Genap 2025</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaMataKuliah">MATA KULIAH</label>
                    <select name="namaMataKuliah" class="form-control" required>
                        <option value = "">-Pilih Mata Kuliah-</option>
                        @foreach($namaMataKuliahs as $namaMataKuliah)
                            <option value = "{{ $namaMataKuliah->id }}" {{ old('namaMataKuliah') == $namaMataKuliah->id ? 'selected' : '' }}>
                                {{ $namaMataKuliah->kodeMatkul }} - {{ $namaMataKuliah->namaMatkul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tugas">NILAI TUGAS</label>
                    <input type="number" name="tugas" value="{{ old('tugas') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="uts">NILAI UTS</label>
                    <input type="number" name="uts" value="{{ old('uts') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="uas">NILAI UAS</label>
                    <input type="number" name="uas" value="{{ old('uas') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">STATUS</label>
                    <input name="status" value="{{ old('status') }}" class="form-control" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('nilaiHasil.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>