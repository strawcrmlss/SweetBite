@extends('admin.layouts.app')

@section('content')

<div
style="
max-width:700px;
margin:auto;
background:white;
padding:35px;
border-radius:16px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
text-align:center;
"
>

    <h1
    style="
    margin-bottom:5px;
    font-size:36px;
    font-weight:bold;
    ">
        Pembayaran QRIS
    </h1>

    <p
    style="
    color:#777;
    margin-bottom:20px;
    ">
        SweetBite Indonesia
    </p>

    <hr>

    <div
    style="
    margin-top:25px;
    margin-bottom:25px;
    ">
    
        <div style="margin-bottom:15px;">

            <div
            style="
            color:#777;
            font-size:14px;
            ">
                Nomor Pesanan
            </div>

            <div
            style="
            font-size:20px;
            font-weight:bold;
            ">
                {{ $order->order_code }}
            </div>

        </div>

        <div style="margin-bottom:15px;">

            <div
            style="
            color:#777;
            font-size:14px;
            ">
                Metode Pembayaran
            </div>

            <div
            style="
            font-size:20px;
            font-weight:bold;
            ">
                QRIS
            </div>

        </div>

        <div>

            <div
            style="
            color:#777;
            font-size:14px;
            margin-bottom:8px;
            ">
                Status Pembayaran
            </div>

            <span
            style="
            background:#FFF3CD;
            color:#856404;
            padding:8px 18px;
            border-radius:20px;
            font-size:14px;
            font-weight:bold;
            ">
                Menunggu Pembayaran
            </span>

        </div>

    </div>

    <h3
    style="
    color:#666;
    margin-bottom:5px;
    ">
        Total Pembayaran
    </h3>

    <h1
    style="
    color:#CC6FA5;
    font-size:42px;
    margin-top:0;
    margin-bottom:25px;
    ">
        Rp{{ number_format($order->total_price,0,',','.') }}
    </h1>

    <img
    src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=SWEETBITE-{{ $order->order_code }}"
    style="
    margin-bottom:25px;
    "
    >

    <div
    style="
    background:#f8f9fa;
    padding:20px;
    border-radius:12px;
    text-align:left;
    margin-bottom:20px;
    "
    >

        <h4
        style="
        margin-top:0;
        margin-bottom:15px;
        ">
            Cara Pembayaran
        </h4>

        <ol
        style="
        line-height:1.8;
        padding-left:20px;
        margin:0;
        ">
            <li>Buka aplikasi e-wallet atau mobile banking.</li>
            <li>Pilih menu Scan QRIS.</li>
            <li>Scan kode QR yang tersedia.</li>
            <li>Pastikan nominal pembayaran sesuai.</li>
            <li>Selesaikan transaksi.</li>
            <li>Klik tombol verifikasi pembayaran.</li>
        </ol>

    </div>

    <p
    style="
    color:#777;
    margin-bottom:20px;
    ">
        Mendukung pembayaran melalui:<br>
        DANA • OVO • GoPay • ShopeePay • Mobile Banking
    </p>

    <form
    method="POST"
    action="/admin/pos/qris/{{ $order->id }}/paid"
    >

        @csrf

        <button
        type="submit"
        style="
        background:#CC6FA5;
        color:white;
        border:none;
        padding:14px 28px;
        border-radius:10px;
        font-size:16px;
        font-weight:bold;
        cursor:pointer;
        ">
            Verifikasi Pembayaran
        </button>

    </form>

</div>

@endsection