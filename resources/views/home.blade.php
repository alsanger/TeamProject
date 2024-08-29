@extends('layout')

@section('content')
    <div class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to our job search website!</h1>
            <p class="hero-description">Find your ideal job with just a few clicks. Our site offers a wide range of job listings in various fields, so you can find what suits you best.</p>
            <a href="{{ route('user.createUserGet') }}" class="btn btn-start">Get Started</a>
        </div>
    </div>
    <div class="features">
        <h2>Our Advantages</h2>
        <div class="feature-item">
            <h3>Wide Range of Job Listings</h3>
            <p>We offer job listings in various sectors, allowing you to find your dream job.</p>
        </div>
        <div class="feature-item">
            <h3>Easy-to-Use Interface</h3>
            <p>Our website is easy to use, and you can quickly find what you're looking for.</p>
        </div>
        <div class="feature-item">
            <h3>User Support</h3>
            <p>Our team is always ready to assist you if you have any questions.</p>
        </div>
    </div>
@endsection
