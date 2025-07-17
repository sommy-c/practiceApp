<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardstyle.css') }}" />
  </head>
  <body>
    @include('layout.flash')
    @include('layout.productNav')
    <div>
        <a href="{{ route('dashboard') }}">Home</a>
     </div>

    <div class="container">
      <div class="product-details-page">
        <div class="product-info">

            {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image" />

             <h2>{{$product->name}}</h2>
             <p><strong>{{$product->price}}</strong></p>
             <p>{{$product->category}}</p>
             <p>Sold by <b>{{ $product->user->name }}</b></p>
            <p>
               {{ $product->description }}
            </p>
            <button type="submit">Buy Now</button>
            <a href="{{ route('edit', $product->id) }}"><button type="button">Edit Product</button></a>
            <form action="{{ route('delete.product', $product->id) }}" method="POST">
                @method('Delete')
                @csrf
                <button type="submit">Delete</button>
            </form> --}}

        </div>
      </div>


    </div>
  </body>
</html>

