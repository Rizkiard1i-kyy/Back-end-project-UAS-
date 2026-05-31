<!DOCTYPE html>
<html>
<head><title>manajemen pengguna</title></head>
<body>

<h1>manajemen pengguna</h1>

<p{{ session('success') }}</p>

<a href="{{ route('pengguna.create') }}"> tambah pengguna</a>
<br><br>

@if($pengguna->isEmpty())
<p>belum ada pengguna.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width:50px">no</th>
            <th style="width:200px">nama</th>
            <th style="width:250px">email</th>
            <th style="width:120px">nIM</th>
            <th style="width:100px">role</th>
            <th style="width:120px">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengguna as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->nim ?? '-' }}</td>
            <td>{{ ucfirst($p->role) }}</td>
            <td>
                <a href="{{ route('pengguna.show', $p) }}">detail</a>
                <a href="{{ route('pengguna.edit', $p) }}">edit</a>
                <form action="{{ route('pengguna.destroy', $p) }}" method="POST"
                    onsubmit="return confirm('Hapus pengguna {{ $p->nama }}?')">
                    @csrf @method('DELETE')
                    <button>hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">kembali ke dashboard</a>
</body>
</html>