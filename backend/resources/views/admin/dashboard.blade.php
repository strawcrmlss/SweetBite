@extends('admin.layouts.app')

@section('content')

<style>

.dashboard-header{
    margin-bottom:30px;
}

.dashboard-header h1{
    font-size:48px;
    font-weight:700;
    margin-bottom:8px;
}

.dashboard-header p{
    color:#777;
    font-size:15px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    background:#fff;
    border-radius:16px;
    padding:24px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
    border-top:4px solid #CC6FA5;
    transition:.3s;
}

.card:hover{
    transform:translateY(-4px);
}

.card h3{
    font-size:16px;
    color:#555;
    margin-bottom:15px;
}

.number{
    font-size:34px;
    font-weight:700;
    color:#CC6FA5;
}

.dashboard-row{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:20px;
    margin-bottom:25px;
}

.box{
    background:#fff;
    border-radius:16px;
    padding:24px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

.box h2{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#CC6FA5;
    color:white;
    padding:14px;
    text-align:left;
}

table td{
    padding:14px;
    border-bottom:1px solid #eee;
}

table tr:hover{
    background:#fafafa;
}

.status{
    background:#fff3e8;
    color:#CC6FA5;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.chart-container{
    height:350px;
}

@media(max-width:1000px){

    .dashboard-row{
        grid-template-columns:1fr;
    }

}

</style>

<div class="dashboard-header">
    <h1>Dashboard SweetBite</h1>
    <p>Pantau operasional dan penjualan SweetBite secara real-time</p>
</div>

<div class="cards">

    <div class="card">
        <h3>Total Produk</h3>
        <div class="number">{{ $totalProducts }}</div>
    </div>

    <div class="card">
        <h3>Total Kategori</h3>
        <div class="number">{{ $totalCategories }}</div>
    </div>

    <div class="card">
        <h3>Total Pesanan</h3>
        <div class="number">{{ $totalOrders }}</div>
    </div>

    <div class="card">
        <h3>Total Promo</h3>
        <div class="number">{{ $totalPromotions }}</div>
    </div>

    <div class="card">
        <h3>Total Pendapatan</h3>
        <div class="number">
            Rp {{ number_format($totalRevenue,0,',','.') }}
        </div>
    </div>

    <div class="card">
        <h3>Pesanan Hari Ini</h3>
        <div class="number">{{ $todayOrders }}</div>
    </div>

</div>

<div class="dashboard-row">

    <div class="box">

        <h2>Grafik Penjualan</h2>

        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>

    </div>

    <div class="box">

        <h2>Pesanan Terbaru</h2>

        <table>

            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            @foreach($latestOrders as $order)

                <tr>
                    <td>{{ $order->order_code }}</td>

                    <td>
                        <span class="status">
                            {{ $order->status }}
                        </span>
                    </td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="box">

    <h2>Produk Terbaru</h2>

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
            </tr>

        </thead>

        <tbody>

        @foreach($latestProducts as $product)

            <tr>

                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>
                    Rp {{ number_format($product->price,0,',','.') }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const salesData = @json($salesData);

const labels = salesData.map(item => item.day);
const values = salesData.map(item => item.sales);

new Chart(
    document.getElementById('salesChart'),
    {
        type:'line',
        data:{
            labels:labels,
            datasets:[{
                label:'Penjualan (Rp)',
                data:values,
                borderColor:'#CC6FA5',
                backgroundColor:'rgba(204,111,165,0.18)',
                fill:true,
                tension:0.4,
                borderWidth:3
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false
        }
    }
);

</script>

@endsection