<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail UKM</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
                <h1>Detail UKM {{ $ukm->nama }} </h1>
            </div>
    </header>

    <div class="container">
        <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
            <h1>Detail UKM</h1>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label"> Detail</div>
                <div class="detail-value">{{ $ukm->detail }}</div>
            </div>

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 24px;">
                <a href="{{ route('ukm.index') }}" class="btn-secondary">Kembali</a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('ukm.edit', $ukm) }}" class="btn-action btn-edit">
                        Edit Data
                    </a>
                    <form action="{{ route('ukm.destroy', $ukm) }}" method="post" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action btn-clear-chat" onclick="return confirm('Anda yakin ingin menghapus data kehadiran ini?')">
                            Hapus Data
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>