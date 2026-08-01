@extends('admin.layouts.app')

@section('content')

<h1>Tambah Kategori</h1>

<form method="POST" action="/admin/categories">

    @csrf

    <p>Nama Kategori</p>

    <input
        type="text"
        name="name"
    >

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

@endsection