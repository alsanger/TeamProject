@extends('layout')

@section('content')
    <div>
        <form method="post" action="{{ route('position.createPositionPost') }}">
            @csrf
            <div>
                <div class="labelDiv"><label>Name</label></div>
                <input id="nameInput" type="text" name="name" value="{{ old('name') }}" required/>
                @if ($errors->has('name'))
                    <label class="errorLabel">{{ $errors->first('name') }}</label>
                @endif
            </div>
            <div>
                <div class="labelDiv"><label>Department</label></div>
                <select name="department_id" id="department">
                    <option value="">None</option> <!-- Добавляем пустую опцию -->
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div class="labelDiv"><label>Salary</label></div>
                <input type="number" step="0.01" min="0" name="salary" value="{{ old('salary') }}" inputmode="numeric" required/>
            </div>
            <div>
                <div class="labelDiv"><label>Description</label></div>
                <textarea name="description"></textarea>
            </div>
            <div>
                <input type="checkbox" name="isVacancy" />Is Vacancy?
            </div>
            <div>
                <input id="button" type="submit" name="create" value="Create"/>
            </div>
        </form>
    </div>
@endsection
