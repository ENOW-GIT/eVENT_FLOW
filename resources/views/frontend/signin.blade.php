<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="backend/login.css">
    <script defer src="backend/login.js"></script>
</head>
<body>
    <div class="container">
        <h1>Bienvenu chez <span>EventFlow</span></h1>
        <p>Veuillez remplir le formulaire pour vous connecter à votre espace personnel</p>
        <!-- Display success and Error Messages-->
         @if(session('success'))
          <div class="alert alert-success">{{ session('success')}}</div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger">{{ session('error')}}</div>
          @endif
          <!-- Display Validation Errors -->
           @if($errors->any())
           <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
           </div>
          @endif
          
        <form action="{{ route('frontend.signin') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="" required>
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="" required>
                
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div id="error-message" class="error"></div>
        </form>
        <div class="signup-link">
            You don't have an account? <a href="{{route('frontend.signup')}}">Create an account</a>
        </div>
    </div>
</body>
</html>
