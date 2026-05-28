<h1>Edit Data Jadwal Kuliah</h1>

<form method="POST" action="{{ route('jadwal.update', $jadwal) }}">
    @csrf @method('PUT')
    
    Kode MK:
    <br>
    <input name="kodeMK" value="{{ $jadwal->kodeMK }}" required>
    <br><br>

    Nama MK:
    <br>
    <input name="namaMK" value="{{ $jadwal->namaMK }}" required>
    <br><br>

    SKS:
    <br>
    <input type="number" name="sks" value="{{ $jadwal->sks }}" required>
    <br><br>

    Kelas:
    <br>
    <input name="kelas" value="{{ $jadwal->kelas }}" required>
    <br><br>

    Dosen Pengajar:
    <br>
    <input name="dosenPengajar" value="{{ $jadwal->dosenPengajar }}" required>
    <br><br>

    Ruang & Waktu:
    <br>
    <input name="ruangDanWaktu" value="{{ $jadwal->ruangDanWaktu }}" required>
    <br><br>

    Kode Join Teams:
    <br>
    <input name="kodeMSteams" value="{{ $jadwal->kodeMSteams }}">
    <br><br>

    Email Dosen:
    <br>
    <input type="email" name="emailDosen" value="{{ $jadwal->emailDosen }}" required>
    <br><br>

    <button type="submit">Simpan Perubahan</button>
    <br><br>
    <a href="{{ route('jadwal.index') }}">Batal dan Kembali</a>
</form>