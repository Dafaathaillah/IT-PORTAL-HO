@extends('errors::minimal')

@section('title', 'Page Not Found')

@section('message')
    <div class="container text-center">
        <h1 class="display-4">404 - Page Not Found</h1>
        <p>Sorry, the page you are looking for could not be found.</p>
        
        <!-- Custom button that redirects to the homepage -->
        <a href="{{ url('/') }}" class="btn btn-primary">
            Go Back to Home
        </a>

    </div>
@endsection

<style>
    .container {
        padding: 50px;
    }
    .btn {
        font-size: 16px;
        padding: 10px 20px;
        margin-top: 20px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>