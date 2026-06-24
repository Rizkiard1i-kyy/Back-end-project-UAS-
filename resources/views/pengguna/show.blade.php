<!DOCTYPE html>
<html>
<head>
    <title>detail pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
            </div>
            <h1>halo! selamat datang {{ auth()->user()->nama ?? 'admin' }} di lintar x!</h1>
        </div>
    </header>

    <div class="container">

        <div class="page-header">
            <h1>detail pengguna</h1>
        </div>

        <div class="detail-card">
            <p>nama: {{ $pengguna->nama }}</p>
            <p>email: {{ $pengguna->email }}</p>
            <p>nim: {{ $pengguna->nim ?? '-' }}</p>
            <p>role: {{ ucfirst($pengguna->role) }}</p>
            <p>terdaftar: {{ $pengguna->created_at->format('d/m/Y') }}</p>

            <div class="form-actions">
                <a href="{{ route('pengguna.edit', $pengguna) }}"
                class="btn-primary">
                    edit
                </a>

                <form action="{{ route('pengguna.destroy', $pengguna) }}"
                    method="POST"
                    onsubmit="return confirm('Hapus pengguna ini?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn-secondary">
                        hapus
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('pengguna.index') }}" class="btn-back">
            kembali
        </a>

    </div>

</body>
</html>