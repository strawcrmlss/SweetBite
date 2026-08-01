@extends('admin.layouts.app')

@section('content')

<style>

.profile-card{
    background:white;
    border-radius:20px;
    padding:40px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    margin-bottom:25px;
}

.profile-header{
    text-align:center;
}

.profile-avatar{
    width:140px;
    height:140px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:20px;
    border:5px solid #fff3e8;
}

.profile-name{
    font-size:32px;
    font-weight:700;
    margin-bottom:10px;
}

.profile-email{
    color:#666;
    margin-bottom:10px;
}

.role-badge{
    display:inline-block;
    background:#fff3e8;
    color:#CC6FA5;
    padding:8px 18px;
    border-radius:30px;
    font-weight:600;
}

.profile-actions{
    margin-top:30px;
    display:flex;
    justify-content:center;
    gap:15px;
}

.btn-edit{
    background:#CC6FA5;
    color:white;
    text-decoration:none;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
}

.btn-edit:hover{
    background:#e86f00;
}

.btn-delete{
    background:#ef4444;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.info-box{
    background:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 3px 10px rgba(0,0,0,.08);
}

.info-box h4{
    color:#777;
    margin-bottom:10px;
    font-size:14px;
}

.info-box p{
    font-size:18px;
    font-weight:600;
}

</style>

<h1 style="margin-bottom:25px;">
    Profil Admin
</h1>

<div class="profile-card">

    <div class="profile-header">

        <img
            src="{{ asset('images/logoadmin.png') }}"
            class="profile-avatar"
        >

        <div class="profile-name">
            {{ Auth::user()->name }}
        </div>

        <div class="profile-email">
            {{ Auth::user()->email }}
        </div>

        <span class="role-badge">
            Administrator SweetBite
        </span>

    </div>

    <div class="profile-actions">

        <a
            href="/admin/profile/edit"
            class="btn-edit"
        >
            Edit Profil
        </a>

        <form
            action="/admin/profile/delete"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus akun admin?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn-delete"
            >
                Hapus Akun
            </button>

        </form>

    </div>

</div>

<div class="info-grid">

    <div class="info-box">
        <h4>Role</h4>
        <p>Administrator</p>
    </div>

    <div class="info-box">
        <h4>Status</h4>
        <p>Aktif</p>
    </div>

    <div class="info-box">
        <h4>Sistem</h4>
        <p>SweetBite Admin</p>
    </div>

</div>

@endsection