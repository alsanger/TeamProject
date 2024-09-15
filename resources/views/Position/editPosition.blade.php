{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h1>Edit Position</h1>--}}

{{--        @if($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form action="{{ route('position.editPositionPost') }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <input type="hidden" name="position_id" value="{{ $position->id }}">--}}

{{--            <div class="form-group">--}}
{{--                <label for="name">Name</label>--}}
{{--                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $position->name) }}" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="department">Department</label>--}}
{{--                <select id="department" name="department_id" class="form-control">--}}
{{--                    <option value="">N/A</option>--}}
{{--                    @foreach($departments as $department)--}}
{{--                        <option value="{{ $department->id }}" {{ old('department_id', $position->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="salary">Salary</label>--}}
{{--                <input type="number" step="0.01" id="salary" name="salary" class="form-control" value="{{ old('salary', $position->salary) }}">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="description">Description</label>--}}
{{--                <textarea id="description" name="description" class="form-control">{{ old('description', $position->description) }}</textarea>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="is_vacancy">Is Vacancy</label>--}}
{{--                <input type="hidden" name="is_vacancy" value="0">--}}
{{--                <input type="checkbox" id="is_vacancy" name="is_vacancy" value="1" {{ old('is_vacancy', $position->is_vacancy) ? 'checked' : '' }}>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label>Roles</label>--}}
{{--                @foreach($roles as $role)--}}
{{--                    <div class="form-check">--}}
{{--                        <input type="checkbox" class="form-check-input" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $position->roles->pluck('id')->toArray())) ? 'checked' : '' }}>--}}
{{--                        <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Update Position</button>--}}
{{--        </form>--}}

{{--    </div>--}}
{{--@endsection--}}


@extends('layout')

@section('content')
    <div class="form-container">

        <div class="form-area">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('position.editPositionPost') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="position_id" value="{{ $position->id }}">

                <h1 class="form-title">Edit Position:</h1>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="nameInput" type="text" name="name" value="{{ old('name', $position->name) }}" required class="form-control"/>
                    @if ($errors->has('name'))
                        <span class="error-text">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <select id="department" name="department_id" class="form-control">
                        <option value="">N/A</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id', $position->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input id="salaryInput" type="number" step="0.01" name="salary" value="{{ old('salary', $position->salary) }}" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $position->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="is_vacancy">Is Vacancy</label>
                    <input type="hidden" name="is_vacancy" value="0">
                    <input id="is_vacancy" type="checkbox" name="is_vacancy" value="1" {{ old('is_vacancy', $position->is_vacancy) ? 'checked' : '' }}>
                </div>

                <div class="form-group">
                    <label><br/>Roles</label>
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $position->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
<br/>
                <button type="submit" class="btn btn-primary">Update Position</button>
            </form>
        </div>
    </div>
@endsection
