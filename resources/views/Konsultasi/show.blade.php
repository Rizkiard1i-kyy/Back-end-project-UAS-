<h1>detail konsultasi</h1>

<p><strong>mahasiswa:</strong> {{ $konsultasi->nama_mahasiswa }} ({{ $konsultasi->nim }})</p>
<p><strong>dosen:</strong> {{ $konsultasi->nama_dosen }}</p>
<p><strong>tanggal:</strong> {{ $konsultasi->tanggal->format('d/m/Y') }}</p>
<p><strong>jam:</strong> {{ $konsultasi->jam }}</p>
<p><strong>topik:</strong><br>{{ $konsultasi->topik }}</p>
<p><strong>status:</strong> {{ ucfirst($konsultasi->status) }}</p>
<p><strong>catatan:</strong> 
    @if($konsultasi->catatan)
        {{ $konsultasi->catatan }}
    @else
        -
    @endif
</p>

@if(auth()->user()->isAdmin() && $konsultasi->status === 'menunggu')
<br>
<form method="POST" action="{{ route('konsultasi.update', $konsultasi) }}">
    @csrf 
    @method('PUT')

    <label>keputusan</label>
    <br>
    <select name="status" required>
        <option>setujui</option>
        <option>tolak</option>
    </select>
    <br><br>

    <label>catatan (opsional aja)</label><br>
    <br><br>

    <button>simpan keputusan</button>
</form>
@endif

<br>
<a href="{{ route('konsultasi.index') }}">kembali</a>