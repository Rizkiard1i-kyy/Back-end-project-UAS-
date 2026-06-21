<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat Keterangan</title>
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
        <h1>Pengajuan Surat</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('surat_keterangan.store') }}">
            @csrf

            <div class="form-group">
                <label for="jenis_surat">Jenis Surat</label>
                <select name="jenis_surat" id="jenis_surat" class="form-control" required>
                    <option value="" disabled selected>Pilih jenis surat...</option>
                    <option value="Beasiswa (Scholarship)">Beasiswa (Scholarship)</option>
                    <option value="Kantor Orang Tua (Parent Office)">Kantor Orang Tua (Parent Office)</option>
                    <option value="Kerja Praktek (Job Training)">Kerja Praktek (Job Training)</option>
                    <option value="Mahasiswa Aktif (Active Student)">Mahasiswa Aktif (Active Student)</option>
                    <option value="Magang (Internship)">Magang (Internship)</option>
                    <option value="Mengurus BPJS (BPJS Administration)">Mengurus BPJS (BPJS Administration)</option>
                    <option value="Permohonan Visa (Visa Application)">Permohonan Visa (Visa Application)</option>
                    <option value="Survei (Survey)">Survei (Survey)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bahasa">Bahasa Pengantar</label>
                <select name="bahasa" id="bahasa" class="form-control" required>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Inggris">Inggris</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nim">NIM Mahasiswa</label>
                <input type="text" name="nim" id="nim" class="form-control" value="{{ auth()->user()->nim }}" readonly>
            </div>

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 32px;">
                <a href="{{ route('surat_keterangan.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary btn-submit">Simpan</b utton>
            </div>
        </form>
    </div>

</div>

</body>
</html>