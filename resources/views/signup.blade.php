<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>

  </head>
  <body>

     @include('layout.flash')


    <div class="container">
      <div class="image-side">
        <img src="{{ asset('image/signup.jpg') }}" alt="Signup Image" />
      </div>

      <div class="form-side">
        <h2>Sign Up</h2>
        <form action="{{ route('signup-submit') }}" method="POST">
            @csrf
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" required name="name"/>
             @error('name')
          <p>{{$message}}</p>
          @enderror
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" required name="email"/>
            @error('email')
          <p>{{$message}}</p>
          @enderror
          </div>


          <div class="form-group">
            <label>Password</label>
            <input type="password" required  name="password" />
             @error('password')
          <p>{{$message}}</p>
          @enderror

          </div>

          <div class="form-group">
            <label> Confirm Password</label>
            <input type="password" required  name="password_confirmation"/>
             @error('password_confirmation')
          <p>{{$message}}</p>
          @enderror
          </div>


          <button type="submit">Sign Up</button>
          <p class="switch-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
          </p>
        </form>
      </div>
    </div>
  </body>
</html>
