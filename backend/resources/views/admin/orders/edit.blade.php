@extends('admin.layouts.app')

@section('content')

<h1>Update Status Pesanan</h1>

<form
method="POST"
action="/admin/orders/{{ $order->id }}"
>

@csrf
@method('PUT')

<select name="status">

<option
value="pending"
{{ $order->status=='pending' ? 'selected':'' }}
>
Pending
</option>

<option
value="paid"
{{ $order->status=='paid' ? 'selected':'' }}
>
Paid
</option>

<option
value="processing"
{{ $order->status=='processing' ? 'selected':'' }}
>
Processing
</option>

<option
value="completed"
{{ $order->status=='completed' ? 'selected':'' }}
>
Completed
</option>

<option
value="cancelled"
{{ $order->status=='cancelled' ? 'selected':'' }}
>
Cancelled
</option>

</select>

<br><br>

<button type="submit">

Update Status

</button>

</form>

@endsection