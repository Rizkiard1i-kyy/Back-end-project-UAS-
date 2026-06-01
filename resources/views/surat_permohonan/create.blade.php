<h1>Buat Surat Permohonan</h1>

<form action="{{ route('surat_permohonan.store') }}" method="POST">
    @csrf

    <label>Bahasa</label><br>

    <input type="radio" name="bahasa" value="Indonesia" checked required>
    Indonesia <br>
    <input type="radio" name="bahasa" value="Inggris">
    Inggris <br><br>

    <label>Jenis Surat Permohonan</label><br>
    <input type="radio" name="jenis_surat" value="Permohonan Kerja Praktik (Permission to Internship)" checked required>
    Permohonan Kerja Praktik (Permission to Internship) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Kunjungan (Permission to Research Visit)">
    Permohonan Kunjungan (Permission to Research Visit) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Pengajuan Beasiswa (Scholarship)">
    Permohonan Pengajuan Beasiswa (Scholarship) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Pengajuan Proposal (Permission to submission of Proposal)">
    Permohonan Pengajuan Proposal (Permission to submission of Proposal) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Survei atau Riset (Permission to Research Survey)">
    Permohonan Survei atau Riset (Permission to Research Survey) <br>
    <input type="radio" name="jenis_surat" value="Permohonan Visa (Visa Application)">
    Permohonan Visa (Visa Application) <br>
    <br>

    <button type="submit">Simpan</button>
</form>