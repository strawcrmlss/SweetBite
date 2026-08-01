@extends('admin.layouts.app')

@section('content')

<h1>Tambah Promo</h1>

<form
    method="POST"
    action="/admin/promotions"
>

    @csrf

    <p>Judul Promo</p>

    <input
        type="text"
        name="title"
        required
    >

    <br><br>

    <p>Produk Promo</p>

    <select
        name="product_id"
        required
    >

        <option value="">
            Pilih Produk
        </option>

        @foreach($products as $product)

            <option value="{{ $product->id }}">
                {{ $product->name }}
            </option>

        @endforeach

    </select>

    <br><br>

    <p>Deskripsi</p>

    <textarea
        name="description"
        rows="4"
        required
    ></textarea>

    <br><br>

    <p>Diskon (%)</p>

    <input
        type="number"
        name="discount_percent"
        min="1"
        max="100"
        required
    >

    <br><br>

    <p>Tanggal Mulai</p>

    <input
        type="date"
        name="start_date"
        required
    >

    <br><br>

    <p>Tanggal Berakhir</p>

    <input
        type="date"
        name="end_date"
        required
    >

    <br><br>

    <label>

        <input
            type="checkbox"
            name="is_active"
            value="1"
            checked
        >

        Aktif

    </label>

    <br><br>

    <button type="submit">
        Simpan Promo
    </button>

    <a
        href="/admin/promotions"
        class="btn"
        style="margin-left:10px;"
    >
        Batal
    </a>

</form>

@endsection