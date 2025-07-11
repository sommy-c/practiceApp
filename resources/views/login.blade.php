<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
     <link rel="stylesheet" href="{{asset('css/style.css')}}"/>

  </head>
  <body>
    @include('layout.flash')


    <div class="container">
      <div class="image-side">
        <img src="{{ asset('image/login.jpg') }}" alt="Login Image" />
      </div>

      <div class="form-side">
        <h2>Login</h2>
        <form action="{{ route('login_submit') }}" method="POST">
            @csrf
          <div class="form-group">
            <label>Email</label>
            <input type="email"  name="email"/>
              @error('email')
          <p>{{$message}}</p>
          @enderror
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"/>
              @error('password')
          <p>{{$message}}</p>
          @enderror

          </div>
          <button type="submit">Login</button>
          <p class="switch-link">
            Don't have an account? <a href="{{ route('signup') }}">Sign Up</a>
          </p>
        </form>
      </div>
    </div>

  </body>
</html>
