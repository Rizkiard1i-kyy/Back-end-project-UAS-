<html>
<head>
    <title>Kartu Studi Mahasiswa</title>
</head>
<body>

<div>
    <label>Tahun akademik :</label>
    <div> {{ $ksm->semester }} {{ trim(explode('/', $ksm->tahunAkademik)[0]) }} </div>

    <a href="{{ route('ksm.edit', $ksm) }}">Edit</a>

    <form method="POST" action="{{ route('ksm.destroy', $ksm) }}"
          onsubmit="return confirm('Hapus KSM ini?')">
        @csrf
        @method('DELETE')
        <button>Hapus</button>
    </form>
</div>

<div>
    <div>AKADEMIK - KARTU STUDI MAHASISWA</div>
    <div>* Cetak KSM HARUS DENGAN PRINTER WARNA</div>

    <div>
        Biro Administrasi Akademik<br>
        Universitas Tarumanagara<br>
        Jl. Let. Jend. S. Parman No. 1 Jakarta 11440<br>
        Tlp. (021) 5671747 (Hunting) Fax: (021) 5604478
    </div>

    <div>KARTU STUDI MAHASISWA (KSM)</div>

    <div>
        <div>
            <div>
                <span>Nama</span>
                <span>:</span>
                <span">{{ $ksm->nama }}</span>
            </div>
            <div>
                <span>No. Pokok Mahasiswa</span>
                <span>:</span>
                <span>{{ $ksm->nim }}</span>
            </div>
            <div>
                <span>Fak./Prog. Studi</span>
                <span>:</span>
                <span>{{ $ksm->prodi }}</span>
            </div>
        </div>
        <div>
            <div>
                <span>Semester</span>
                <span>:</span>
                <span>{{ $ksm->semester }}</span>
            </div>
            <div>
                <span>Tahun Akademik</span>
                <span>:</span>
                <span>{{ $ksm->tahunAkademik }}</span>
            </div>
        </div>
    </div>

<div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode M.K</th>
                    <th>Nama Mata Kuliah</th>
                    <th>sks</th>
                    <th>Kls</th>
                    <th>Status</th>
                    <th>Paraf Pengawas</th>
                </tr>
                <tr>
                    <th>UTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ksm->mataKuliahs as $mk)
                <tr>
                    <td>{{ $mk->no }}</td>
                    <td>{{ $mk->kodeMatkul }}</td>
                    <td>{{ $mk->namaMatkul }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->kelas }}</td>
                    <td><span>{{ $mk->status }}</span></td>
                    <td></td> </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>JUMLAH  SKS</td>
                    <td>{{ $ksm->totalSks }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
        <div>
            <div>
                <div> Catatan </div>
                <div>
                    <p>1. Telitilah Mata Kuliah Kelas yang tercantum pd KSM ini</p>
                    <p>2. Apabila terdapat kesalahan, kekurangan/kelebihan sks harap lapor ke Biro Adak masing-masing kampus dengan membawa fotocopy KRRS/KSS</p>
                    <p>3. KSM ini berlaku sebagai tanda mengikuti UTS, UAS dan Ujian Skripsi/Tugas Akhir/Tesis/Desertasi</p>
                    <p>4. Informasi Akademik OnLine dapat diakses melalui https://lintar.untar.ac.id</p>
                </div>
            </div>
        </div>

        <div>
            <div>Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div>KETUA LEMBAGA PEMBELAJARAN</div>
            <div>TTD</div>
            <div>Dr. Ir. Steven Darmawan, S.T., M.T.</div>
        </div>
    </div>
</div>

<br>
<a href="{{ route('ksm.index') }}">← Kembali ke Daftar KSM</a>

</body>
</html>
