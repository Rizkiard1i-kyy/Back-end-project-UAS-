<h1>Edit Data Jadwal Kuliah</h1>

<form method="POST" action="{{ route('jadwal.update', $jadwal) }}">
    @csrf @method('PUT')

    Tahun Akademik:
    <br>
    <input name="tahun_akademik" value="{{ $jadwal->tahun_akademik }}" required>
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
    <input name="kelas" value="{{ $jadwal->kelas }}" required>
    <br><br>

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
    <input name="ruangDanWaktu" value="{{ $jadwal->ruangDanWaktu }}" required>
    <br><br>

    Kode Join Teams:
    <br>
    <input name="kodeMSteams" value="{{ $jadwal->kodeMSteams }}">
    <br><br>

    <button type="submit">Simpan Perubahan</button>
    <br><br>
    <a href="{{ route('jadwal.index') }}">Batal dan Kembali</a>
</form>