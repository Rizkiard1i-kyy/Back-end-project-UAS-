<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>

    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
            <h1>Halo! Selamat datang {{ auth()->user()->nama ?? 'Admin' }} di Lintar X!</h1>
        </div>
    </header>

    <div class="container">

        <div class="page-header">
            <h1>Detail Konsultasi</h1>
        </div>

        <div class="detail-card">

            <div class="detail-row">
                <span class="detail-label">mahasiswa</span>
                <span class="detail-value">
                    {{ $konsultasi->nama_mahasiswa }} ({{ $konsultasi->nim }})
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">dosen</span>
                <span class="detail-value">
                    {{ $konsultasi->nama_dosen }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">tanggal</span>
                <span class="detail-value">
                    {{ $konsultasi->tanggal->format('d/m/Y') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">jam</span>
                <span class="detail-value">
                    {{ $konsultasi->jam }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">topik</span>
                <span class="detail-value">
                    {{ $konsultasi->topik }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">status</span>
                <span class="detail-value">
                    {{ ucfirst($konsultasi->status) }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">catatan</span>
                <span class="detail-value">
                    {{ $konsultasi->catatan ?? '-' }}
                </span>
            </div>

        </div>

        @if(auth()->user()->isDosen() && $konsultasi->dosen_id === auth()->id() && $konsultasi->status === 'menunggu')

            <div class="form-card">
                <form method="POST" action="{{ route('konsultasi.update', $konsultasi) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>keputusan</label>

                        <select name="status" class="form-control" required>
                            <option value="disetujui">setujui</option>
                            <option value="ditolak">tolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>catatan</label>

                        <textarea name="catatan" class="form-control"></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary btn-submit">
                            simpan keputusan
                        </button>
                    </div>

                </form>
            </div>

        @endif

        <a href="{{ route('konsultasi.index') }}" class="btn-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"stroke="currentColor" stroke-width="2"stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline>
            </svg>kembali
        </a>

    </div>

</body>

</html>