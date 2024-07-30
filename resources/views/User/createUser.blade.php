{{--@extends('layout')--}}

{{--@section('content')--}}
<form method="get" action="{{ route('user.loginUserGet') }}">
    <button>LOGIN</button>
</form>
<br>
<div>
    <form method="post" action="{{ route('user.createUserPost') }}">
        @csrf
        <div>
            <div class="labelDiv"><label>Login</label></div>
            <input id="loginInput" type="text" name="login" placeholder="3-20 symbols" value="{{ old('login') }}" required/>
            @if ($errors->has('login'))
                <label class="errorLabel">{{ $errors->first('login') }}</label>
            @endif
        </div>
        <div>
            <div class="labelDiv"><label>Password</label></div>
            <input id="passwordInput" type="password" name="password" placeholder="6 or more symbols" required/>
            @if ($errors->has('password'))
                <label class="errorLabel">{{ $errors->first('password') }}</label>
            @endif
        </div>
        <div>
            <div class="labelDiv"><label>First Name</label></div>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required/>
        </div>
        <div>
            <div class="labelDiv"><label>Last Name</label></div>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required/>
        </div>
        <div>
            <div class="labelDiv"><label>Email</label></div>
            <input type="email" name="email" value="{{ old('email') }}" required/>
        </div>
        <div>
            <div class="labelDiv"><label>Phone</label></div>
            <input type="number" name="phone" value="{{ old('phone') }}" required/>
        </div>
        <div>
            <div class="labelDiv"><label>Image Link</label></div>
            <input type="text" name="image_link" value="{{ old('image_link') }}" required/>
        </div>
        <div>
            <div class="labelDiv"><label>Knowledges</label></div>
            @foreach($knowledges as $knowledge)
                <div>
                    <input type="checkbox" name="knowledge_ids[]" value="{{ $knowledge->id }}"
                        {{ in_array($knowledge->id, old('knowledge_ids', [])) ? 'checked' : '' }} />
                    <label>{{ $knowledge->name }}</label>
                </div>
            @endforeach
        </div>
        <div>
            <input id="button" type="submit" name="register" value="Register"/>
        </div>
    </form>
</div>

<script>
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
{{--@endsection--}}
