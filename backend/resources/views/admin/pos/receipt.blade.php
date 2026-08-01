@extends('admin.layouts.app')

@section('content')

<div
style="
max-width:600px;
margin:auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
"
>

<h1 align="center">
SWEETBITE
</h1>

<hr>

<p>
<b>No Order :</b>
{{ $order->order_code }}
</p>

<p>
<b>Tanggal :</b>
{{ $order->created_at }}
</p>

<p>
<b>Kasir :</b>
{{ $order->user->name }}
</p>

<p>
<b>Pelanggan :</b>
{{ $order->customer_name }}
</p>

<p>
<b>No Antrian :</b>
{{ $order->queue_number }}
</p>

<hr>

<table width="100%">

<tr>
<th align="left">
Menu
</th>

<th>
Qty
</th>

<th align="right">
Total
</th>
</tr>

@foreach($order->items as $item)

<tr>

<td>

{{ $item->product->name }}

@php
$promo = \App\Models\Promotion::where('product_id',$item->product_id)
        ->where('is_active',1)
        ->whereDate('start_date','<=',now())
        ->whereDate('end_date','>=',now())
        ->first();
@endphp

@if($promo)
<br>
<small style="color:red">
Promo {{ $promo->discount_percent }}%
</small>
@endif

</td>

<td align="center">
{{ $item->qty }}
</td>

<td align="right">
Rp{{ number_format(
$item->qty * $item->price,
0,
',',
'.'
) }}
</td>

</tr>

@endforeach

</table>

<hr>

@php

$subtotal = 0;
$diskon = 0;

foreach($order->items as $item){

    $subtotal += $item->price * $item->qty;

    $hargaAsli = $item->product->price;

    $diskon +=
        ($hargaAsli - $item->price)
        * $item->qty;
}

@endphp

<p>

Subtotal :

Rp{{ number_format(
$subtotal + $diskon,
0,
',',
'.'
) }}

</p>

@if($diskon > 0)

<p style="color:red;">

Diskon :

- Rp{{ number_format(
$diskon,
0,
',',
'.'
) }}

</p>

@endif


</h2>
Total :

Rp{{ number_format(
$order->total_price,
0,
',',
'.'
) }}

</h2>

<p>

Metode Pembayaran :

<b>

{{ $order->payment->method }}

</b>

</p>

@if($order->payment->method == 'Tunai')

<p>

Uang Bayar :

Rp{{ number_format(
$order->cash_received,
0,
',',
'.'
) }}

</p>

<p>

Kembalian :

Rp{{ number_format(
$order->change_amount,
0,
',',
'.'
) }}

</p>

@endif

<p>

Status :

<b>

{{ strtoupper(
$order->payment->status
) }}

</b>

</p>

<br>

<button
onclick="window.print()"
>
Cetak Struk
</button>

<a href="/admin/pos">

<button>

Kembali ke POS

</button>

</a>

</div>

@endsection