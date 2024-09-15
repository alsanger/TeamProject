{{--@extends('layout')--}}

{{--@section('content')--}}
{{--            <div class="login-text">--}}
{{--                <form method="post" action="{{ route('user.loginUserPost') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="login">Login</label>--}}
{{--                        <input type="text" id="login" name="login" value="{{ old('login') }}" required class="form-control"/>--}}
{{--                        @if ($errors->has('login'))--}}
{{--                            <span class="error-text">{{ $errors->first('login') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="password">Password</label>--}}
{{--                        <input type="password" id="password" name="password" required class="form-control"/>--}}
{{--                        @if ($errors->has('password'))--}}
{{--                            <span class="error-text">{{ $errors->first('password') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <button type="submit" class="btn btn-primary">Log In</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--@endsection--}}


@extends('layout')

@section('content')
    <div class="login-text">

        <div class="form-area">
            <div class="login-form">
                <h1 class="form-title">Login user:</h1>
                <form method="post" action="{{ route('user.loginUserPost') }}">
                    @csrf

                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" value="{{ old('login') }}" required class="form-control"/>
                        @if ($errors->has('login'))
                            <span class="error-text">{{ $errors->first('login') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required class="form-control"/>
                        @if ($errors->has('password'))
                            <span class="error-text">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
