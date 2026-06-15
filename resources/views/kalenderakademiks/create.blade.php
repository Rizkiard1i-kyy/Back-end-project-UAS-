<h1>Buat Data Kalender Akademik Baru</h1>
<form method="POST" action="{{ route('kalenderAkademik.store') }}">
    @csrf
    Tanggal Mulai:
    <br>
    <input type="date" name="tanggalMulai" value="{{ old('tanggalMulai') }}" required>
    <br>
    <br>
    Tanggal Selesai:
    <br>
    <input type="date" name="tanggalSelesai" value="{{ old('tanggalSelesai') }}" required>
    <br>
    <br>
    Nama Kegiatan:
    <br>
    <input name="namaKegiatan" value="{{ old('namaKegiatan') }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('kalenderAkademik.index') }}">Kembali</a>