<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins' , sans-serif;
        }

        body
        {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #f64f59, #c471ed, #12c2e9);
        }

        .wrapper
        {
            position: relative;
            width: 400px;
            height: 500px;
            background: rgba(255,255,255, .2);
            border-radius: 20px;
            box-shadow: 0 0 50px rgba(0,0,0, .1);
            padding: 40px;


        }

        .form-wrapper
        {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            transition: 1s ease-in-out;
        }

        .wrapper.active .form-wrapper.sign-in
        {
            transform: scale(0) translate(-300px, 500px);
        }

        .wrapper .form-wrapper.sign-up
        {
            position: absolute;
            top: 0;
            transform: scale(0)translate(200px, -500px);
        }

        .wrapper.active .form-wrapper.sign-up
        {
            transform: scale(1)translate(0,0) ;
        }

        h2
        {
            font-size: 30px;
            color: #ffffff;
            text-align: center;
        }

        .input-group
        {
            position: relative;
            margin: 30px 0;
            border-bottom: 2px solid #ffffff;
        }

        .input-group label
        {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #ffffff;
            pointer-events: none;
            transition: .5s;
        }



        .input-group input
        {
            width: 320px;
            height: 40px;
            font-size: 16px;
            color: #ffffff;
            padding: 0 5px;
            background: transparent;
            border: none;
            outline:  none;
        }

        .input-group input:focus~label,
        .input-group input:valid~label
        {
            top: -5px;
        }

        .rememberCheck
        {
            margin: -5px 0 15px 5px;
        }

        .rememberCheck label
        {
            color: #ffffff;
            font-size: 14px;
        }

        .rememberCheck input
        {
            accent-color: #f4157e;
        }

        button
        {
            position: relative;
            width: 100%;
            height: 40px;
            background: #f4157e;
            font-size: 16px;
            color: #ffffff;
            cursor: pointer;
            border-radius: 30px;
            border: none;
            outline: none;
        }

        .signUp-link
        {
            font-size: 14px;
            text-align: center;
            margin: 15px 0;
        }

        .signUp-link p
        {
            color: #ffffff;
        }

        .signUp-link p a
        {
            color: #f4157e;
            text-decoration:  none;
            font-weight: 500;
        }
        .signUp-link p a:hover
        {
            text-decoration: underline;
        }

        .social-platform
        {
            font-size: 14px;
            color: #ffffff;
            text-align: center;
        }

        .social-icons a
        {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: transparent;
            border: 1px solid #ffffff;
            border-radius: 50%;
            text-align: center;
            line-height: 35px;

            margin: 15px 6px 0;
            transition: .3s;
        }

        .social-icons a:hover
        {
            background: #ffffff;
        }

        .social-icons a i
        {
            color: #ffffff;
            font-size: 14px;
            transition: .3s;
        }

        .social-icons a:hover
        {
            color: rgba(0,0,0, .3);
        }


    </style>

</head>
<body>

<div class="wrapper">
    <!-- Sign In Form -->
    <div class="form-wrapper sign-in">
        <form method="post" action="{{ route('user.loginUserPost') }}">
            @csrf
            <h2>Sign in</h2>

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

            <div class="signUp-link">
                <p>Don't have an account? <a href="#" class="signUpBtn-link">Sign Up</a></p>
            </div>

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

    <!-- Sign Up Form -->
    <div class="form-wrapper sign-up">
        <form method="post" action="{{ route('user.createUserPost') }}">
            @csrf
            <h2>Sign Up</h2>

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
                <input type="email" name="email" value="{{ old('email') }}" required />
                <label for="emailInput">Email</label>
            </div>

            <div class="rememberCheck">
                <label><input type="checkbox">I agree to the terms & conditions </label>
            </div>

            <button id="button" type="submit">Sign Up</button>

            <div class="signUp-link">
                <p>Already have an account? <a href="#" class="signInBtn-link">Sign In</a></p>
            </div>
        </form>
    </div>
</div>



<script>
    const signUpBtnLink = document.querySelector('.signUpBtn-link');
    const signInBtnLink = document.querySelector('.signInBtn-link');

    const wrapper = document.querySelector('.wrapper');

    signUpBtnLink.addEventListener('click', () => {
        wrapper.classList.toggle('active');
    });

    signInBtnLink.addEventListener('click', () => {
        wrapper.classList.toggle('active');
    });




    function check()
    {
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

</body>
</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">







