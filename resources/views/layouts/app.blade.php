<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Bacolod Inventory')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles_login.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('{{ asset('images/bg.jpg') }}') center/cover no-repeat fixed;
      min-height: 100vh;
    }
  </style>
</head>
<body>
@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm w-100">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand me-3" href="{{ route('inventory') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
    </a>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navigation content -->
    <div class="collapse navbar-collapse justify-content-between" id="mainNav">
      <!-- Search -->
      <form class="d-flex w-100 me-3" method="GET" action="{{ route('inventory') }}">
        <input class="form-control me-2" type="search" name="search" placeholder="Search by Name or ID" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>

      <!-- Cart + Logout -->
      <div class="d-flex align-items-center gap-3">
        <a class="btn btn-warning position-relative" href="{{ route('cart.index') }}">
          <i class="fas fa-shopping-cart"></i>
          @php $count = session('cart',[]); @endphp
          @if(array_sum($count) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ array_sum($count) }}
            </span>
          @endif
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-outline-light">Logout</button>

           <!-- View Logs -->
<a class="btn btn-outline-info" href="{{ route('logs.index') }}">Activity Logs</a>
        </form>
      </div>
    </div>
  </div>
</nav>
@endauth






  <div class="container py-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
