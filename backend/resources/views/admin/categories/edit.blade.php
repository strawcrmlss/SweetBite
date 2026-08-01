@extends('admin.layouts.app')

@section('content')

<h1>Edit Kategori</h1>

<form
    method="POST"
    action="/admin/categories/{{ $category->id }}"
>

    @csrf
    @method('PUT')

    <p>Nama Kategori</p>

    <input
        type="text"
        name="name"
        value="{{ $category->name }}"
    >

    <br><br>

    <button type="submit">
        Update
    </button>

</form>

@endsection