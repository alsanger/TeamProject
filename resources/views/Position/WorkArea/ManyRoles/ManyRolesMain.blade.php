@extends('layout')

@section('content')
    <div class="container">
        <h1>Multiple Roles</h1>
        <p>You have multiple roles. Please select one to proceed.</p>

        <div class="row">
            @foreach ($roles as $role)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('workArea.' . $role) }}" class="btn btn-primary btn-block">
                        {{ ucfirst($role) }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
