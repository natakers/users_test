@extends('layouts.app')

@section('content')
<div class="container">
  @vite('resources/js/app.js')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <table>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>&nbsp;</th>
          </tr>
          @foreach($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              @if (!($user->name == 'admin' && $user->id == 1))
              <a href="{{ url('edit/' .$user->id) }}"><button class="edit" data-edit={{$user->id}}>Edit</button></a>
              <a href="{{ url('delete/' .$user->id) }}"><button class="delete" data-delete={{$user->id}}>Delete</button></a>
              @endif

            </td>
          </tr>
          @endforeach

        </table>
        {{ $users->links() }}
      </div>
    </div>
  </div>

</div>


@endsection