<h1>Daftar Rencana Pembelajaran Semester (RPS)</h1>

@if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if(!auth()->user()->isMahasiswa())
    <a href="{{ route('rps.create') }}">Tambah RPS Baru</a>
    <br><br>
@endif

@if ($semua_rps->isEmpty())
    <p>Belum ada data RPS yang tersimpan.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>File RPS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semua_rps as $rps)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td> 
                <td>Fakultas Teknologi Informasi</td>
                <td>TEKNIK INFORMATIKA</td>
                <td>{{ $rps->kode_mk }} | {{ $rps->nama_mk }}</td>
                <td style="text-align: center">{{ $rps->sks }}</td>
                <td style="text-align: center">
                    <a href="{{ $rps->file_rps }}" target="_blank">Lihat PDF</a>
                </td>
                <td style="text-align: center">
                    @if(!auth()->user()->isMahasiswa())
                        <a href="{{ route('rps.edit', $rps->id) }}">Edit</a> | 
                        <form action="{{ route('rps.destroy', $rps->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus RPS ini?')">Hapus</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>