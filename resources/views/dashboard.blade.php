<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

      <div class="cart-bar">

      <div class="category-bar">
         <a href="{{ route('dashboard', ['category' => 'All']) }}" class="{{ request('category') === 'All' || !request('category') ? 'active' : null}}"><span>All</span></a>
         <a href="{{ route('dashboard', ['category' => 'Electronics']) }}" class="{{ request('category') === 'Electronics' ? 'active' : null }}"><span>🔌Electronics</span></a>
         <a href="{{ route('dashboard', ['category' => 'Fashion']) }}" class="{{ request('category') === 'Fashion' ? 'active' : null }}"><span>👓Fashion</span></a>
         <a href="{{ route('dashboard', ['category' => 'Accessories']) }}" class="{{ request('category') === 'Accessories' ? 'active' : null }}"><span>⌚Accessories</span></a>
         <a href="{{ route('dashboard', ['category' => 'Home & Office']) }}" class="{{ request('category') === 'Home & Office' ? 'active' : null }}"><span>🛏️Home & Office</span></a>
         <a href="{{ route('dashboard', ['category' => 'Health & Beauty']) }}" class="{{ request('category') === 'Health & Beauty' ? 'active' : null }}"><span>💄Health & Beauty</span></a>
         <a href="{{ route('dashboard', ['category' => 'Baby Products']) }}" class="{{ request('category') === 'Baby Products' ? 'active' : null }}"><span>🍼Baby Products</span></a>
         <a href="{{ route('dashboard', ['category' => 'Gaming']) }}" class="{{ request('category') === 'Gaming' ? 'active' : null }}"><span>🎮Gaming</span></a>
        </div>

            <div class="addtocart">
             {{-- <a href="" class="cart-btn">
             <i class="fas fa-shopping-cart"></i>
             <span class="cart-count">3</span>
             </a> --}}
             <a href="" class="cart-btn">
             <i class="bi bi-cart"></i>
              <span class="cart-count">3</span>
             </a>


               </div>

        </div>

        <div class="scroll-container">
            <button class="scroll-btn left"  onclick="scrollLeft()">
              &#10094; <!-- left arrow icon -->
             </button>

      <div class="products-grid" id="productScroll">

         @forelse ($products as $product)
        <div class="product-card">
            <a href="{{ route('product', $product->id) }}">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" />
            </a>
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
            <button class="scroll-btn right" onclick="scrollRight()">
               &#10095; <!-- right arrow icon -->
            </button>
        </div>


{{-- Top sellers section --}}

       <div>
        <div class="top-products">
        <h2>Top Sellers</h2>
        <a href="{{ route("top-seller") }}">View all</a>
         </div>



        <div class="products-grid">
            @forelse ($topSellers as $topseller)


        <a href="{{ route('product', $ptopseller->id) }}">
         <img src="{{ asset('storage/' . $topseller->image) }}" alt="{{ $product->name }}" class="product-image">
         </a>
          <div class="product-details">
          <div class="product-title">{{ $topseller->name }}</div>
          <div class="product-price">₦{{ number_format($topseller->price, 2) }}</div>
          <div class="vendor-name">{{ $topseller->user->name  }}</div>

            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}">
            <button>Make purchase</button>
            </a>
            </div>


        </div>

         @empty
         <p>No products found</p>
            @endforelse

        </div>

        </div>

    </div>

        <script>
         const scrollContainer = document.getElementById('productScroll');


         function scrollLeft() {
            const container = document.getElementById('productScroll');
           container.scrollBy({ left: -300, behavior: 'smooth' });
           }

          function scrollRight() {
            const container = document.getElementById('productScroll');
            container.scrollBy({ left: 300, behavior: 'smooth' });
             }
         </script>

  </body>
</html>
