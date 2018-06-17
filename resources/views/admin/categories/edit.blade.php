@extends('layout_admin.master')
@section('title', 'Edit Category')

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
        <form class="col-12" method="post" action="{{route('categories.update', $category->id)}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
            </div>
            @if($category->id_parent !== null)
            <div class="form-group">
                <label for="parent">Category Parent</label>
            </div>

            <div id="category-parent" class="form-group">
                <select name="id_parent" class="form-control">
                    @foreach($categoryParent as $parent)
                        <option value="{{$parent->id}}"
                            @if($parent->id === $category->id_parent)
                                selected
                            @endif >
                            {{$parent->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('categories.index')}}" class="btn btn-default bg-light">
                Back
            </a>
        </form>
    </div>
@endsection