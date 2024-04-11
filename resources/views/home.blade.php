@extends('layouts.app')

@section('content')
<div class="container">
    @vite('resources/js/app.js')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table>
                    @foreach($users as $user)
                    <tr data-id={{$user->id}}>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="d-flex justify-content-around">
                            @if (!($user->name == 'admin' && $user->id == 1))
                            <button data-id={{$user->id}} type="button" class="btn btn-primary edit">
                                Edit
                            </button>
                            <button class="delete btn btn-danger" data-id={{$user->id}}>Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div>
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        @if ($users->currentPage() == $i)
                        <button class="btn btn-primary page" data-page={{$i}}>{{$i}}</button>
                        @else
                        <button class="btn btn-light page" data-page={{$i}}>{{$i}}</button>
                        @endif
                        @endfor
                </div>
            </div>
        </div>
    </div>
    @include('edit')
</div>
@endsection