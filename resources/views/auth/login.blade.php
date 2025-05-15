@extends('layouts.app')
@section('title','Log In')
@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="logo mb-4 text-center">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-width:300px;">
  </div>
  <div class="login-container p-4 bg-white rounded shadow">
    <h1 class="mb-3">Inventory System</h1>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <input type="email" name="email" value="{{ old('email') }}"
               class="form-control" placeholder="Email" required autofocus>
        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="mb-3">
        <input type="password" name="password"
               class="form-control" placeholder="Password" required>
        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
    @if(session('error'))<p class="mt-3 text-danger">{{ session('error') }}</p>@endif
  </div>
</div>
@endsection
