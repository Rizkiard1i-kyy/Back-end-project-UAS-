<h1>Ajukan Konsultasi</h1>

@if($errors->any())
    <p>{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('konsultasi.store') }}">
    @csrf

    <label>dosen</label>
    <br>
    <input type="text" name="nama_dosen" value="{{ old('nama_dosen') }}"required>
    <br><br>

    <label>tanggal (liat conth 12-12-2026)</label>
    <br>
    <input type="text" name="tanggal" value="{{ old('tanggal') }}" required>
    <br><br>

    <label>jam (liat conth ini: 14:00 - 15:30)</label>
    <br>
    <input type="text" name="jam" value="{{ old('jam') }}" required>
    <br><br>

    <label>topik konsultasi</label><br>
    <input type="text" name="topik" value="{{ old('topik') }}" required>
    <br><br>

    <button type="submit">kirim</button>
</form>

<br>
<a href="{{ route('konsultasi.index') }}">kembali</a>