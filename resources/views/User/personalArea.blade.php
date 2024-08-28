@extends('layout')

@section('content')

    <div>
        <h2>Available vacancies:</h2>
        <ul>
            @foreach ($positions as $position)
                <li>
                    {{ $position->name }} (Salary: {{ $position->salary }})
                    <form method="GET" action="{{ route('position.showDetails', $position->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm">More Details</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
