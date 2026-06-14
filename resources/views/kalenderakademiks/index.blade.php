<h1>Kalender Akademik</h1>

@if(auth()->user()->isAdmin())
    <a href="{{ route('kalenderAkademik.create') }}">Buat Data Kalender Akademik Baru</a>
    <br><br>
@endif

@if ($kalenderAkademik->isEmpty())
    <p>Belum ada data kalender akademik yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 200px">Tanggal</th>            
            <th style="width: 400px">Keterangan</th>
            @if(auth()->user()->isAdmin())
                <th style="width: 120px">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($kalenderAkademik as $kalenderAkademik)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $kalenderAkademik->tanggalMulai->format('d M Y') }} s/d {{ $kalenderAkademik->tanggalSelesai->format('d M Y') }}</a>
                </td>
                <td>
                    <a> {{ $kalenderAkademik->namaKegiatan }}</a>
                </td>
                @if(auth()->user()->isAdmin())
                <td style="text-align: center">
                    <a href="{{ route('kalenderAkademik.edit', $kalenderAkademik) }}">Ubah</a>
                    <form action="{{ route('kalenderAkademik.destroy', $kalenderAkademik->id) }}" method="POST"
                        onsubmit="return confirm('Hapus data kalender ini?')">
                        @csrf @method('DELETE')
                        <button>Hapus Data</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>