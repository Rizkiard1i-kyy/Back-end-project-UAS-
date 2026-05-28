<h1>Edit Status Surat</h1>

<form action="{{ route('surat_keterangan.update', $suratKeterangan->no) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Status Surat</label><br><br>

    <input type="radio" name="status" value="pending"
        {{ $suratKeterangan->status == 'pending' ? 'checked' : '' }}>
    Pending <br>

    <input type="radio" name="status" value="accepted"
        {{ $suratKeterangan->status == 'accepted' ? 'checked' : '' }}>
    Accepted <br>

    <input type="radio" name="status" value="decline"
        {{ $suratKeterangan->status == 'decline' ? 'checked' : '' }}>
    Decline <br><br>

    <button type="submit">Update Status</button>
</form>