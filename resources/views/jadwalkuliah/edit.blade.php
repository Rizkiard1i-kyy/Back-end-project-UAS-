<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kuliah</title>
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
    <div class="page-header">
        <h1>Edit Data Jadwal Kuliah</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('jadwal.update', $jadwal) }}">
    @csrf 
    @method('PUT')

    <div class="form-group">
    <label>Tahun Akademik</label>
    <input type="text" name="tahun_akademik" class="form-control" value="{{ $jadwal->tahun_akademik }}" required>
    </div>
    
    <div class="form-group">
    <label>Mata Kuliah</label>
    <select name="matkul" class="form-control" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($matkuls as $matkul)
            <option value="{{ $matkul->id }}" {{ $jadwal->matkul == $matkul->id ? 'selected' : '' }}>
                            {{ $matkul->kodeMatkul }} - {{ $matkul->namaMatkul }}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group">
    <label>Kelas</label>
    <input type="text" name="kelas" class="form-control" value="{{ $jadwal->kelas }}" required>
    </div>

    <div class="form-group">
    <label>Dosen Pengajar</label>
    <select name="dosenPengajar" class="form-control" required>
        <option value = "">-Pilih Dosen-</option>
        @foreach($dosens as $dosen)
            <option value = "{{ $dosen->id }}" {{ $jadwal->dosenPengajar == $dosen->id ? 'selected' : '' }}>
                {{ $dosen->nama }}</option>
        @endforeach
    </select>   
    </div>

    <div class="form-group">
        <label>Ruang & Waktu</label>
        <input type="text" name="ruangDanWaktu" class="form-control" value="{{ $jadwal->ruangDanWaktu }}" required>
    </div>

    <div class="form-group">
        <label>Kode Join Teams</label>
        <input type="text" name="kodeMSteams" class="form-control" value="{{ $jadwal->kodeMSteams }}">
    </div>

    <div class="form-actions">
    <button type="submit" class="btn-primary btn-submit">Simpan Perubahan</button>
    <a href="{{ route('jadwal.index') }}" class="btn-secondary">Batal dan Kembali</a>
    </div>
</form>
</div>
</div>
</body>
</html>