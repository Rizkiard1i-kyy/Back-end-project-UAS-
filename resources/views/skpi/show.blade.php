<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan SKPI</title>
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
<h1>Detail Kegiatan SKPI: {{ $skpi->kegiatan }}</h1>
        </div>

        <div class="detail-card">

        <div class="detail-row">
                <div class="detail-label">Nama Kegiatan</div>
                <div class="detail-value">{{ $skpi->kegiatan }}</div>
            </div>

        <div class="detail-row">
                <div class="detail-label">Jenis Kegiatan</div>
                <div class="detail-value">{{ $skpi->jenis }}</div>
            </div>
        <div class="detail-row">
                <div class="detail-label">Klasifikasi (Peran)</div>
                <div class="detail-value">{{ $skpi->klasifikasi }}</div>
            </div>
        <div class="detail-row">
                <div class="detail-label">Tanggal Input</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($skpi->tgl_input)->format('d F Y') }}</div>
            </div>

        <div class="detail-row">
                <div class="detail-label">Status Validasi</div>
                <div class="detail-value">
                    <span class="badge {{ $skpi->validasi == 'Tervalidasi' || $skpi->validasi == 'Valid' ? 'badge-approved' : 'badge-pending' }}">
                    {{ $skpi->validasi }}
                </span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Poin Didapat</div>
                <div class="detail-value">{{ $skpi->point }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Bukti Sertifikat</div>
                <div class="detail-value">
                    <a href="{{ $skpi->bukti }}" target="_blank" class="btn-primary" style="padding: 4px 12px; text-decoration: none;">Buka Link Drive</a>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('skpi.index') }}" class="btn-secondary">Kembali</a>
@if(auth()->user() && in_array(auth()->user()->role, ['mahasiswa']))
<a href="{{ route('skpi.edit', $skpi->id) }}" class="btn-action btn-edit" style="text-decoration: none;">Ubah Data</a>
@endif

@if(auth()->user())
<form action="{{ route('skpi.destroy', $skpi->id) }}" method="post" style="display:inline;">
    @csrf 
    @method('DELETE')
    <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus riwayat SKPI ini?')">Hapus Data</button>
</form>
@endif
        </div>
        @if(auth()->user() && !auth()->user()->isMahasiswa())
        <div class="form-card" style="margin-top: 32px; border: 2px dashed #cbd5e1; padding: 20px;">
            <h3 style="margin-top: 0;">Form Validasi (Khusus Admin/Dosen)</h3>
            
            <form action="{{ route('skpi.update', $skpi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label style="font-weight: bold;">Status Validasi</label>
                    <select name="validasi" class="form-control" style="margin-bottom: 16px;">
                        <option value="Belum" {{ $skpi->validasi == 'Belum' ? 'selected' : '' }}>Belum</option>
                        <option value="Valid" {{ $skpi->validasi == 'Valid' || $skpi->validasi == 'Tervalidasi' ? 'selected' : '' }}>Tervalidasi (Valid)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label style="font-weight: bold;">Poin Disetujui</label>
                    <input type="number" name="point" class="form-control" value="{{ $skpi->point }}" required>
                    <small style="color: #64748b; font-size: 0.8rem;">*Sesuaikan poin jika diperlukan sebelum klik simpan.</small>
                </div>

                <button type="submit" class="btn-primary" style="margin-top: 16px;">Simpan Validasi</button>
            </form>
        </div>
        @endif
    </div>
</body>    
</html>
