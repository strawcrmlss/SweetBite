@extends('admin.layouts.app')

@section('content')

<h1 style="text-align:center; margin-bottom:30px;">
    Profil Admin
</h1>

<div
    style="
        display:flex;
        justify-content:center;
    "
>

    <div
        class="card"
        style="
            width:100%;
            max-width:650px;
            padding:40px;
        "
    >

        <div style="text-align:center;">

            <img
                src="{{ asset('images/logoadmin.png') }}"
                width="150"
                style="
                    border-radius:50%;
                    margin-bottom:20px;
                    border:5px solid #F7D7E9;
                "
            >

            <h2 style="margin-bottom:8px;">
                {{ auth()->user()->name }}
            </h2>

            <p style="color:#777;">
                {{ auth()->user()->email }}
            </p>

            <p
                style="
                    color:#CC6FA5;
                    font-weight:600;
                    margin-top:8px;
                "
            >
                Administrator SweetBite
            </p>

        </div>

        <br><br>

        <div
            style="
                display:flex;
                justify-content:center;
                gap:15px;
            "
        >

            <a
                href="/admin/profile/edit"
                class="btn"
            >
                Edit Akun
            </a>

            <form
                action="/admin/profile/delete"
                method="POST"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Yakin ingin menghapus akun?')"
                    style="
                        background:#E74C3C;
                    "
                >
                    Hapus Akun
                </button>

            </form>

        </div>

    </div>

</div>

@endsection