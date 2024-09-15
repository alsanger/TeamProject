{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <form method="post" action="{{ route('position.createRolePost') }}">--}}
{{--            @csrf--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Name</label></div>--}}
{{--                <input id="nameInput" type="text" name="name" required/>--}}
{{--                @if ($errors->has('name'))--}}
{{--                    <label class="errorLabel">{{ $errors->first('name') }}</label>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <input id="button" type="submit" name="create" value="Create"/>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layout')

@section('content')
    <div class="login-text">
        <h1>Add a new role:</h1>
        <form method="post" action="{{ route('position.createRolePost') }}">
            @csrf
            <div class="form-group">
                <label for="nameInput" class="form-label">Name</label>
                <input id="nameInput" type="text" name="name" required class="form-control"/>
                @if ($errors->has('name'))
                    <span class="error-text">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
