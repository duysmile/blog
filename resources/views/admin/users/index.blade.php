@extends('layout_admin.master')
@section('title', 'User')
@section('content')
    <div class="row pt-2">
        @if($message = Session::get('success'))
            <div class="alert alert-success col-sm-12">
                {{$message}}
            </div>
        @endif
    </div>
    <a class="btn btn-secondary text-light" href="{{route('users.create')}}">Create a user</a>
    <ul class="bg-dark mt-3 p-2">
        <li class="row text-center text-light">
            <div class="col-1">
                No.
            </div>
            <div class="col-2">
                Name
            </div>
            <div class="col-3">
                Email
            </div>
            <div class="col-2">
                Role
            </div>
            <div class="col-2">
                Status
            </div>
            <div class="col-2">
                Action
            </div>
        </li>
        @foreach($users as $user)
            <li class="row text-center text-light pt-2 pb-1">
                <div class="col-1">
                    {{$loop->index + 1}}
                </div>
                <div class="col-2">
                    {{$user->name}}
                </div>
                <div class="col-3">
                    {{$user->email}}
                </div>
                <div class="col-2">
                    @foreach($user->roles as $role)
                    {{$role->name}}
                    @endforeach
                </div>
                <div class="col-2">
                    @if($user->status)
                        <span class="bg-success p-1">Enable</span>
                    @else
                        <span class="bg-danger p-1">Lock</span>
                    @endif
                </div>
                <div class="col-2">
                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form class="d-inline" method="post" action="{{route('users.destroy', $user->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection