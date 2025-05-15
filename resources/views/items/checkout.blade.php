@extends('layouts.app')
@section('title','Checkout Item')
@section('content')
<div class="container my-4">
  <h2>Checkout: {{ $item->name }}</h2>
  <p>Available: {{ $item->quantity }}</p>
  <form method="POST" action="{{ route('items.checkout',$item) }}">
    @csrf
    <div class="mb-3">
      <label>Quantity</label>
      <input type="number" name="quantity" min="1" max="{{ $item->quantity }}"
             class="form-control" required>
      @error('quantity')<p class="text-danger">{{ $message }}</p>@enderror
    </div>
    <button class="btn btn-success">Submit</button>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
