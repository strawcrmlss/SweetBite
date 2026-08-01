@extends('admin.layouts.app')

@section('content')

<h1>Kelola Pesanan</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Kode Order</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($orders as $order)

<tr>

<td>{{ $order->id }}</td>

<td>{{ $order->order_code }}</td>

<td>
Rp {{ number_format($order->total_price,0,',','.') }}
</td>

<td>{{ $order->status }}</td>

<td>

<a href="/admin/orders/{{ $order->id }}/edit">

Update Status

</a>

</td>

</tr>

@endforeach

</table>

@endsection