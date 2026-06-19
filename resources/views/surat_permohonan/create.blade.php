<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Surat Permohonan</title>
    
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
        <h1>Buat Surat Permohonan</h1>
    </div>
 
    <div class="form-card">
        <form action="{{ route('surat_permohonan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="jenis_surat">Jenis Surat</label>
                <select name="jenis_surat" id="jenis_surat" class="form-control" required>
                    <option value="" disabled selected>Pilih jenis surat...</option>
                    <option value="Permohonan Kerja Praktik (Permission to Internship)">Permohonan Kerja Praktik (Permission to Internship)</option>
                    <option value="Permohonan Kunjungan (Permission to Research Visit)">Permohonan Kunjungan (Permission to Research Visit)</option>
                    <option value="Permohonan Pengajuan Beasiswa (Scholarship)">Permohonan Pengajuan Beasiswa (Scholarship)</option>
                    <option value="Permohonan Pengajuan Proposal (Permission to submission of Proposal)">Permohonan Pengajuan Proposal (Permission to submission of Proposal)</option>
                    <option value="Permohonan Survei atau Riset (Permission to Research Survey)">Permohonan Survei atau Riset (Permission to Research Survey)</option>
                    <option value="Permohonan Visa (Visa Application)">Permohonan Visa (Visa Application)</option>
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
                <a href="{{ route('surat_permohonan.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary btn-submit">Simpan</button>
            </div>
        </form>
    </div>

</div>

</body>
</html>