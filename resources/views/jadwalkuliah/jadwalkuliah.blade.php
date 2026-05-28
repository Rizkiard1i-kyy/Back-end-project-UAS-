<tbody>
        @foreach($jadwals as $jadwal)
        <tr>
            <td>{{ $loop->iteration }}</td> 
            <td>{{ $jadwal->kodeMK }}</td>
            <td>{{ $jadwal->namaMK }}</td>
            <td>{{ $jadwal->sks }}</td>
            <td>{{ $jadwal->kelas }}</td>
            <td>{{ $jadwal->dosenPengajar }}</td>
            <td>{{ $jadwal->ruangDanWaktu }}</td>
            
            @if(auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'dosen'))
            <td>
                <a href="#">Edit</a> | <a href="#">Hapus</a>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>