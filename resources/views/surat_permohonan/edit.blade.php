<h1>Edit Status Surat</h1>

<form action="{{ route('surat_permohonan.update', $suratPermohonan->no) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Status Surat</label><br><br>

    <input type="radio" name="status" value="pending"
        {{ $suratPermohonan->status == 'pending' ? 'checked' : '' }}>
    Pending <br>

    <input type="radio" name="status" value="accepted"
        {{ $suratPermohonan->status == 'accepted' ? 'checked' : '' }}>
    Accepted <br>

    <input type="radio" name="status" value="decline"
        {{ $suratPermohonan->status == 'decline' ? 'checked' : '' }}>
    Decline <br><br>

    <button type="submit">Update Status</button>
</form>