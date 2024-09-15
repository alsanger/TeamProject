{{--@extends('layout')--}}

{{--@section('content')--}}
{{--    <label>VACANCY DETAILS</label>--}}
{{--    <div class="position-info">--}}
{{--        <div class="container">--}}
{{--            <h1>VACANCY:</h1>--}}
{{--            <ul>--}}
{{--                <li><strong>Name:</strong> {{ $position->name }}</li>--}}
{{--                <li><strong>Department:</strong> {{ $position->department ? $position->department->name : 'N/A' }}</li>--}}
{{--                <li><strong>Salary:</strong> {{ $position->salary }}</li>--}}
{{--                <li><strong>Description:</strong> {{ $position->description }}</li>--}}
{{--                @auth--}}
{{--                    @if($status == null)--}}
{{--                        <h2>Write a resume and apply</h2>--}}
{{--                        <form method="POST" action="{{ route('position.seekerStatusSet') }}" style="display:inline;">--}}
{{--                            @csrf--}}
{{--                            <textarea name="resume" placeholder="Write your resume here"></textarea>--}}
{{--                            <input type="hidden" name="position_id" value="{{ $position->id }}">--}}
{{--                            <button type="submit" class="btn btn-info btn-sm">Submit an application</button>--}}
{{--                        </form>--}}
{{--                    @elseif($status == 'seeker')--}}
{{--                        <h2>You are registered as a candidate for this position. Your candidacy will be transferred to candidate status or rejected shortly. Please wait.</h2>--}}
{{--                    @elseif($status == 'candidate')--}}
{{--                        <form method="POST" action="{{ route('position.goToChat') }}" style="display:inline;">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">--}}
{{--                            <input type="hidden" name="position_id" value="{{ $position->id }}">--}}
{{--                            <button type="submit" class="btn btn-info btn-sm">Go to chat</button>--}}
{{--                        </form>--}}
{{--                    @elseif($status == 'rejected')--}}
{{--                        <h2>Sorry, but your application for this position has been rejected.</h2>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layout')

@section('content')
    <div class="container position-details">
        <h1>VACANCY DETAILS</h1>
        <div class="position-info">
            <ul>
                <li><strong>Name:</strong> {{ $position->name }}</li>
                <li><strong>Department:</strong> {{ $position->department ? $position->department->name : 'N/A' }}</li>
                <li><strong>Salary:</strong> {{ $position->salary }}</li>
                <li><strong>Description:</strong> {{ $position->description }}</li>
                @auth
                    @if($status == null)
                        <h2>Write a resume and apply</h2>
                        <form method="POST" action="{{ route('position.seekerStatusSet') }}">
                            @csrf
                            <textarea name="resume" placeholder="Write your resume here"></textarea>
                            <input type="hidden" name="position_id" value="{{ $position->id }}">
                            <button type="submit" class="btn btn-primary">Submit an application</button>
                        </form>
                    @elseif($status == 'seeker')
                        <h2>You are registered as a candidate for this position. Your candidacy will be transferred to candidate status or rejected shortly. Please wait.</h2>
                    @elseif($status == 'candidate')
                        <form method="POST" action="{{ route('position.goToChat') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="position_id" value="{{ $position->id }}">
                            <button type="submit" class="btn btn-primary">Go to chat</button>
                        </form>
                    @elseif($status == 'rejected')
                        <h2>Sorry, but your application for this position has been rejected.</h2>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
@endsection
