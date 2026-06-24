<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Nilai KHS</title>
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
            <h1>Edit Data Nilai KHS</h1>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('nilaiHasil.update', $nilaiHasil) }}">
            @csrf @method('PUT')
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <select name="nim" class="form-control" required>
                        <option value = "">-Pilih NIM Mahasiswa-</option>
                        @foreach($mahasiswas as $mhs)
                            <option value = "{{ $mhs->id }}"{{ old('nim', $nilaiHasil->nim) == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nim }} - {{ $mhs->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaDosen">NAMA DOSEN</label>
                    <select name="namaDosen" class="form-control" required>
                        <option value = "">-Pilih Dosen-</option>
                        @foreach($dosens as $dosen)
                            <option value = "{{ $dosen->id }}"{{ old('namaDosen', $nilaiHasil->namaDosen) == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tahunAkademik">TAHUN AKADEMIK</label>
                    <select name="tahunAkademik" class="form-control" required>
                        <option value="">Pilih Tahun Akademik</option>
                        <option value = "20251" {{ old('tahunAkademik', $nilaiHasil->tahunAkademik) == '20251' ? 'selected' : '' }}>Gasal 2025</option>
                        <option value="20252" {{ old('tahunAkademik', $nilaiHasil->tahunAkademik) == '20252' ? 'selected' : '' }}>Genap 2025</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="namaMataKuliah">MATA KULIAH</label>
                    <select name="namaMataKuliah" class="form-control" required>
                        <option value = "">-Pilih Mata Kuliah-</option>
                        @foreach($namaMataKuliahs as $namaMataKuliah)
                            <option value = "{{ $namaMataKuliah->id }}" {{ old('namaMataKuliah', $nilaiHasil->namaMataKuliah) == $namaMataKuliah->id ? 'selected' : '' }}>
                                {{ $namaMataKuliah->kodeMatkul }} - {{ $namaMataKuliah->namaMatkul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tugas">NILAI TUGAS</label>
                    <input type="number" name="tugas" value="{{ old('tugas', $nilaiHasil->tugas) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="uts">NILAI UTS</label>
                    <input type="number" name="uts" value="{{ old('uts', $nilaiHasil->uts) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="uas">NILAI UAS</label>
                    <input type="number" name="uas" value="{{ old('uas', $nilaiHasil->uas) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">STATUS</label>
                    <input name="status" value="{{ old('status', $nilaiHasil->status) }}" class="form-control" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('nilaiHasil.show', $nilaiHasil) }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>