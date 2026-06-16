<h1>Tambah Jadwal Kuliah Baru</h1>
<form method="POST" action="{{ route('jadwal.store') }}">
    @csrf

    Tahun Akademik:
    <br>
    <input name="tahun_akademik" required>
    <br><br>

    Mata Kuliah:
    <br>
    <select name="matkul" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($matkuls as $matkul)
            <option value = "{{ $matkul->id }}">{{ $matkul->kodeMatkul }} - {{ $matkul->namaMatkul }}</option>
        @endforeach
    </select>
    <br><br>
    
    Kelas:
    <br>
    <input name="kelas" required>
    <br>
    <br>
    
    Dosen Pengajar:
    <br>
    <select name="dosenPengajar" required>
        <option value = "">-Pilih Dosen-</option>
        @foreach($dosens as $dosen)
            <option value = "{{ $dosen->id }}">{{ $dosen->nama }}</option>
        @endforeach
    </select>   
    <br><br>
    
    Ruang & Waktu:
    <br>
    <input name="ruangDanWaktu" required>
    <br>
    <br>
    
    Kode Join Teams:
    <br>
    <input name="kodeMSteams">
    <br>
    <br>
    
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('jadwal.index') }}">Kembali</a>