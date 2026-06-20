<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Halo! Selamat datang {{ auth()->user()->nama ?? 'User' }} di Lintar X!</h1>
    </div>
</header>

<div class="container">
    
    <div class="page-header" style="max-width: 600px; margin: 0 auto 32px auto;">
        <h1>Ajukan Konsultasi</h1>
    </div>

@if($errors->any())
    <p>{{ $errors->first() }}</p>
@endif
    <div class="form-card">
        <form method="POST" action="{{ route('konsultasi.store') }}" >
        @csrf
            <div class="form-group">
                <label>dosen</label>
                <select name="dosen_id" required class="form-control">
                    <option value="">pilih dosen </option>

                    @foreach($dosenList as $dosen)
                    <option value="{{ $dosen->id }}">
                        {{ $dosen->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label>tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control" required>

            <label>jam (contoh = 10:40 - 13:30)</label>
            <input type="text" name="jam" value="{{ old('jam') }}" class="form-control" required>
    
            <label>topik konsultasi</label>
            <input type="text" name="topik" value="{{ old('topik') }}" class="form-control" required>
        </div>
        <div class="form-actions">
                <a href="{{ route('konsultasi.index') }}" class="btn-secondary">kembali</a>
                <button type="submit" class="btn-primary btn-submit">kirim</button>
            </div>
        </form>
</div>

</div>

</body>
</html>