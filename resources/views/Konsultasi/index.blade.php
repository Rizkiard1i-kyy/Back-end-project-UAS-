<h1>Konsultasi Akademik</h1>

@if(!auth()->user()->isAdmin())
    <a href="{{ route('konsultasi.create') }}">ajukan Konsultasi</a>
    <br><br>
@endif

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if($konsultasi->isEmpty())
    <p>kaga ada data konsultasi.</p>
@else
<table>
    <thead>
        <tr>
            <th>no</th>
            @if(auth()->user()->isAdmin()) <th>Mahasiswa</th> @endif
            <th>dosen</th>
            <th>tanggal</th>
            <th>jam</th>
            <th>topik</th>
            <th>status</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($konsultasi as $k)
        <tr>
            <td>{{ $loop->iteration }}</td>
            @if(auth()->user()->isAdmin()) <td>{{ $k->nama_mahasiswa }} ({{ $k->nim }})</td> @endif
            <td>{{$k->nama_dosen }}</td>
            <td>{{$k->tanggal->format('d/m/Y') }}</td>
            <td>{{$k->jam }}</td>
            <td>{{Str::limit($k->topik, 50) }}</td>
            <td>{{ucfirst($k->status) }}</td>
            <td><a href="{{ route('konsultasi.show', $k) }}">detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br>
<a href="/dashboard">kembali ke Ddashboard</a>