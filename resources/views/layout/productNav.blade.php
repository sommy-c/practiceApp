<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboardstyle.css') }}">
    <title>Document</title>
</head>
<body>
<header class="header">
  <div class="nav-container">
    <h1 class="logo">MyMultiShop</h1>

    <div class="search-bar">
        <form action="{{ route('product.search') }}" method="POST">
            @method('GET')
            @csrf
      <input type="text" placeholder="Search products..." name="search">
      <button type="submit" class="btn">Search</button>
        </form>
    </div>

    @auth
    <div class="auth-section">
      <p class="welcome">Welcome, <strong>{{ Auth::user()->name }}</strong></p>



      <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="btn logout-btn">Logout</button>
      </form>
    </div>
    @endauth
    @guest
          <div class="auth-buttons">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('signup') }}">Signup</a>

      </div>
      @endguest

  </div>
</header>

</body>
</html>
