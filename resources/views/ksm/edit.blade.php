<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit KSM</title>
    
</head>
<body>

<div class="card">
    <div class="card-header">AKADEMIK - EDIT KARTU STUDI MAHASISWA</div>
    <div class="card-body">

        @if ($errors->any())
            <ul class="error" style="margin-bottom:12px; padding-left:16px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('ksm.update', $ksm) }}">
            @csrf
            @method('PUT')

            {{-- ── Identitas Mahasiswa ── --}}
            <h3>Identitas Mahasiswa</h3>
            <div class="grid-2">
                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $ksm->nama) }}" required>

                    <label>No. Pokok Mahasiswa (NIM)</label>
                    <input type="text" name="nim" value="{{ old('nim', $ksm->nim) }}" required>

                    <label>Program Studi</label>
                    <input type="text" name="prodi" value="{{ old('prodi', $ksm->prodi) }}" required>
                </div>
                <div>
                    <label>Semester</label>
                    <select name="semester" required>
                        <option value="Genap"  {{ old('semester', $ksm->semester) === 'Genap'  ? 'selected' : '' }}>Genap</option>
                        <option value="Ganjil" {{ old('semester', $ksm->semester) === 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    </select>

                    <label>Tahun Akademik</label>
                    <input type="text" name="tahunAkademik" value="{{ old('tahunAkademik', $ksm->tahunAkademik) }}" required>
                </div>
            </div>

            {{-- ── Mata Kuliah ── --}}
            <h3>Mata Kuliah</h3>

            <table class="mk-table">
                <thead>
                    <tr>
                        <th style="width:36px">No</th>
                        <th style="width:90px">Kode M.K</th>
                        <th>Nama Mata Kuliah</th>
                        <th style="width:46px">sks</th>
                        <th style="width:50px">Kelas</th>
                        <th style="width:60px">Status</th>
                        <th style="width:50px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mk-tbody">
                    @php $mks = old('mataKuliahs') ? collect(old('mataKuliahs')) : $ksm->mataKuliahs; @endphp
                    @foreach ($mks as $i => $mk)
                    @php
                        $kode   = is_array($mk) ? ($mk['kodeMatkul'] ?? '') : $mk->kodeMatkul;
                        $nama   = is_array($mk) ? ($mk['namaMatkul']  ?? '') : $mk->namaMatkul;
                        $sks    = is_array($mk) ? ($mk['sks']         ?? '') : $mk->sks;
                        $kelas  = is_array($mk) ? ($mk['kelas']       ?? '') : $mk->kelas;
                        $status = is_array($mk) ? ($mk['status']      ?? 'B') : $mk->status;
                    @endphp
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td><input type="text"   name="mataKuliahs[{{ $i }}][kodeMatkul]" value="{{ $kode }}"  required></td>
                        <td><input type="text"   name="mataKuliahs[{{ $i }}][namaMatkul]" value="{{ $nama }}"  required></td>
                        <td><input type="number" name="mataKuliahs[{{ $i }}][sks]"        value="{{ $sks }}"   min="1" required></td>
                        <td><input type="text"   name="mataKuliahs[{{ $i }}][kelas]"      value="{{ $kelas }}" required></td>
                        <td>
                            <select name="mataKuliahs[{{ $i }}][status]" required>
                                <option value="B" {{ $status === 'B' ? 'selected' : '' }}>B</option>
                                <option value="U" {{ $status === 'U' ? 'selected' : '' }}>U</option>
                            </select>
                        </td>
                        <td style="text-align:center"><button type="button" class="btn-del" onclick="removeRow(this)">Hapus</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="button" class="btn-add" onclick="addRow()">+ Tambah Mata Kuliah</button>

            <br>
            <button type="submit" class="btn-submit">Perbarui KSM</button>
            &nbsp;
            <a href="{{ route('ksm.show', $ksm) }}" style="font-size:12px; color:#2d6a9f;">Batal</a>
        </form>
    </div>
</div>

<script>
let rowCount = document.getElementById('mk-tbody').rows.length;

function addRow() {
    const tbody = document.getElementById('mk-tbody');
    const i     = rowCount++;
    const no    = tbody.rows.length + 1;

    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td style="text-align:center">${no}</td>
        <td><input type="text"   name="mataKuliahs[${i}][kodeMatkul]" required></td>
        <td><input type="text"   name="mataKuliahs[${i}][namaMatkul]" required></td>
        <td><input type="number" name="mataKuliahs[${i}][sks]" min="1" required></td>
        <td><input type="text"   name="mataKuliahs[${i}][kelas]" required></td>
        <td>
            <select name="mataKuliahs[${i}][status]" required>
                <option value="B">B</option>
                <option value="U">U</option>
            </select>
        </td>
        <td style="text-align:center"><button type="button" class="btn-del" onclick="removeRow(this)">Hapus</button></td>
    `;
    tbody.appendChild(tr);
    renumberRows();
}

function removeRow(btn) {
    const tbody = document.getElementById('mk-tbody');
    if (tbody.rows.length <= 1) return;
    btn.closest('tr').remove();
    renumberRows();
}

function renumberRows() {
    document.querySelectorAll('#mk-tbody tr').forEach((tr, idx) => {
        tr.cells[0].textContent = idx + 1;
    });
}
</script>
</body>
</html>
