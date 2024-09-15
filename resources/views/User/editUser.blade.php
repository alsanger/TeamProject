{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <label>PERSONAL AREA</label>--}}
{{--    @auth--}}
{{--        <div class="user-info">--}}
{{--            <div class="container">--}}
{{--                <h1>Edit User</h1>--}}

{{--                @if($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <form method="POST" action="{{ route('user.editUserPost') }}">--}}
{{--                    @csrf--}}
{{--                    @method('PUT')--}}
{{--                    <input type="hidden" name="user_id" value="{{ $user->id }}">--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="login">Login</label>--}}
{{--                        <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="password">Password (leave blank to keep current password)</label>--}}
{{--                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">--}}
{{--                    </div>--}}

{{--                    <div class="form-group" style="display: inline">--}}
{{--                        <label for="password_confirmation">Confirm Password</label>--}}
{{--                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="first_name">First Name</label>--}}
{{--                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="last_name">Last Name</label>--}}
{{--                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="email">Email</label>--}}
{{--                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="phone">Phone</label>--}}
{{--                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="image_link">Image Link</label>--}}
{{--                        <input type="text" class="form-control" id="image_link" name="image_link" value="{{ $user->image_link }}" required>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="knowledge_ids">Knowledges</label>--}}
{{--                        @foreach ($knowledges as $knowledge)--}}
{{--                            <div class="form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="knowledge_{{ $knowledge->id }}" name="knowledge_ids[]" value="{{ $knowledge->id }}" {{ $user->knowledges->contains($knowledge->id) ? 'checked' : '' }}>--}}
{{--                                <label class="form-check-label" for="knowledge_{{ $knowledge->id }}">{{ $knowledge->name }}</label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">--}}
{{--                    <button type="submit" class="btn btn-primary">Update Profile</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="actions">--}}
{{--            <p>This page is only available to authorized users</p>--}}
{{--            <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>--}}
{{--        </div>--}}
{{--    @endauth--}}
{{--@endsection--}}





{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div class="form-container">--}}
{{--        <div class="form-area">--}}
{{--            <div class="form-block">--}}
{{--                <!-- Основные поля редактирования данных -->--}}
{{--                <div class="form-column">--}}
{{--                    <div class="login-form">--}}
{{--                        <form method="post" action="{{ route('user.editUserPost', $user->id) }}">--}}
{{--                            @csrf--}}
{{--                            @method('PUT') <!-- Метод для обновления данных -->--}}
{{--                            <h1 class="form-title">Edit personal data:</h1>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="login">Login</label>--}}
{{--                                <input id="loginInput" type="text" name="login" value="{{ old('login', $user->login) }}" placeholder="3-20 symbols" required class="form-control"/>--}}
{{--                                @if ($errors->has('login'))--}}
{{--                                    <span class="error-text">{{ $errors->first('login') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="password">Password</label>--}}
{{--                                <input id="passwordInput" type="password" name="password" placeholder="6 or more symbols" class="form-control"/>--}}
{{--                                @if ($errors->has('password'))--}}
{{--                                    <span class="error-text">{{ $errors->first('password') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="first_name">First Name</label>--}}
{{--                                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required class="form-control"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="last_name">Last Name</label>--}}
{{--                                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required class="form-control"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="email">Email</label>--}}
{{--                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="phone">Phone</label>--}}
{{--                                <input type="number" name="phone" value="{{ old('phone', $user->phone) }}" required class="form-control"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="image_link">Image Link</label>--}}
{{--                                <input type="text" name="image_link" value="{{ old('image_link', $user->image_link) }}" required class="form-control"/>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <button id="button" type="submit" class="btn btn-primary">Save Changes</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Область Knowledges -->--}}
{{--                <div class="knowledges-column">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Knowledges</label>--}}
{{--                        @foreach($knowledges as $knowledge)--}}
{{--                            <div class="form-check">--}}
{{--                                <input type="checkbox" name="knowledge_ids[]" value="{{ $knowledge->id }}"--}}
{{--                                    {{ in_array($knowledge->id, old('knowledge_ids', $user->knowledges->pluck('id')->toArray())) ? 'checked' : '' }} />--}}
{{--                                <label>{{ $knowledge->name }}</label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        function check() {--}}
{{--            const loginInput = document.getElementById("loginInput");--}}
{{--            const passwordInput = document.getElementById("passwordInput");--}}
{{--            const errorLoginLabel = document.getElementById("errorLoginLabel");--}}
{{--            const errorPasswordLabel = document.getElementById("errorPasswordLabel");--}}
{{--            let loginError = true;--}}
{{--            let passwordError = true;--}}

{{--            if (loginInput.value.length < 3) {--}}
{{--                errorLoginLabel.innerText = "Login is too short";--}}
{{--                loginError = true;--}}
{{--            } else if (loginInput.value.length > 20) {--}}
{{--                errorLoginLabel.innerText = "Login is too long";--}}
{{--                loginError = true;--}}
{{--            } else {--}}
{{--                errorLoginLabel.innerText = "";--}}
{{--                loginError = false;--}}
{{--            }--}}

{{--            if (passwordInput.value.length && passwordInput.value.length < 6) {--}}
{{--                errorPasswordLabel.innerText = "Password is too short";--}}
{{--                passwordError = true;--}}
{{--            } else {--}}
{{--                errorPasswordLabel.innerText = "";--}}
{{--                passwordError = false;--}}
{{--            }--}}
{{--            document.getElementById("button").disabled = loginError || passwordError;--}}
{{--        }--}}
{{--        document.getElementById("loginInput").addEventListener("input", check);--}}
{{--        document.getElementById("passwordInput").addEventListener("input", check);--}}
{{--    </script>--}}
{{--@endsection--}}



@extends('layout')

@section('content')
    <div class="form-container">
        <div class="form-area">
            <div class="form-block">
                <!-- Основные поля редактирования данных -->

                <div class="form-column">
                    <div class="login-form">
                        <h1>Edit personal data:</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('user.editUserPost') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" required>
                                @if ($errors->has('login'))
                                    <span class="error-text">{{ $errors->first('login') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password (leave blank to keep current password)</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <span class="error-text">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group" style="display: inline">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>--}}
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image_link">Image Link</label>
                                <input type="text" class="form-control" id="image_link" name="image_link" value="{{ $user->image_link }}" required>
                            </div>
                            <div class="form-group">
                                <button id="button" type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                            <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">
                        </form>
                    </div>
                </div>
                <!-- Область Knowledges -->
                <div class="knowledges-column">
                    <div class="form-group">
                        <label>Knowledges</label>
                        @foreach($knowledges as $knowledge)
                            <div class="form-check">
                                <input type="checkbox" id="knowledge_{{ $knowledge->id }}" name="knowledge_ids[]" value="{{ $knowledge->id }}"
                                    {{ in_array($knowledge->id, old('knowledge_ids', $user->knowledges->pluck('id')->toArray())) ? 'checked' : '' }} />
                                <label for="knowledge_{{ $knowledge->id }}">{{ $knowledge->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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

            if (passwordInput.value.length && passwordInput.value.length < 6) {
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
@endsection

