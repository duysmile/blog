@extends('layout_admin.master')
@section('title', 'Create Category')

@section('content')
    <div class="row pt-3 pb-3">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
        </div>
        <form class="col-12" method="post" action="{{route('categories.store')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="parent">Category Parent</label>
                <label class="switch">
                    <input type="checkbox" id="parent" data-toggle="collapse" name="isChild" data-target="#category-parent">
                    <span class="slider round"></span>
                </label>
            </div>

            <div id="category-parent" class="form-group collapse">
                <select name="id_parent" class="form-control">
                    @foreach($categoryParent as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('categories.index')}}" class="btn btn-default bg-light">
                Back
            </a>
        </form>
    </div>
@endsection