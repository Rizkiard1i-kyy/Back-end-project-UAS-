<h1>Tambah Data Kegiatan SKPI</h1>
<form method="POST" action="{{ route('skpi.store') }}">
    @csrf
    Nama Kegiatan:
    <br>
    <input type="text" name="kegiatan" required>
    <br>
    <br>
    Jenis Kegiatan:
    <br>
    <input type="text" name="jenis" required>
    <br>
    <br>
    Klasifikasi (Peran):
    <br>
    <select name="klasifikasi" required>
        <option value="Peserta">Peserta</option>
        <option value="Panitia">Panitia</option>
        <option value="Ketua Umum">Ketua Umum</option>
    </select>
    <br>
    <br>
    Link Bukti Sertifikat (Google Drive):
    <br>
    <input type="url" name="bukti" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>
<br><br>
<a href="{{ route('skpi.index') }}">Kembali</a>