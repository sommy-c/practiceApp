<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboardstyle.css') }}">
    <title>Document</title>
</head>

    @include('layout.productNav')
    <div class="container">
      <h2>Edit Product</h2>
      <form class="upload-form" action="{{ route('update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Product Name</label>
        <input type="text" placeholder="Enter product name" value="{{ $product->name }}" name="name" />


        <label>Category</label>
        <select value="{{ $product->category }}" name="category">
          <option>Electronics</option>
          <option>Fashion</option>
          <option>Home</option>
          <option>Accessories</option>
        </select>

        <label>Upload new image </label>
        <input type="file"  name="image" required />



        <label>Price</label>
        <input type="number" placeholder="Enter price" value="{{ $product->price }}" name="price" required/>


        <label>Description</label>
        <input type="text" placeholder="Enter Product Description" value="{{ $product->description }}" name="description" required/>

        <button type="submit">Submit</button>
      </form>
    </div>

</body>
</html>
