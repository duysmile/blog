@extends('layout_admin.master')
@section('title', 'Update User')
@section('content')
    <div class="d-flex align-items-center justify-content-center">
        <div class="w-50 p-3 m-3 bg-light">
            <form action="{{route('update_profile')}}" method="post">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>
                        </div><br />
                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>
                                    {{$message}}
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="">Current Password</label>
                    <input type="password" class="form-control" name="current_password">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="">Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('admin')}}" class="btn text-light btn-danger">Cancel</a>
                </div>
            </form>
        </div>

    </div>
@endsection