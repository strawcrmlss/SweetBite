@extends('admin.layouts.app')

@section('content')

<h1>Tambah Menu</h1>

<form
    method="POST"
    action="/admin/products"
    enctype="multipart/form-data"
>

    @csrf

    <p>Nama Produk</p>
    <input type="text" name="name">

    <br><br>

    <p>Kategori</p>

    <select name="category_id">

        @foreach($categories as $category)

            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>

        @endforeach

    </select>

    <br><br>

    <p>Harga</p>
    <input type="number" name="price">

    <br><br>

    <p>Stok</p>
<input type="number" name="stock">

<br><br>

<p>Deskripsi Produk</p>

<textarea
    name="description"
    rows="5"
    cols="50"
></textarea>

<br><br>

<p>Gambar Produk</p>
<input
    type="file"
    name="image"
    accept="image/*"
    required
>

    <br><br>

    <button type="submit">
        Simpan Produk
    </button>

</form>

@endsection