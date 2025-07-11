<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('css/dashboardstyle.css')}}"/>
    <title>Dashboard</title>
  </head>
  <body>
     @include('layout.navbar')
     <div>
        <a href="{{ route('dashboard') }}">Home</a>
     </div>

    <div class="container">
        {{-- <div>
            {{ $errors }}
            <h2>Upload image</h2>
        <form action="{{ route('upload.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="profile image"></label>
        <input type="file" name="profile_image" id="profile_image" required>
        <button>sumit</button>
      </form>
      </div> --}}

    <h2>All Products</h2>
      <div class="category-bar">
         <a href="{{ route('dashboard', ['category' => 'All']) }}" class="{{ request('category') === 'All' || !request('category') ? 'active' : null}}"><span>All</span></a>
         <a href="{{ route('dashboard', ['category' => 'Electronics']) }}" class="{{ request('category') === 'Electronics' ? 'active' : null }}"><span>Electronics</span></a>
         <a href="{{ route('dashboard', ['category' => 'Fashion']) }}" class="{{ request('category') === 'Fashion' ? 'active' : null }}"><span>Fashion</span></a>
         <a href="{{ route('dashboard', ['category' => 'Accessories']) }}" class="{{ request('category') === 'Accessories' ? 'active' : null }}"><span>Accessories</span></a>
        </div>


      <div class="products-grid">

         @forelse ($products as $product)
        <div href="{{ route('product', $product->id) }}" class="product-card">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" />
          <div class="product-details">
            <div class="product-title">{{$product->name}}</div>
            <div class="product-price">{{$product->price}}</div>
            <div class="vendor-name">{{$product->user->name}}</div>
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                <button>Make purchase</button>
            </a>
          </div>
        </div>
         @empty
             <p>No products</p>
            @endforelse

      </div>


    </div>
  </body>
</html>
