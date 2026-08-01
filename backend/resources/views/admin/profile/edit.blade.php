@extends('admin.layouts.app')

@section('content')

<h1 style="text-align:center; margin-bottom:30px;">
    Edit Profil Admin
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
            max-width:700px;
            padding:40px;
        "
    >

        <div style="text-align:center;margin-bottom:35px;">

            <img
                src="{{ asset('images/logoadmin.png') }}"
                width="130"
                style="
                    border-radius:50%;
                    border:5px solid #F7D7E9;
                    margin-bottom:15px;
                "
            >

            <h2 style="color:#4B3B46;">
                Edit Profil
            </h2>

            <p style="color:#9C6D89;">
                Perbarui informasi akun Administrator SweetBite
            </p>

        </div>

        <form action="/admin/profile/update" method="POST">

            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">

                <label
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    required
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #E6C7D8;
                        border-radius:12px;
                    "
                >

            </div>

            <div style="margin-bottom:30px;">

                <label
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ auth()->user()->email }}"
                    required
                    style="
                        width:100%;
                        padding:14px;
                        border:1px solid #E6C7D8;
                        border-radius:12px;
                    "
                >

            </div>

            <div
                style="
                    display:flex;
                    justify-content:center;
                    gap:15px;
                "
            >

                <button
                    type="submit"
                    style="
                        background:#CC6FA5;
                        padding:12px 30px;
                        border:none;
                        border-radius:12px;
                        color:white;
                        font-weight:600;
                        cursor:pointer;
                    "
                >
                    Simpan Perubahan
                </button>

                <a
                    href="/admin/profile"
                    class="btn"
                    style="
                        background:#E5E7EB;
                        color:#444;
                    "
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection