<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Upload Product</title>
    <link rel="stylesheet" href="{{ asset('css/dashboardstyle.css') }}" />
  </head>
  <body>
    @include('layout.productNav')

    <div class="container">
      <h2>Upload Product</h2>
      <form class="upload-form" action="{{ route('upload.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Product Name</label>
        <input type="text" placeholder="Enter product name" name="name" />
        @error('name')
         <div class="error">{{ $message }}</div>
          @enderror


        <label>Category</label>
        <select name="category">
          <option>Electronics</option>
          <option>Fashion</option>
          <option>Home</option>
          <option>Accessories</option>
        </select>
        @error('category')
         <div class="error">{{ $message }}</div>
          @enderror

        <label>Image </label>
        <input type="file" name="image" required />
        @error('image')
         <div class="error">{{ $message }}</div>
          @enderror



        <label>Price</label>
        <input type="number" placeholder="Enter price" name="price" required/>
        @error('number')
         <div class="error">{{ $message }}</div>
          @enderror


        <label>Description</label>
        <input type="text" placeholder="Enter Product Description" name="description" required/>
        @error('description')
         <div class="error">{{ $message }}</div>
          @enderror

        <button type="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
