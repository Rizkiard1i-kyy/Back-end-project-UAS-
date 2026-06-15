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
    Tahun Akademik:
    <br>
    <select name="tahunAkademik" required>
        <option value = "2026 Ganjil">2026 Ganjil</option>
        <option value="2025 Genap">2025 Genap</option>
        <option value="2025 Ganjil">2025 Ganjil</option>
    </select>
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