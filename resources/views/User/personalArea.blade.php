{{--@extends('layout')--}}

{{--@section('content')--}}

{{--    <div>--}}
{{--        <h2>Available vacancies:</h2>--}}
{{--        <ul>--}}
{{--            @foreach ($positions as $position)--}}
{{--                <li>--}}
{{--                    {{ $position->name }} (Salary: {{ $position->salary }})--}}
{{--                    <form method="GET" action="{{ route('position.showDetails', $position->id) }}" style="display:inline;">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-info btn-sm">More Details</button>--}}
{{--                    </form>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layout')

@section('content')
    <div class="personal-area-container">
        <h2 class="section-title">Available Vacancies:</h2>
        <table class="vacancies-table">
            <thead>
            <tr>
                <th>Job Title</th>
                <th class="center-text">Salary</th>
                <th class="center-text">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($positions as $position)
                <tr>
                    <td class="vacancy-name">
                        <div class="text-left">{{ $position->name }}</div>
                    </td>
                    <td class="vacancy-salary">{{ $position->salary }}</td>
                    <td>
                        <form method="GET" action="{{ route('position.showDetails', $position->id) }}" class="details-form">
                            @csrf
                            <button type="submit" class="btn btn-primary">More Details</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
