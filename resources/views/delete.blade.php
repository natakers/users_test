@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="card-header">
            <h4>Delete user
                <a href="{{ url('home') }}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        <form action="{{ url('destroy/'.$user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="form-group mb-3">
                <h5>Delete user {{$user->name}}?</h5>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>

        </form>
    </div>
@endsection
