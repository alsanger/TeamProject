{{--@extends('layouts.app')--}}

{{--@section('content')--}}
<label>PERSONAL AREA</label>
@auth
    <div class="user-info">
        <p>Welcome, {{ auth()->user()->first_name }} (ID: {{ auth()->user()->id }})</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to home page</a>
        <a href="{{ route('user.personalArea') }}" class="btn btn-primary">Back to main personal area</a>
        <div class="container">
            <h1>Edit User</h1>

            @if($errors->any())
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

                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password (leave blank to keep current password)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group" style="display: inline">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                </div>

                <div class="form-group">
                    <label for="image_link">Image Link</label>
                    <input type="text" class="form-control" id="image_link" name="image_link" value="{{ $user->image_link }}" required>
                </div>

                <div class="form-group">
                    <label for="knowledge_ids">Knowledges</label>
                    @foreach ($knowledges as $knowledge)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="knowledge_{{ $knowledge->id }}" name="knowledge_ids[]" value="{{ $knowledge->id }}" {{ $user->knowledges->contains($knowledge->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="knowledge_{{ $knowledge->id }}">{{ $knowledge->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@else
    <div class="actions">
        <p>This page is only available to authorized users</p>
        <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
    </div>
@endauth
{{--@endsection--}}
