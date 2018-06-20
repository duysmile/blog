@extends('layout_admin.master')
@section('title', 'Category')
@section('content')
    <div class="row pt-2">
        @if($message = Session::get('success'))
            <div class="alert alert-success col-sm-12">
                {{$message}}
            </div>
        @endif
    </div>
    <a class="btn btn-default mt-3 mb-3 bg-secondary text-light" href="{{route('categories.create')}}">Create new cateogry</a>
    <ul class="bg-dark text-light p-2">
        <li class="row pb-3 text-center">
            <div class="col-2">No.</div>
            <div class="col-6">Name</div>
            <div class="col-4">Action</div>
        </li>
        @foreach($categories as $category)
            <li class='row d-flex align-items-center text-center pb-1' data-toggle="collapse" data-target="{{'#category-' . $category->id}}">
                <div class="col-2">{{$loop->index + 1}}</div>
                <div class="col-6">{{$category->name}}</div>
                <div class="col-4">
                    <a class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if(count($category->child) == 0)
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#confirm{{$category->id}}">
                            <i class="fa fa-trash"></i>
                        </a>
                    @endif
                    <div class="modal fade" id="confirm{{$category->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title text-dark">Confirm Delete</p>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form class="d-inline" method="post" action="{{route('categories.destroy', $category->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <p class="text-dark">
                                            Are you sure to delete this?
                                        </p>
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                        <button type="button" data-dismiss="modal" class="btn btn-primary">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li>
                @if(count($category->child) > 0)
                    <ul class="nav flex-column bg-light text-dark collapse mt-1 mb-1" id="{{'category-' . $category->id}}">
                        @foreach($category->child as $child)
                            <li class="row d-flex align-items-center text-center pb-1">
                                <div class="col-2">{{'c' . ($loop->index + 1)}}</div>
                                <div class="col-6">{{$child->name}}</div>
                                <div class="col-4">
                                    <a class="btn btn-primary" href="{{route('categories.edit', ['categoryId' => $child->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#confirm{{$child->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <div class="modal fade" id="confirm{{$child->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="modal-title text-dark">Confirm Delete</p>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="d-inline" method="post" action="{{route('categories.destroy', $child->id)}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <p class="text-dark">
                                                            Are you sure to delete this?
                                                        </p>
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-primary">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endsection