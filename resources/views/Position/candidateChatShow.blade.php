@extends('layout')

@section('content')
    <h1>Chat for Position: {{ $position->name }}</h1>
    <p>User Position ID: {{ $userPosition->id }}</p>
    <p>Status ID: {{ $userPosition->status_id }}</p>
    <p>Resume: {{ $userPosition->resume }}</p>
@endsection
