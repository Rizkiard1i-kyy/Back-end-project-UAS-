<!DOCTYPE html>
<html>
<head>
    <title>edit pengguna</title>
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
            <h1>edit pengguna: {{ $pengguna->nama }}</h1>
        </div>

        @if($errors->any())
            <p class="badge badge-rejected">
                @foreach($errors->all() as $e)
                    {{ $e }}<br>
                @endforeach
            </p>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('pengguna.update', $pengguna) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $pengguna->nama) }}" required>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $pengguna->email) }}" required>
                </div>

                <div class="form-group">
                    <label>nim <small>(kosongin aja klo bukan mahasiswa)</small></label>
                    <input type="text" name="nim" class="form-control"
                        value="{{ old('nim', $pengguna->nim) }}">
                </div>

                <div class="form-group">
                    <label>password baru <small>(kosongin aja klo g di ganti)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>konfirmasi password baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label>role</label>
                    <select name="role" class="form-control" required>
                        <option value="mahasiswa"
                            @if(old('role', $pengguna->role) == 'mahasiswa') selected @endif>
                            mahasiswa
                        </option>

                        <option value="dosen"
                            @if(old('role', $pengguna->role) == 'dosen') selected @endif>
                            dosen
                        </option>

                        <option value="admin"
                            @if(old('role', $pengguna->role) == 'admin') selected @endif>
                            admin
                        </option>
                    </select>
                </div>

                <div class="form-actions">
                    <a href="{{ route('pengguna.index') }}" class="btn-secondary">batal</a>
                    <button class="btn-primary btn-submit">simpan perubahan</button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>