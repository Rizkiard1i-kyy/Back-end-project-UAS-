<!DOCTYPE html>
<html>
<head><title>tambah pengguna</title></head>
<body>

<h1>tambah pengguna baru</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('pengguna.store') }}">
    @csrf

    Nama:
    <br>
    <input type="text" name="nama" value="{{ old('nama') }}" required>
    <br><br>

    Email:
    <br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br><br>

    NIM <small>(kosongin aja klo bukan mahasiswa )</small>:
    <br>
    <input type="text" name="nim" value="{{ old('nim') }}">
    <br><br>

    Password:
    <br>
    <input type="password" name="password" required>
    <br><br>

    Konfirmasi Password:
    <br>
    <input type="password" name="password_confirmation" required>
    <br><br>

    Role:
    <br>
    <select name="role" required>
        <option value="">-- pilih Role --</option>
        <option value="mahasiswa"@selected(old('role')=='mahasiswa')>mahasiswa</option>
        <option value="dosen"@selected(old('role')=='dosen')>dosen</option>
        <option value="admin"@selected(old('role')=='admin')>admin</option>
    </select>
    <br><br>

    <button>Simpan</button>
    <a href="{{ route('pengguna.index') }}">Batal</a>
</form>

</body>
</html>