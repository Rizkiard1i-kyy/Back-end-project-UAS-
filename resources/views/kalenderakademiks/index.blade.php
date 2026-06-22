<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik {{ $tahunDipilih }}</title>
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
            <h1>Kalender Akademik {{ $tahunDipilih }}</h1>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('kalenderAkademik.create') }}" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Data Kalender Akademik Baru
                </a>
            @endif
        </div>

        @if ($kalenderAkademik->isEmpty())
            <p>Belum ada data kalender akademik yang tersimpan.</p>
        @else
            <div class="form-group">
                <form action="{{ route('kalenderAkademik.index') }}" method="GET">
                    <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                        @foreach($daftarTahun as $tahun)
                            <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">No</th>
                            <th>Tanggal</th>            
                            <th>Keterangan</th>
                            @if(auth()->user()->isAdmin())
                                <th style="width: 210px">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kalenderAkademik as $kalenderAkademik)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>
                                <a> {{ $kalenderAkademik->tanggalMulai->format('d M Y') }} s/d {{ $kalenderAkademik->tanggalSelesai->format('d M Y') }}</a>
                            </td>
                            <td>
                                <a> {{ $kalenderAkademik->namaKegiatan }}</a>
                            </td>
                            @if(auth()->user()->isAdmin())
                                <td>
                                    <a href="{{ route('kalenderAkademik.edit', $kalenderAkademik) }}" class="btn-action btn-edit">
                                        Ubah
                                    </a>
                                    <form action="{{ route('kalenderAkademik.destroy', $kalenderAkademik) }}" method="post" style="display:inline;">
                                        @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data kalender akademik ini?')">
                                                Hapus Data
                                            </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="/dashboard" class="btn-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali Ke Dashboard
        </a>
    </div>
</body>
</html>
