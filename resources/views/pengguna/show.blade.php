<!DOCTYPE html>
<html>
<head><title>detail pengguna</title></head>
<body>

<h1>detail Pengguna</h1>
<p>nama: {{ $pengguna->nama }}</p>
<p>email: {{ $pengguna->email }}</p>
<p>nIM: {{ $pengguna->nim ?? '-' }}</p>
<p>role: {{ ucfirst($pengguna->role) }}</p>
<p>terdaftar: {{ $pengguna->created_at->format('d/m/Y') }}</p>

<a href="{{ route('pengguna.edit', $pengguna) }}">edit</a>
<form action="{{ route('pengguna.destroy', $pengguna) }}" method="POST"
    onsubmit="return confirm('Hapus pengguna ini?')">
    @csrf @method('DELETE')
    <button>hapus</button>
</form>
<br><br>
<a href="{{ route('pengguna.index') }}">kembali</a>

</body>
</html>