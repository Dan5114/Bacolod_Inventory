@extends('layouts.app')
@section('title','Warehouse Inventory')

@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
  @foreach($items as $item)
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $item->name }}</h5>
          <p class="card-text flex-grow-1">{{ $item->description }}</p>
          <ul class="list-unstyled small mb-3">
            <li><strong>Qty:</strong> {{ $item->quantity }}</li>
            <li><strong>Price:</strong> ₱{{ number_format($item->price,2) }}</li>
            <li><strong>Added:</strong> {{ $item->created_at->format('Y-m-d') }}</li>
          </ul>
          <div class="mt-auto d-grid gap-2">
            @can('checkout',$item)
              <form method="POST" action="{{ route('cart.add',$item) }}" class="d-inline">
                @csrf
                <button class="btn btn-success btn-sm">
                  <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
              </form>
              <form method="POST" action="{{ route('items.checkout',$item) }}" class="d-inline">
                @csrf
                <div class="input-group input-group-sm my-1">
                  <input type="number" name="quantity" value="1" min="1" max="{{ $item->quantity }}"
                         class="form-control" style="max-width: 80px;">
                  <button class="btn btn-primary">Checkout</button>
                </div>
              </form>
            @endcan
            @can('manage',\App\Models\WarehouseItem::class)
              <a href="{{ route('items.edit',$item) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
              </a>
              <form method="POST" action="{{ route('items.destroy',$item) }}" onsubmit="return confirm('Delete?');">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-sm">
                  <i class="fas fa-trash"></i> Delete
                </button>
              </form>
            @endcan
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-flex justify-content-center my-4">
  {{ $items->links('pagination::bootstrap-5') }}
</div>
@endsection
