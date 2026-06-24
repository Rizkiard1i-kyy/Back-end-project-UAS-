<html>
<head>
    <title>Edit KSM</title>
    
</head>
<body>

<div>
    <div>AKADEMIK - EDIT KARTU STUDI MAHASISWA</div>
    <div>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $e)
                    <div>{{ $e }}</div> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('ksm.update', $ksm) }}">
            @csrf
            @method('PUT')

            <h3>Identitas Mahasiswa</h3>
            <div>
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

            <h3>Mata Kuliah</h3>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>sks</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <select name="mataKuliahs[0][kodeMatkul]">
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach ($mataKuliahs as $m)
                                    <option value="{{ $m->id }}" {{ old('mataKuliahs.0.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                        {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="mataKuliahs[0][sks]" value="{{ old('mataKuliahs.0.sks') }}" min="1"></td>
                        <td><input type="text" name="mataKuliahs[0][kelas]" value="{{ old('mataKuliahs.0.kelas') }}"></td>
                        <td>
                        <select name="mataKuliahs[0][status]">
                            <option value="B" {{ old('mataKuliahs.0.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.0.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <select name="mataKuliahs[1][kodeMatkul]">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $m)
                                <option value="{{ $m->id }}" {{ old('mataKuliahs.1.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="mataKuliahs[1][sks]" value="{{ old('mataKuliahs.1.sks') }}" min="1"></td>
                    <td><input type="text" name="mataKuliahs[1][kelas]" value="{{ old('mataKuliahs.1.kelas') }}"></td>
                    <td>
                        <select name="mataKuliahs[1][status]">
                            <option value="B" {{ old('mataKuliahs.1.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.1.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <select name="mataKuliahs[2][kodeMatkul]">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $m)
                                <option value="{{ $m->id }}" {{ old('mataKuliahs.2.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="mataKuliahs[2][sks]" value="{{ old('mataKuliahs.2.sks') }}" min="1"></td>
                    <td><input type="text" name="mataKuliahs[2][kelas]" value="{{ old('mataKuliahs.2.kelas') }}"></td>
                    <td>
                        <select name="mataKuliahs[2][status]">
                            <option value="B" {{ old('mataKuliahs.2.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.2.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        <select name="mataKuliahs[3][kodeMatkul]">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $m)
                                <option value="{{ $m->id }}" {{ old('mataKuliahs.3.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="mataKuliahs[3][sks]" value="{{ old('mataKuliahs.3.sks') }}" min="1"></td>
                    <td><input type="text" name="mataKuliahs[3][kelas]" value="{{ old('mataKuliahs.3.kelas') }}"></td>
                    <td>
                        <select name="mataKuliahs[3][status]">
                            <option value="B" {{ old('mataKuliahs.3.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.3.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        <select name="mataKuliahs[4][kodeMatkul]">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $m)
                                <option value="{{ $m->id }}" {{ old('mataKuliahs.4.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="mataKuliahs[4][sks]" value="{{ old('mataKuliahs.4.sks') }}" min="1"></td>
                    <td><input type="text" name="mataKuliahs[4][kelas]" value="{{ old('mataKuliahs.4.kelas') }}"></td>
                    <td>
                        <select name="mataKuliahs[4][status]">
                            <option value="B" {{ old('mataKuliahs.4.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.4.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>
                        <select name="mataKuliahs[5][kodeMatkul]">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mataKuliahs as $m)
                                <option value="{{ $m->id }}" {{ old('mataKuliahs.5.kodeMatkul') == $m->id ? 'selected' : '' }}>
                                    {{ $m->kodeMatkul }} - {{ $m->namaMatkul }} ({{ $m->sks }} sks)
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="mataKuliahs[5][sks]" value="{{ old('mataKuliahs.5.sks') }}" min="1"></td>
                    <td><input type="text" name="mataKuliahs[5][kelas]" value="{{ old('mataKuliahs.5.kelas') }}"></td>
                    <td>
                        <select name="mataKuliahs[5][status]">
                            <option value="B" {{ old('mataKuliahs.5.status') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="U" {{ old('mataKuliahs.5.status') == 'U' ? 'selected' : '' }}>U</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

            <br>
            <button>Perbarui KSM</button>
            <a href="{{ route('ksm.show', $ksm) }}">Batal</a>
        </form>
    </div>
</div>

</body>
</html>
