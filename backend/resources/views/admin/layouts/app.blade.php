<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sweet Bite Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    display:flex;
    min-height:100vh;
    background:#FFF8FC;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:280px;
    background:linear-gradient(180deg,#CC6FA5,#D98AB8);
    padding:30px 25px;
    display:flex;
    flex-direction:column;
    box-shadow:5px 0 20px rgba(204,111,165,.18);
}

.logo-area{
    text-align:center;
    margin-bottom:40px;
}

.logo{
    width:150px;
    height:auto;
    margin-bottom:15px; /* <-- Ubah angka ini */
}

.logo-area h2{
    font-family:'Cormorant Garamond', serif;
    font-size:44px;
    font-weight:700;
    color:#fff;
    line-height:.95;
    letter-spacing:0;
    margin:0;          /* penting */
}

.logo-area h2 span{
    display:block;
    font-size:44px;
    font-weight:700;
    letter-spacing:0;
    text-transform:none;
    margin-top:-4px;   /* bikin Sweet dan Bite makin rapat */
}

.sidebar a{
    display:flex;
    align-items:center;
    text-decoration:none;
    color:white;
    padding:16px 20px;
    border-radius:14px;
    margin-bottom:8px;
    font-size:20px;
    font-weight:500;
    transition:.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,.18);
}

.sidebar a.active{
    background:white;
    color:#CC6FA5;
    font-weight:700;
    box-shadow:0 6px 18px rgba(0,0,0,.12);
}

/* ================= CONTENT ================= */

.content{
    flex:1;
    padding:30px 35px;
    background:#FFF8FC;
}

/* ================= TOPBAR ================= */

.topbar{
    background:white;
    border-radius:24px;
    padding:25px 35px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    box-shadow:0 8px 20px rgba(204,111,165,.12);
}

.welcome h2{
    font-size:40px;
    color:#4B3B46;
    font-weight:700;
}

.welcome p{
    color:#9C6D89;
    font-size:18px;
    margin-top:5px;
}

.admin-profile{
    display:flex;
    align-items:center;
    gap:15px;
    text-decoration:none;
    color:#4B3B46;
}

.profile-info{
    text-align:right;
}

.profile-info h4{
    font-size:24px;
    font-weight:700;
    color:#4B3B46;
}

.profile-info p{
    color:#9C6D89;
    font-size:15px;
}

.profile-pic{
    width:65px;
    height:65px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #F4D7E8;
}

/* ================= CARD ================= */

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 6px 18px rgba(204,111,165,.12);
}

/* ================= TABLE ================= */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(204,111,165,.12);
}

table th{
    background:#CC6FA5;
    color:white;
    padding:18px;
    font-size:16px;
}

table td{
    padding:18px;
    border-bottom:1px solid #F2E5ED;
}

table tr:hover{
    background:#FFF3F9;
}

/* ================= FORM ================= */

input,
textarea,
select{
    width:100%;
    padding:12px;
    border:1px solid #E7C8D9;
    border-radius:12px;
}

input:focus,
textarea:focus,
select:focus{
    outline:none;
    border-color:#CC6FA5;
    box-shadow:0 0 0 4px rgba(204,111,165,.15);
}

/* ================= BUTTON ================= */

button,
.btn{
    background:#CC6FA5;
    color:white;
    border:none;
    padding:12px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

button:hover,
.btn:hover{
    background:#B85D93;
}

/* ================= TITLE ================= */

h1{
    color:#4B3B46;
    font-size:52px;
    margin-bottom:20px;
}
</style>

</head>
<body>

<div class="sidebar">

<div class="logo-area">

    <img
        src="{{ asset('images/sweetbite.png') }}"
        class="logo"
    >

    <h2>Sweet Bite</h2>

</div>

    <a href="/admin" class="active">
        Dashboard
    </a>

    <a href="/admin/products">
        Kelola Menu
    </a>

    <a href="/admin/categories">
        Kategori
    </a>

    <a href="/admin/orders">
        Pesanan
    </a>

    <a href="/admin/pos">
        Point Of Sale
    </a>

    <a href="/admin/promotions">
        Promo
    </a>

    <a href="/admin/reports">
        Laporan
    </a>

</div>

<div class="content">

    <div class="topbar">

        <div class="welcome">

            <h2>Selamat Datang, Admin</h2>

            <p> Kelola produk, pesanan, promo, dan laporan penjualan SweetBite secara mudah dalam satu dashboard.</p>

        </div>

        <a
            href="/admin/profile"
            class="admin-profile"
        >

            <div class="profile-info">

                <h4>Admin SweetBite</h4>

                <p>Administrator</p>

            </div>

            <img
                src="{{ asset('images/logoadmin.png') }}"
                class="profile-pic"
            >

        </a>

    </div>

    @yield('content')

</div>

</body>
</html>

