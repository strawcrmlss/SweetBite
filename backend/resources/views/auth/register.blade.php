<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SweetBite</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Poppins',sans-serif;
    }

    body{
        background:#FFF8FC;
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .register-card{
        width:550px;
        background:#fff;
        padding:45px;
        border-radius:25px;
        box-shadow:0 15px 35px rgba(204,111,165,.15);
    }

    .logo{
        display:flex;
        justify-content:center;
        margin-bottom:15px;
    }

    .logo img{
        width:130px;
    }

    .title{
        text-align:center;
        font-size:36px;
        font-weight:700;
        color:#4B3B46;
        margin-bottom:10px;
    }

    .subtitle{
        text-align:center;
        color:#9C6D89;
        margin-bottom:35px;
    }

    .input-group{
        margin-bottom:18px;
    }

    .input-group label{
        display:block;
        margin-bottom:8px;
        font-weight:600;
        color:#4B3B46;
    }

    .input-group input{
        width:100%;
        padding:14px;
        border:1px solid #E6C7D8;
        border-radius:12px;
        font-size:15px;
    }

    .input-group input:focus{
        outline:none;
        border-color:#CC6FA5;
        box-shadow:0 0 0 4px rgba(204,111,165,.15);
    }

    .error{
        color:#dc2626;
        font-size:13px;
        margin-top:5px;
    }

    .register-btn{
        width:100%;
        background:#CC6FA5;
        color:white;
        border:none;
        padding:15px;
        border-radius:12px;
        font-size:16px;
        font-weight:600;
        cursor:pointer;
        transition:.3s;
        margin-top:10px;
    }

    .register-btn:hover{
        background:#B85D93;
    }

    .bottom-text{
        text-align:center;
        margin-top:25px;
        color:#777;
    }

    .bottom-text a{
        color:#CC6FA5;
        font-weight:600;
        text-decoration:none;
    }

    .bottom-text a:hover{
        text-decoration:underline;
    }

    </style>

</head>
<body>

<div class="register-card">

    <div class="logo">
        <img src="{{ asset('images/sweetbite.png') }}" alt="SweetBite">
    </div>

    <div class="title">
        Register
    </div>

    <div class="subtitle">
        Buat akun administrator SweetBite
    </div>

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <div class="input-group">

            <label>Nama Lengkap</label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <div class="input-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <div class="input-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                required
            >

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <div class="input-group">

            <label>Konfirmasi Password</label>

            <input
                type="password"
                name="password_confirmation"
                required
            >

            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <button
            type="submit"
            class="register-btn"
        >
            Register
        </button>

    </form>

    <div class="bottom-text">

        Sudah memiliki akun?

        <a href="{{ route('login') }}">
            Login
        </a>

    </div>

</div>

</body>
</html>