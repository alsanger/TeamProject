{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div>--}}
{{--        <form method="post" action="{{ route('position.createPositionPost') }}">--}}
{{--            @csrf--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Name</label></div>--}}
{{--                <input id="nameInput" type="text" name="name" value="{{ old('name') }}" required/>--}}
{{--                @if ($errors->has('name'))--}}
{{--                    <label class="errorLabel">{{ $errors->first('name') }}</label>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Department</label></div>--}}
{{--                <select name="department_id" id="department">--}}
{{--                    <option value="">None</option> <!-- Добавляем пустую опцию -->--}}
{{--                    @foreach($departments as $department)--}}
{{--                        <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Salary</label></div>--}}
{{--                <input type="number" step="0.01" min="0" name="salary" value="{{ old('salary') }}" inputmode="numeric" required/>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="labelDiv"><label>Description</label></div>--}}
{{--                <textarea name="description"></textarea>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <input type="checkbox" name="isVacancy" />Is Vacancy?--}}
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
        <h1>Add a new position:</h1>
        <form method="post" action="{{ route('position.createPositionPost') }}">
            @csrf
            <div class="form-group">
                <label for="nameInput" class="form-label">Name</label>
                <input id="nameInput" type="text" name="name" value="{{ old('name') }}" required class="form-control"/>
                @if ($errors->has('name'))
                    <span class="error-text">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="department" class="form-label">Department</label>
                <select name="department_id" id="department" class="form-control">
                    <option value="">None</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="salary" class="form-label">Salary</label>
                <input id="salary" type="number" step="0.01" min="0" name="salary" value="{{ old('salary') }}" inputmode="numeric" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="checkbox" name="isVacancy" id="isVacancy" class="form-check"/>
                <label for="isVacancy" class="form-check-label">Is Vacancy?</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
