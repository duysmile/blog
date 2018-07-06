@extends('layout_admin.master')
@section('title', 'User')
@section('content')
    <div class="row pt-2">
        @if($message = Session::get('success'))
            <div class="alert alert-success col-12">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{$message}}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary text-light" href="{{route('users.create')}}">Create a user</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="bg-dark mt-3 p-2 d-flex flex-column">
                <li class="d-flex text-center pb-2 text-light border-bottom">
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
                    <li class="d-flex align-items-center text-center text-light py-2">
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
                            <a href="" class="btn btn-danger" data-toggle="modal", data-target="#confirm{{$user->id}}">
                                <i class="fa fa-trash"></i>
                            </a>

                        </div>

                        @component('layout_admin.components.modal_categories')
                            @slot('id')
                                {{$user->id}}
                            @endslot
                        @endcomponent
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{$users->links('layout_admin.pagination')}}
@endsection