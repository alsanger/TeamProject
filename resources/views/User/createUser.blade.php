

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="post" action="{{ route('user.createUserPost') }}">
            @csrf


            <div class="input-group">
                <input id="loginInput" type="text" name="login"  value="{{ old('login') }}" required />

                <label for="loginInput">Login</label>
                @if ($errors->has('login'))
                    <label class="errorLabel">{{ $errors->first('login') }}</label>
                @endif
            </div>


            <div class="input-group">
                <input id="passwordInput" type="password" name="password" required />
                <label for="passwordInput">Password</label>
                @if ($errors->has('password'))
                    <label class="errorLabel">{{ $errors->first('password') }}</label>
                @endif
            </div>


            <div class="input-group">
                <input type="text" name="first_name" value="{{ old('first_name') }}" required/>
                <label for="emailInput">First Name</label>
            </div>

            <div class="input-group">
                <input type="text" name="last_name" value="{{ old('last_name') }}" required/>
                <label for="emailInput">Last Name</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" required />
                <label for="emailInput">Email</label>
            </div>


            <div class="input-group">
                <input type="number" name="phone" value="{{ old('phone') }}" required/>
                <label for="emailInput">Phone</label>
            </div>

            <div class="input-group">
                <input type="text" name="image_link" value="{{ old('image_link') }}" required/>
                <label for="emailInput">Image Link</label>
            </div>


            <button id="button" type="submit">Register</button>






        </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="post" action="{{ route('user.loginUserPost') }}" class="login__form">
            @csrf
            <h1>Sing In</h1>



            <div class="input-group">
                <input type="text" name="login" value="{{ old('login') }}" required />
                <label for="">Username</label>
            </div>

            @if ($errors->has('login'))
                <label class="errorSpan">{{ $errors->first('login') }}</label>
            @endif

            <div class="input-group">
                <input type="password" name="password" required />
                <label for="">Password</label>
            </div>

            @if ($errors->has('password'))
                <label class="errorSpan">{{ $errors->first('password') }}</label>
            @endif

            <div class="rememberCheck">
                <label><input type="checkbox">Remember me</label>
            </div>

            <button type="submit" value="LogIn">Sign In</button>

            <div class="social-platform">
                <p>Or sign in with</p>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>




        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome!</h1>
                <p>To stay in touch with us, please log in with your personal information</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details to get started</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>








<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () =>
        container.classList.add('right-panel-active'));

    signInButton.addEventListener('click', () =>
        container.classList.remove('right-panel-active'));


        function check() {
        const loginInput = document.getElementById("loginInput");
        const passwordInput = document.getElementById("passwordInput");
        const errorLoginLabel = document.getElementById("errorLoginLabel");
        const errorPasswordLabel = document.getElementById("errorPasswordLabel");
        let loginError = true;
        let passwordError = true;

        if (loginInput.value.length < 3) {
        errorLoginLabel.innerText = "Login is too short";
        loginError = true;
    } else if (loginInput.value.length > 20) {
        errorLoginLabel.innerText = "Login is too long";
        loginError = true;
    } else {
        errorLoginLabel.innerText = "";
        loginError = false;
    }

        if (passwordInput.value.length < 6) {
        errorPasswordLabel.innerText = "Password is too short";
        passwordError = true;
    } else {
        errorPasswordLabel.innerText = "";
        passwordError = false;
    }
        document.getElementById("button").disabled = loginError || passwordError;
    }
        document.getElementById("loginInput").addEventListener("input", check);
        document.getElementById("passwordInput").addEventListener("input", check);
</script>

