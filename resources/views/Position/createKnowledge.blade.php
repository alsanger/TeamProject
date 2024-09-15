{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <a href="{{ route('workArea.administrator') }}" class="btn btn-primary">Back to WORK AREA</a>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <form method="post" action="{{ route('position.createKnowledgePost') }}">--}}
{{--            @csrf--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Name</label></div>--}}
{{--                <input id="nameInput" type="text" name="name" value="{{ old('name') }}" required/>--}}
{{--                @if ($errors->has('name'))--}}
{{--                    <label class="errorLabel">{{ $errors->first('name') }}</label>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Description</label></div>--}}
{{--                <textarea name="description"></textarea>--}}
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
        <h1>Add a new knowledge:</h1>
        <form method="post" action="{{ route('position.createKnowledgePost') }}">
            @csrf
            <div class="form-group">
                <label for="nameInput" class="form-label">Name</label>
                <input id="nameInput" type="text" name="name" value="{{ old('name') }}" required class="form-control"/>
                @if ($errors->has('name'))
                    <span class="error-text">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
