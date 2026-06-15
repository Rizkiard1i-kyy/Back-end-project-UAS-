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

@if(auth()->user()->isDosen()&& $konsultasi->dosen_id === auth()->id()&& $konsultasi->status === 'menunggu')
<br>
<form method="POST" action="{{ route('konsultasi.update', $konsultasi) }}">
    @csrf 
    @method('PUT')

    <label>keputusan</label>
    <br>
    <select name="status" required>
    <option value="disetujui">setujui</option>
    <option value="ditolak">tolak</option>
    </select>
    <br><br>

    <label>catatan (opsional aja)</label><br>
    <textarea name="catatan"></textarea>
    <br><br>

    <button>simpan keputusan</button>
</form>
@endif

<br>
<a href="{{ route('konsultasi.index') }}">kembali</a>