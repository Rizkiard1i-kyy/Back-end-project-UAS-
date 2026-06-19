<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<div class="container">
    
    <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
        <h1>Edit Status Surat</h1>
    </div>
 <div class="form-card">
        <form action="{{ route('surat_permohonan.update', $suratPermohonan->no) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Jenis Surat Pengajuan</label>
                <input type="text" class="form-control" value="{{ $suratPermohonan->jenis_surat }}" style="background-color: #f8fafc; color: #64748b;" readonly>
            </div>
            <div class="form-group" style="margin-bottom: 28px;">
                <label>NIM Pengaju</label>
                <input type="text" class="form-control" value="{{ $suratPermohonan->nim }}" style="background-color: #f8fafc; color: #64748b;" readonly>
            </div>
            <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 24px 0;">
            <div class="form-group">
                <label>Status Surat</label>
                <div class="radio-list">
                    

                    <div class="radio-option">
                        <input type="radio" name="status" id="status_pending" value="pending"
                            {{ $suratPermohonan->status == 'pending' ? 'checked' : '' }}>
                        <label for="status_pending" style="color: #f1c431;">Pending</label>
                    </div>

                    <div class="radio-option">
                        <input type="radio" name="status" id="status_accepted" value="accepted"
                            {{ $suratPermohonan->status == 'accepted' ? 'checked' : '' }}>
                        <label for="status_accepted" style="color: #065f46;">Accepted</label>
                    </div>

                    <div class="radio-option">
                        <input type="radio" name="status" id="status_decline" value="decline"
                            {{ $suratPermohonan->status == 'decline' ? 'checked' : '' }}>
                        <label for="status_decline" style="color: #991b1b;">Decline</label>
                    </div>
                    
                </div>
            </div>

            <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 32px;">
                <a href="{{ route('surat_permohonan.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary btn-submit">Update Status</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>