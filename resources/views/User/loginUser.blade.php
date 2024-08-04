@extends('layout')

@section('content')
    <form method="get" action="{{ route('user.createUserGet') }}">
        <button>CREATE NEW USER</button>
    </form>
    <br>
    <div>
        <form method="post" action="{{ route('user.loginUserPost') }}">
            @csrf
            <div>
                <div class="labelDiv"><label>Login</label></div>
                <input type="text" name="login" value="{{ old('login') }}" required/>
                @if ($errors->has('login'))
                    <label class="errorSpan">{{ $errors->first('login') }}</label>
                @endif
            </div>
            <div>
                <div class="labelDiv"><label>Password</label></div>
                <input type="password" name="password" required/>
                @if ($errors->has('password'))
                    <label class="errorSpan">{{ $errors->first('password') }}</label>
                @endif
            </div>
            <div>
                <input id="button" type="submit" value="LogIn"/>
            </div>
        </form>
    </div>
@endsection
