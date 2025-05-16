@extends('layouts.app')
@section('title', 'Add New Item')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="mb-4">Add New Item</h4>

        <form method="POST" action="{{ route('items.store') }}">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>
          </div>

          <div class="d-flex justify-content-between">
            <a href="{{ route('inventory') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Create Item</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
