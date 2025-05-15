@extends('layouts.app')
@section('title','Your Cart')

@section('content')
<h2 class="mb-4">Shopping Cart</h2>

@if(empty($cart))
  <p>Your cart is empty. <a href="{{ route('inventory') }}">Go shopping!</a></p>
@else
  <table class="table table-bordered table-striped bg-white">
    <thead>
      <tr>
        <th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $total = 0; @endphp
      @foreach($items as $item)
        @php $qty = $cart[$item->id]; $sub = $item->price * $qty; $total += $sub; @endphp
        <tr>
          <td>{{ $item->name }}</td>
          <td>
            <form method="POST" action="{{ route('cart.update',$item) }}" class="d-flex">
              @csrf
              <input type="number" name="quantity" value="{{ $qty }}" min="1" max="{{ $item->quantity }}"
                     class="form-control form-control-sm me-2" style="width:80px;">
              <button class="btn btn-sm btn-primary">Update</button>
            </form>
          </td>
          <td>₱{{ number_format($item->price,2) }}</td>
          <td>₱{{ number_format($sub,2) }}</td>
          <td>
            <form method="POST" action="{{ route('cart.remove',$item) }}">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Remove</button>
            </form>
          </td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3" class="text-end"><strong>Total:</strong></td>
        <td colspan="2"><strong>₱{{ number_format($total,2) }}</strong></td>
      </tr>
    </tbody>
  </table>

  <form method="POST" action="{{ route('cart.checkout') }}">
    @csrf
    <button class="btn btn-success">Checkout All</button>
    <a href="{{ route('inventory') }}" class="btn btn-secondary">Continue Shopping</a>
  </form>
@endif
@endsection
