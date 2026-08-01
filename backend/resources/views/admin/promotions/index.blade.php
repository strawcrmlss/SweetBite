@extends('admin.layouts.app')

@section('content')

<h1>Kelola Promo</h1>

<br>

<a
    href="/admin/promotions/create"
    class="btn"
>
    + Tambah Promo
</a>

<br><br>

<table>

    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Judul Promo</th>
        <th>Diskon</th>
        <th>Periode</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($promotions as $promo)

    <tr>

        <td>
            {{ $promo->id }}
        </td>

        <td>
            {{ $promo->product->name ?? '-' }}
        </td>

        <td>
            {{ $promo->title }}
        </td>

        <td>
            {{ $promo->discount_percent }}%
        </td>

        <td>
            {{ $promo->start_date }}
            <br>
            s/d
            <br>
            {{ $promo->end_date }}
        </td>

        <td>

            @if($promo->is_active)

                <span style="
                    background:#DCFCE7;
                    color:#166534;
                    padding:6px 12px;
                    border-radius:20px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Aktif
                </span>

            @else

                <span style="
                    background:#FEE2E2;
                    color:#991B1B;
                    padding:6px 12px;
                    border-radius:20px;
                    font-size:13px;
                    font-weight:600;
                ">
                    Nonaktif
                </span>

            @endif

        </td>

        <td>

            <a
                href="/admin/promotions/{{ $promo->id }}/edit"
                class="btn"
                style="
                    background:#2563EB;
                    margin-right:5px;
                "
            >
                Edit
            </a>

            <form
                action="/admin/promotions/{{ $promo->id }}"
                method="POST"
                style="display:inline;"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Yakin ingin menghapus promo ini?')"
                    style="
                        background:#DC2626;
                    "
                >
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection