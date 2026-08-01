@extends('admin.layouts.app')

@section('content')

<h1>Edit Produk</h1>

<form
    method="POST"
    action="/admin/products/{{ $product->id }}"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <p>Nama Produk</p>
    <input
        type="text"
        name="name"
        value="{{ $product->name }}"
    >

    <br><br>

    <p>Kategori</p>

    <select name="category_id">

        @foreach($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ $product->category_id == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>

        @endforeach

    </select>

    <br><br>

    <p>Harga</p>
    <input
        type="number"
        name="price"
        value="{{ $product->price }}"
    >

    <br><br>

    <p>Stok</p>
<input
    type="number"
    name="stock"
    value="{{ $product->stock }}"
>

<br><br>

<p>Deskripsi Produk</p>

<textarea
    name="description"
    rows="5"
    cols="50"
>{{ $product->description }}</textarea>

<br><br>

<p>Gambar Produk</p>
<input type="file" name="image">
    <br><br>

    <button type="submit">
        Update Produk
    </button>

</form>

@endsection