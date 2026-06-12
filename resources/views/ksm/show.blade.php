<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Studi Mahasiswa</title>
</head>
<body>

<div class="toolbar">
    <label>Tahun akademik :</label>
    <span class="tahun-val">{{ $ksm->semester }} {{ explode(' / ', $ksm->tahunAkademik)[0] }}</span>

    <button class="btn" onclick="window.print()">CETAK KSM</button>
    <button class="btn" onclick="window.print()">CETAK KSM BHS.ING</button>
    <a class="btn" href="{{ route('ksm.edit', $ksm) }}">Edit</a>

    <form method="POST" action="{{ route('ksm.destroy', $ksm) }}" style="display:inline"
          onsubmit="return confirm('Hapus KSM ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn danger">Hapus</button>
    </form>
</div>

<div class="ksm-card">
    <div class="ksm-header">AKADEMIK - KARTU STUDI MAHASISWA</div>
    <div class="ksm-notice">* Cetak KSM HARUS DENGAN PRINTER WARNA</div>

    <div class="ksm-address">
        Biro Administrasi Akademik<br>
        Universitas Tarumanagara<br>
        Jl. Let. Jend. S. Parman No. 1 Jakarta 11440<br>
        Tlp. (021) 5671747 (Hunting) &nbsp; Fax: (021) 5604478
    </div>

    <div class="ksm-title">KARTU STUDI MAHASISWA (KSM)</div>

    <div class="ksm-meta">
        <div>
            <div class="meta-row">
                <span class="meta-label">Nama</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $ksm->nama }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">No. Pokok Mahasiswa</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $ksm->nim }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Fak./Prog. Studi</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $ksm->prodi }}</span>
            </div>
        </div>
        <div>
            <div class="meta-row">
                <span class="meta-label">Semester</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $ksm->semester }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Tahun Akademik</span>
                <span class="meta-sep">:</span>
                <span class="meta-val">{{ $ksm->tahunAkademik }}</span>
            </div>
        </div>
    </div>

    <div class="table-wrap">
        <table class="ksm-table">
            <colgroup>
                <col class="col-no">
                <col class="col-kode">
                <col>
                <col class="col-sks">
                <col class="col-kls">
                <col class="col-stat">
                <col class="col-uts">
            </colgroup>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode M.K</th>
                    <th rowspan="2">Nama Mata Kuliah</th>
                    <th rowspan="2">sks</th>
                    <th rowspan="2">Kls</th>
                    <th rowspan="2">Status</th>
                    <th>Paraf Pengawas</th>
                </tr>
                <tr><th>UTS</th></tr>
            </thead>
            <tbody>
                @foreach ($ksm->mataKuliahs as $mk)
                <tr>
                    <td class="td-center">{{ $mk->no }}</td>
                    <td class="td-code">{{ $mk->kodeMatkul }}</td>
                    <td>{{ $mk->namaMatkul }}</td>
                    <td class="td-center">{{ $mk->sks }}</td>
                    <td class="td-center">{{ $mk->kelas }}</td>
                    <td class="td-center"><span class="badge-status">{{ $mk->status }}</span></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="tr-total">
                    <td colspan="3">J U M L A H &nbsp; S K S</td>
                    <td>{{ $ksm->totalSks }}</td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="ksm-footer">
        <div class="ksm-notes">
            <div class="notes-title">&gt;&gt; Catatan &lt;&lt;</div>
            <ol>
                <li>Telitilah Mata Kuliah &amp; Kelas yang tercantum pd KSM ini</li>
                <li>Apabila terdapat kesalahan, kekurangan/kelebihan sks harap lapor ke Biro Adak
                    masing-masing kampus dengan membawa fotocopy KRRS/KSS</li>
                <li>KSM ini berlaku sebagai tanda mengikuti UTS, UAS dan
                    Ujian Skripsi/Tugas Akhir/Tesis/Desertasi</li>
                <li>Informasi Akademik OnLine dapat diakses melalui
                    https://lintar.untar.ac.id</li>
            </ol>
        </div>

        <div class="ksm-photo">Foto<br>3×4</div>

        <div class="ksm-sign">
            <div class="city-date">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div>KETUA LEMBAGA PEMBELAJARAN</div>
            <div class="sign-ttd">TTD</div>
            <div class="sign-name">Dr. Ir. Steven Darmawan, S.T., M.T.</div>
        </div>
    </div>
</div>

<br>
<a href="{{ route('ksm.index') }}" style="color:#2d6a9f; font-size:12px;">← Kembali ke Daftar KSM</a>

</body>
</html>
