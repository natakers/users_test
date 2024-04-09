@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <h6 class="alert alert-success">{{ session('status') }}</h6>
    @endif
    <div class="card-header">
        <h4>Edit & Update User
            <a href="{{ url('home') }}" class="btn btn-danger float-end">BACK</a>
        </h4>
    </div>
    <form action="{{ url('update/'.$user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="">Name</label>
            <input type="text" name="name" value="{{$user->name}}"  class="form-control @error('name') is-invalid @enderror" required autocomplete="name">
        </div>
        <div class="form-group mb-3">
            <label for="">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">
        </div>
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
