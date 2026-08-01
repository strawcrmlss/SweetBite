@extends('admin.layouts.app')

@section('content')

<style>

.pos-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
}

.box{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.products{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.product{
    border:1px solid #eee;
    border-radius:10px;
    overflow:hidden;
    text-align:center;
    transition:.3s;
}

.product:hover{
    transform:translateY(-3px);
}

.product img{
    width:100%;
    height:170px;
    object-fit:cover;
}

.product h3{
    margin:10px 0;
}

.price{
    color:#CC6FA5;
    font-weight:bold;
    margin-bottom:10px;
}

.add{
    width:90%;
    margin-bottom:15px;
}

.total-box{
    margin-top:20px;
    border-top:1px solid #ddd;
    padding-top:15px;
}

.total-box p{
    display:flex;
    justify-content:space-between;
    margin:8px 0;
}

.total-box h2{
    display:flex;
    justify-content:space-between;
    margin-top:15px;
}

.checkout{
    margin-top:20px;
}

.checkout select{
    margin-bottom:15px;
}

.checkout button{
    width:100%;
}

.cart-table{
    width:100%;
}

.cart-table th,
.cart-table td{
    padding:8px;
}

</style>

<h1>Point Of Sale</h1>

<div class="pos-grid">

    <div class="box">

        <h2>Daftar Menu</h2>

        <br>

        <div class="products">

            @php

use App\Models\Promotion;

$products = \App\Models\Product::all();

@endphp

            @foreach($products as $product)

                <div class="product">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                        >

                    @else

                        <img
                            src="https://via.placeholder.com/300x200?text=No+Image"
                        >

                    @endif

                    <h3>{{ $product->name }}</h3>

    @php

$promo = Promotion::where('product_id', $product->id)
    ->where('is_active', 1)
    ->whereDate('start_date', '<=', now())
    ->whereDate('end_date', '>=', now())
    ->first();

$finalPrice = $product->price;

if ($promo) {
    $finalPrice = $product->price - (
        $product->price * $promo->discount_percent / 100
    );
}

@endphp  

<div class="price">

@if($promo)

    <div style="
        color:#999;
        text-decoration:line-through;
        font-size:13px;
    ">
        Rp{{ number_format($product->price,0,',','.') }}
    </div>

    <div style="
        color:#CC6FA5;
        font-size:20px;
        font-weight:bold;
    ">
        Rp{{ number_format($finalPrice,0,',','.') }}
    </div>

    <div style="
        background:#FFE5D0;
        color:#CC6FA5;
        display:inline-block;
        padding:4px 10px;
        border-radius:20px;
        font-size:12px;
        margin-top:5px;
    ">
        Diskon {{ $promo->discount_percent }}%
    </div>

@else

    Rp{{ number_format($product->price,0,',','.') }}

@endif

</div>

                    <button
                        class="add"
                        onclick="tambah(
{{ $product->id }},
'{{ $product->name }}',
{{ $finalPrice }}
)"
                    >
                        Tambah
                    </button>

                </div>

            @endforeach

        </div>

    </div>

    <div class="box">

        <h2>Keranjang</h2>

        <table class="cart-table">

            <thead>

                <tr>
                    <th>Menu</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody id="cartBody">

            </tbody>

        </table>

        <div class="total-box">

            <p>
                <span>Subtotal</span>
                <b id="subtotal">Rp0</b>
            </p>

            <h2>
                <span>Total</span>
                <span id="total">Rp0</span>
            </h2>

        </div>

      <div class="checkout">

    <label>Nama Pelanggan</label>

    <input
        type="text"
        id="customer_name"
        class="form-control"
        placeholder="Masukkan nama pelanggan"
    >

    <br>

    <label>Nomor Antrian</label>

    <input
        type="text"
        id="queue_number"
        value="A{{ rand(100,999) }}"
        class="form-control"
        readonly
    >

    <br>

   <select id="payment_method">

    <option value="Tunai">Tunai</option>

    <option value="QRIS">QRIS</option>

    <option value="GoPay">GoPay</option>

    <option value="OVO">OVO</option>

    <option value="DANA">DANA</option>

    <option value="Transfer Bank">Transfer Bank</option>

</select>

    <br><br>

<div id="cashSection">

    <label>Uang Bayar</label>

    <input
        type="number"
        id="cash_received"
        class="form-control"
        oninput="hitungKembalian()"
        placeholder="Masukkan uang pelanggan"
    >

    <br>

    <label>Kembalian</label>

    <input
        type="text"
        id="change_amount"
        class="form-control"
        readonly
    >

</div>

    <br>

    <button onclick="checkout()">
        Bayar
    </button>

</div>

    </div>

</div>

<script>

let cart = [];

function tambah(id,nama,harga){

    let item = cart.find(i => i.id === id);

    if(item){

        item.qty++;

    }else{

cart.push({
    id:id,
    nama:nama,
    harga:harga,
    qty:1
});

    }

    renderCart();
}

function hapus(index){

    cart.splice(index,1);

    renderCart();
}

function renderCart(){

    let body = document.getElementById('cartBody');

    body.innerHTML = '';

    let subtotal = 0;

    cart.forEach((item,index)=>{

        let totalItem = item.harga * item.qty;

        subtotal += totalItem;

        body.innerHTML += `
        <tr>
            <td>${item.nama}<br>
                Qty : ${item.qty}
            </td>

            <td>
                Rp${totalItem.toLocaleString('id-ID')}
            </td>

            <td>
                <button
                    onclick="hapus(${index})"
                >
                    X
                </button>
            </td>
        </tr>
        `;

    });

    let total = subtotal;

document.getElementById('subtotal').innerHTML =
    'Rp' + subtotal.toLocaleString('id-ID');

document.getElementById('total').innerHTML =
    'Rp' + total.toLocaleString('id-ID');
}


function checkout(){

    if(cart.length == 0){

        alert('Keranjang kosong');

        return;
    }

    let metode =
document.getElementById(
'payment_method'
).value;

if(
metode === 'Tunai'
){

    let bayar =
    parseInt(
    document.getElementById(
    'cash_received'
    ).value
    ) || 0;

    let total =
    parseInt(
    document.getElementById(
    'total'
    ).innerText
    .replace('Rp','')
    .replace(/\./g,'')
    );

    if(bayar < total){

        alert(
        'Uang pelanggan kurang'
        );

        return;
    }
}

    fetch('/admin/pos/checkout',{

        method:'POST',

        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':
            '{{ csrf_token() }}'
        },

       body:JSON.stringify({

    cart:cart,

    customer_name:
    document.getElementById(
    'customer_name'
    ).value,

    queue_number:
    document.getElementById(
    'queue_number'
    ).value,

    cash_received:
    document.getElementById(
    'cash_received'
    ).value,

    change_amount:
    document.getElementById(
    'change_amount'
    ).value
    .replace('Rp','')
    .replace(/\./g,''),

   method:
document.getElementById(
'payment_method'
).value 

})

    })

    .then(res=>res.json())

    .then(data=>{

    if(data.method == 'Tunai'){

    window.location =
    '/admin/pos/receipt/' +
    data.order_id;

}else if(data.method == 'QRIS'){

    window.location =
    '/admin/pos/qris/' +
    data.order_id;

}else{

    window.location =
    '/admin/pos/receipt/' +
    data.order_id;
}

});

}

function hitungKembalian(){

    let totalText =
        document.getElementById('total').innerText;

    let total =
        Number(
            totalText
            .replace('Rp','')
            .replace(/\./g,'')
        );

    let bayar =
        Number(
            document.getElementById(
                'cash_received'
            ).value
        );

    let kembali =
        bayar - total;

    document.getElementById(
        'change_amount'
    ).value =

    kembali > 0
    ? 'Rp'+kembali.toLocaleString('id-ID')
    : 'Rp0';
}



document
.getElementById('payment_method')
.addEventListener('change', function(){

    let cashSection =
    document.getElementById('cashSection');

    if(this.value == 'Tunai'){

        cashSection.style.display = 'block';

    }else{

        cashSection.style.display = 'none';

        document.getElementById(
            'cash_received'
        ).value = '';

        document.getElementById(
            'change_amount'
        ).value = '';
    }

});

document
.getElementById('payment_method')
.dispatchEvent(
    new Event('change')
);
</script>

@endsection