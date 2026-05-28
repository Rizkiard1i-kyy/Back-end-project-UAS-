<h1>Buat Surat Keterangan</h1>

<form action="{{ route('surat_keterangan.store') }}" method="POST">
    @csrf

    <label>Bahasa</label><br>

    <input type="radio" name="bahasa" value="Indonesia" checked required>
    Indonesia <br>
    <input type="radio" name="bahasa" value="Inggris">
    Inggris <br><br>

    <label>Jenis Surat Keterangan</label><br>
    <input type="radio" name="jenis_surat" value="Beasiswa (Scholarship)" checked required>
    Beasiswa (Scholarship) <br>
    <input type="radio" name="jenis_surat" value="Kantor Orang Tua (Parent Office)">
    Kantor Orang Tua (Parent Office) <br>
    <input type="radio" name="jenis_surat" value="Kerja Praktek (Job Training)">
    Kerja Praktek (Job Training) <br>
    <input type="radio" name="jenis_surat" value="Mahasiswa Aktif (Active Student)">
    Mahasiswa Aktif (Active Student) <br>
    <input type="radio" name="jenis_surat" value="Mengurus BPJS (BPJS Administration)">
    Mengurus BPJS (BPJS Administration) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Visa (Visa Application)">
    Permohonan Visa (Visa Application) <br>
    <input type="radio" name="jenis_surat" value="Survei (Survey)">
    Survei (Survey) <br>
    <input type="radio" name="jenis_surat" value="Magang (Internship)">
    Magang (Internship) <br><br>

    <button type="submit">Simpan</button>
</form>