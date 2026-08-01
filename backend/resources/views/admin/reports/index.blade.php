@extends('admin.layouts.app')

@section('content')

<h1>Laporan Penjualan</h1>

<br>

<form
    method="GET"
    action="{{ url('/admin/reports') }}"
    style="
        display:flex;
        gap:15px;
        align-items:end;
        flex-wrap:wrap;
        margin-bottom:25px;
    "
>

    <div>
        <label><b>Dari Tanggal</b></label><br>
        <input
            type="date"
            name="start_date"
            value="{{ request('start_date') }}"
            style="
                padding:10px;
                border:1px solid #ddd;
                border-radius:8px;
            "
        >
    </div>

    <div>
        <label><b>Sampai Tanggal</b></label><br>
        <input
            type="date"
            name="end_date"
            value="{{ request('end_date') }}"
            style="
                padding:10px;
                border:1px solid #ddd;
                border-radius:8px;
            "
        >
    </div>

    <button
        type="submit"
        style="
            background:#CC6FA5;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
        "
    >
        Filter
    </button>

    <a
        href="{{ url('/admin/reports/pdf?start_date='.request('start_date').'&end_date='.request('end_date')) }}"
        target="_blank"
        style="
            background:#CC6FA5;
            color:white;
            padding:10px 15px;
            text-decoration:none;
            border-radius:8px;
        "
    >
        Cetak PDF
    </a>

</form>

<div style="display:flex;gap:20px;flex-wrap:wrap;">

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
    ">
        <h3>Total Pesanan</h3>

        <h1>
            {{ $totalOrders }}
        </h1>
    </div>

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
    ">
        <h3>Pesanan Selesai</h3>

        <h1>
            {{ $completedOrders }}
        </h1>
    </div>

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
    ">
        <h3>Total Pendapatan</h3>

        <h2>
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </h2>
    </div>

</div>

<br><br>

<h2>Grafik Penjualan</h2>

<div style="
    background:white;
    padding:20px;
    border-radius:12px;
">
    <canvas id="salesChart"></canvas>
</div>

<br><br>

<h2>Data Pesanan</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Kode</th>
    <th>Total</th>
    <th>Status</th>
</tr>

@foreach($orders as $order)

<tr>

    <td>{{ $order->order_code }}</td>

    <td>
        Rp {{ number_format(
            $order->total_price,
            0,
            ',',
            '.'
        ) }}
    </td>

    <td>{{ $order->status }}</td>

</tr>

@endforeach

</table>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const salesData = @json($salesData);

const labels = salesData.map(item => item.day);
const values = salesData.map(item => item.sales);

new Chart(
    document.getElementById('salesChart'),
    {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan (Rp)',
                data: values,
                borderColor:'#CC6FA5',
                backgroundColor:'rgba(255,107,0,0.2)',
                fill:true,
                tension:0.4
            }]
        }
    }
);

</script>

@endsection