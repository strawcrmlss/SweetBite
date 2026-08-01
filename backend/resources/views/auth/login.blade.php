<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SweetBite</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#FFF8FC;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;
        }

        .container{
            width:95%;
            height:92vh;
            display:flex;
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,.08);
        }

        /* ================= LEFT ================= */

        .left{
            width:50%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .left img{
            width:430px;
            max-width:80%;
        }

        /* ================= RIGHT ================= */

        .right{
            width:50%;
            background:#FDF2F8;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:430px;
        }

        h1{
            font-size:56px;
            font-weight:700;
            color:#2F2435;
            margin-bottom:10px;
            text-align:center;
        }

        .subtitle{
            text-align:center;
            color:#777;
            margin-bottom:40px;
            font-size:16px;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group input{
            width:100%;
            height:55px;
            border:1px solid #E8D8E2;
            border-radius:12px;
            padding:0 18px;
            font-size:15px;
            background:white;
            transition:.3s;
        }

        .input-group input:focus{
            outline:none;
            border-color:#C97BA5;
            box-shadow:0 0 10px rgba(201,123,165,.15);
        }

        .password-wrapper{
            position:relative;
        }

        .password-wrapper input{
            padding-right:50px;
        }

        .password-toggle{
            position:absolute;
            right:18px;
            top:50%;
            transform:translateY(-50%);
            cursor:pointer;
            color:#888;
            font-size:18px;
        }

        .forgot{
            display:block;
            text-align:right;
            margin-bottom:25px;
            color:#777;
            text-decoration:none;
            font-size:14px;
        }

        .forgot:hover{
            color:#C97BA5;
        }

        .login-btn{
            width:100%;
            height:55px;
            border:none;
            border-radius:12px;
            background:#C97BA5;
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:.3s;
        }

        .login-btn:hover{
            background:#B96A98;
        }

        .register{
            margin-top:35px;
            text-align:center;
            color:#555;
            font-size:15px;
        }

        .register a{
            color:#C97BA5;
            text-decoration:none;
            font-weight:600;
        }

        .register a:hover{
            color:#B96A98;
        }

        .error{
            background:#FFE8EC;
            color:#B42342;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
            font-size:14px;
        }

        @media(max-width:900px){

            .container{
                flex-direction:column;
                height:auto;
            }

            .left{
                display:none;
            }

            .right{
                width:100%;
                padding:50px 25px;
            }

            .login-box{
                width:100%;
                max-width:430px;
            }

        }

    </style>

</head>
<body>

<div class="container">

    <div class="left">

        <img src="{{ asset('images/sweetbite.png') }}" alt="SweetBite">

    </div>

    <div class="right">

        <div class="login-box">

            <h1>Login</h1>

            <div class="subtitle">
                Masuk untuk melanjutkan
            </div>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                    >

                </div>

                <div class="input-group">

                    <div class="password-wrapper">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                        >

                        <span
                            class="password-toggle"
                            onclick="togglePassword()"
                        >
                            👁
                        </span>

                    </div>

                </div>

                <a href="{{ route('password.request') }}" class="forgot">
                    Lupa Password?
                </a>

                <button type="submit" class="login-btn">
                    Login
                </button>

            </form>

            @if (Route::has('register'))
            <div class="register">
                Belum punya akun?
                <a href="{{ route('register') }}">
                    Daftar
                </a>
            </div>
            @endif

        </div>

    </div>

</div>

<script>

function togglePassword(){

    const password=document.getElementById('password');

    if(password.type==="password"){
        password.type="text";
    }else{
        password.type="password";
    }

}

</script>

</body>
</html>