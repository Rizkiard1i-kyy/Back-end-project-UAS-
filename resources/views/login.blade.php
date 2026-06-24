<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Universitas Tarumanagara</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="untar-body">

<div class="untar-container">
        
        <header class="untar-header">
            <h2 class="subtitle">SIGN ON</h2>
            <h1 class="title">UNIVERSITAS TARUMANAGARA</h1>
        </header>

        <div class="untar-banner">
            <div class="untar-banner-overlay"></div>
            
            <div class="untar-card">
                
                @if ($errors->any())
                    <div class="untar-alert-error" style="margin-bottom: 1.5rem;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form id="formLogin" class="untar-form" method="POST" action="/login">
                    @csrf
                    
                    <div class="untar-input-group">
                        <label>Masukan Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="contoh@stu.untar.ac.id"
                            required
                        >
                    </div>

                    <div class="untar-input-group">
                        <label>Masukan password</label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </form>
            </div>
        </div>

        <footer class="untar-footer">
            <button type="submit" form="formLogin" class="untar-btn-login">
                LOGIN
            </button>

            <div class="untar-demo-info">
                <br>Akun Demo: admin@untar.ac.id dengan password 12345678<br>
                <br>Akun akun dosen dan mahasiswa yang terdaftar bisa dilihat di panel management pengguna<br>
            </div>
        </footer>

    </div>
</body>
</html>