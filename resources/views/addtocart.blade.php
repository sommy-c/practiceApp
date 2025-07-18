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

    @include('layout.navbar')
  <div class="cart-page">


  <!-- Left Side: All Products in Cart -->

  <div class="cart-products">
    @forelse ($products as $product)
    <div class="cart-header">
  <h2>{{ $product->user->name }}'s Cart ({{ $totalItems }} {{ $totalItems > 1 ? 's' : '' }})</h2>
</div>

    <div class="cart-card">
      <div class="cart-image">
        <span class="cart-label">Cart</span>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
      </div>

      <div class="cart-details">
        <h3>{{ $product->name }}</h3>
        <p class="price">₦{{ number_format($product->price, 2) }}</p>
        <p><strong>Quantity:</strong> {{ $cart[$product->id]['quantity'] }}</p>
        <p>{{ $product->description }}</p>
        <button class="add-to-cart">Add to Cart</button>
      </div>
    </div>
  @empty
    <p>No products found</p>
  @endforelse
</div>


  <!-- Right Side: Cart Sidebar -->
  <div class="cart-sidebar">
    <h3> Cart Summary</h3>
    <div class="cart-items">
      @foreach($products as $product)
        <p>{{ $product->name }} x {{ $cart[$product->id]['quantity'] }}</p>
      @endforeach
    </div>
    <div class="cart-total">
      <strong>Total: ₦{{ number_format(
        collect($products)->sum(fn($p) => $p->price * $cart[$p->id]['quantity']), 2) }}</strong>
    </div>
    <button class="checkout-btn">Checkout</button>
  </div>

</div>
</body>
</html>
