<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="backend/signup.css">
    <script defer src="backend/signup.js"></script>
</head>

<body>
    <div class="container">
        <h1>Bienvenu chez <span>EventFlow</span></h1>
        <p>Please fill the form </p>

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
        <form action="{{ route('frontend.signup') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" value="__('Name')">Name / Noms</label>
                <input type="text" id="name" name="name" placeholder="old('name')" required>

            </div>
            <div class="form-group">
                <label for="email" value="__('Email')">Email address / Adresse email</label>
                <input type="email" id="email" name="email" placeholder="old('email')" required>

            </div>
            <div class="form-group">
                <label for="phone_number" value="__('phone')">Phone number / Numéro de Téléphone</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="old('phone')" required>

            </div>
            <div class="form-group">
                <label for="password" value="__('Password')">Password / Mot de passe</label>
                <input type="password" id="password" name="password" required>

            </div>
            <div class="form-group">
                <label for="password_confirmation" value="__('Confirm Password')">Confirm password / Confirmez le mot de
                    passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="booker">Booker</option>
                    <option value="organizer">Organizer</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Submit / S'inscrire</button>
            </div>
        </form>
        <div class="signup-link">
            Vous avez déjà un compte? <a href="{{route('frontend.signin')}}">Connectez vous !</a>
        </div>
        <p id="error-message"></p>
    </div>
</body>

</html>