<!DOCTYPE html>
<html>
<head><title>edit pengguna</title></head>
<body>

<h1>Edit engguna: {{ $pengguna->nama }}</h1>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('pengguna.update', $pengguna) }}">
    @csrf @method('PUT')

    Nama:
    <br>
    <input type="text" name="nama" value="{{ old('nama', $pengguna->nama) }}" required>
    <br><br>

    Email:
    <br>
    <input type="email" name="email" value="{{ old('email', $pengguna->email) }}" required>
    <br><br>

    NIM <small>(kosongin aja klo bukan mahasiswa)</small>:
    <br>
    <input type="text" name="nim" value="{{ old('nim', $pengguna->nim) }}">
    <br><br>

    Password Baru <small>(kosongin aja klo g di ganti)</small>:
    <br>
    <input type="password" name="password">
    <br><br>

    Konfirmasi Password Baru:
    <br>
    <input type="password" name="password_confirmation">
    <br><br>

    Role:
    <br>
    <select name="role" required>
        <option value="mahasiswa"@if(old('role', $pengguna->role) == 'mahasiswa') selected @endif>mahasiswa</option>
        <option value="dosen"@if(old('role', $pengguna->role) == 'dosen') selected @endif>dosen</option>
        <option value="admin"@if(old('role', $pengguna->role) == 'admin') selected @endif>admin</option>
    </select>
    <br><br>

    <button>simpan perubahan</button>
    <a href="{{ route('pengguna.index') }}">batal</a>
</form>

</body>
</html>