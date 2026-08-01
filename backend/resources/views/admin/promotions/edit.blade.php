@extends('admin.layouts.app')

@section('content')

<h1>Edit Promo</h1>

<form
    method="POST"
    action="/admin/promotions/{{ $promotion->id }}"
>

    @csrf
    @method('PUT')

    <p>Judul Promo</p>

    <input
        type="text"
        name="title"
        value="{{ $promotion->title }}"
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

            <option
                value="{{ $product->id }}"
                {{ $promotion->product_id == $product->id ? 'selected' : '' }}
            >
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
    >{{ $promotion->description }}</textarea>

    <br><br>

    <p>Diskon (%)</p>

    <input
        type="number"
        name="discount_percent"
        min="1"
        max="100"
        value="{{ $promotion->discount_percent }}"
        required
    >

    <br><br>

    <p>Tanggal Mulai</p>

    <input
        type="date"
        name="start_date"
        value="{{ \Carbon\Carbon::parse($promotion->start_date)->format('Y-m-d') }}"
        required
    >

    <br><br>

    <p>Tanggal Berakhir</p>

    <input
        type="date"
        name="end_date"
        value="{{ \Carbon\Carbon::parse($promotion->end_date)->format('Y-m-d') }}"
        required
    >

    <br><br>

    <label>

        <input
            type="checkbox"
            name="is_active"
            value="1"
            {{ $promotion->is_active ? 'checked' : '' }}
        >

        Aktif

    </label>

    <br><br>

    <button type="submit">
        Update Promo
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