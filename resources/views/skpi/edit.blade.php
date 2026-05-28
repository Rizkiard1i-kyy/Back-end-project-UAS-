<h1>Edit Data Kegiatan SKPI</h1>

<form method="POST" action="{{ route('skpi.update', $skpi) }}">
    @csrf @method('PUT')
    
    Nama Kegiatan:
    <br>
    <input name="kegiatan" value="{{ $skpi->kegiatan }}" required>
    <br><br>

    Jenis Kegiatan:
    <br>
    <input name="jenis" value="{{ $skpi->jenis }}" required>
    <br><br>

    Klasifikasi (Peran):
    <br>
    <select name="klasifikasi" required>
        <option value="Peserta" {{ $skpi->klasifikasi == 'Peserta' ? 'selected' : '' }}>Peserta</option>
        <option value="Panitia" {{ $skpi->klasifikasi == 'Panitia' ? 'selected' : '' }}>Panitia</option>
        <option value="Ketua Umum" {{ $skpi->klasifikasi == 'Ketua Umum' ? 'selected' : '' }}>Ketua Umum</option>
    </select>
    <br><br>

    Link Bukti Sertifikat (Google Drive):
    <br>
    <input type="url" name="bukti" value="{{ $skpi->bukti }}" required>
    <br><br>

    <button type="submit">Simpan Perubahan</button>
    <br><br>
    <a href="{{ route('skpi.index') }}">Batal dan Kembali</a>
</form>