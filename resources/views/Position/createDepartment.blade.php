{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <div>--}}
{{--            <a href="{{ route('workArea.administrator') }}" class="btn btn-primary">Back to WORK AREA</a>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <form method="post" action="{{ route('position.createDepartmentPost') }}">--}}
{{--                @csrf--}}
{{--                <div>--}}
{{--                    <div class="labelDiv"><label>Name</label></div>--}}
{{--                    <input id="nameInput" type="text" name="name" required/>--}}
{{--                    @if ($errors->has('name'))--}}
{{--                        <label class="errorLabel">{{ $errors->first('name') }}</label>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <input id="button" type="submit" name="create" value="Create"/>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layout')

@section('content')
    <div class="login-text">
            <form method="post" action="{{ route('position.createDepartmentPost') }}">
                @csrf
                <div class="form-group">
                    <h1>Add a new department:</h1>
                    <label for="nameInput">Name:</label>
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

