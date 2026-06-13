<h1>Edit Data Kalender Akademik</h1>
<form method="POST" action="{{ route('kalenderAkademik.update', $kalenderAkademik) }}">
    @csrf @method('PUT')
    Tanggal Mulai:
    <br>
    <input name="tanggalMulai" value="{{ $kalenderAkademik-> tanggalMulai }}" required>
    <br>
    <br>
    Tanggal Selesai:
    <br>
    <input name="tanggalSelesai" value="{{ $kalenderAkademik-> tanggalSelesai }}" required>
    <br>
    <br>
    Nama Kegiatan:
    <br>
    <input name="namaKegiatan" value="{{ $kalenderAkademik-> namaKegiatan }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('kalenderAkademik.index') }}">Kembali</a>