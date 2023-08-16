<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
    

<div class="login-card">
    <h2>Login</h2>
    <h3> Masukkan Identitas</h3>

    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
        <a href="#">Lupa Password?</a>
        <a href="utama.html">Daftar</a>
        <button type="submit">Masuk</button>
    </form> 
</div>
</body>
</html>