@extends('admin.layouts.app')

@section('content')

<h1>Kelola Menu</h1>

<a href="/admin/products/create" class="btn">
    + Tambah Produk
</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)

    <tr>

        <td>{{ $product->id }}</td>

        <td>

            @if($product->image)

                <img
                    src="{{ asset('storage/'.$product->image) }}"
                    width="80"
                    alt="{{ $product->name }}"
                >

            @else

                Tidak Ada Foto

            @endif

        </td>

        <td>{{ $product->name }}</td>

        <td>{{ $product->category->name }}</td>

        <td>
            Rp {{ number_format($product->price,0,',','.') }}
        </td>

        <td>{{ $product->stock }}</td>

        <td>

            <a href="/admin/products/{{ $product->id }}/edit">
                Edit
            </a>

            <form
                action="/admin/products/{{ $product->id }}"
                method="POST"
                style="display:inline;"
            >

                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection

