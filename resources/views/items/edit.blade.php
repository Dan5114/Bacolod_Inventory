@extends('layouts.app')
@section('title','Edit Item')
@section('content')
<div class="container mt-4">
  <h2>Edit Item #{{ $item->id }}</h2>
  <form method="POST" action="{{ route('items.update',$item) }}" class="mt-3">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="{{ old('name',$item->name) }}" class="form-control" required>
      @error('name')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control">{{ old('description',$item->description) }}</textarea>
      @error('description')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity',$item->quantity) }}" class="form-control" min="0" required>
        @error('quantity')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Price</label>
        <input type="text" name="price" value="{{ old('price',$item->price) }}" class="form-control" required>
        @error('price')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
    </div>
    <button class="btn btn-success">Update Item</button>
    <a href="{{ route('inventory') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
