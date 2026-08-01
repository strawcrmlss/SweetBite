<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Laporan SweetBite</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:12px;
            color:#333;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header img{
            width:70px;
            margin-bottom:10px;
        }

        .header h1{
            margin:0;
            color:#CC6FA5;
        }

        .header p{
            margin:5px 0;
            color:#666;
        }

        .summary{
            margin:20px 0;
            padding:10px;
            background:#f5f5f5;
            border:1px solid #ddd;
        }

        .summary p{
            margin:5px 0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        th{
            background:#CC6FA5;
            color:white;
            padding:10px;
            border:1px solid #ddd;
        }

        td{
            padding:8px;
            border:1px solid #ddd;
        }

        .footer{
            margin-top:30px;
            text-align:right;
            color:#666;
            font-size:11px;
        }

    </style>

</head>
<body>

<div class="header">

    <h1>LAPORAN PENJUALAN SWEETBITE</h1>

    @if(isset($startDate) && isset($endDate) && $startDate && $endDate)

        <p>
            Periode :
            {{ date('d-m-Y', strtotime($startDate)) }}
            s/d
            {{ date('d-m-Y', strtotime($endDate)) }}
        </p>

    @else

        <p>Semua Data Transaksi</p>

    @endif

</div>

<div class="summary">

    <p>
        <strong>Total Pesanan :</strong>
        {{ $totalOrders }}
    </p>

    <p>
        <strong>Pesanan Selesai :</strong>
        {{ $completedOrders }}
    </p>

    <p>
        <strong>Total Pendapatan :</strong>
        Rp {{ number_format($totalRevenue,0,',','.') }}
    </p>

</div>

<table>

    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kode Pesanan</th>
        <th>Total</th>
        <th>Status</th>
    </tr>

    @foreach($orders as $index => $order)

    <tr>

        <td>
            {{ $index + 1 }}
        </td>

        <td>
            {{ $order->created_at->format('d-m-Y H:i') }}
        </td>

        <td>
            {{ $order->order_code }}
        </td>

        <td>
            Rp {{ number_format($order->total_price,0,',','.') }}
        </td>

        <td>
            {{ ucfirst($order->status) }}
        </td>

    </tr>

    @endforeach

</table>

<div class="footer">

    Dicetak pada :
    {{ now()->format('d-m-Y H:i') }}

</div>

</body>
</html>