@extends('layout_admin.master')
@section('title', 'Category')
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
            <a class="btn btn-default mt-3 mb-3 bg-secondary text-light" href="{{route('categories.create')}}">Create new category</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <ul class="bg-dark text-light p-2 d-flex flex-column">
                <li class="d-flex pb-3 text-center border-bottom">
                    <div class="col-2">No.</div>
                    <div class="col-6">Name</div>
                    <div class="col-4">Action</div>
                </li>
                @foreach($categories as $category)
                    <li class='d-flex align-items-center text-center p-2' data-toggle="collapse" data-target="{{'#category-' . $category->id}}">
                        <div class="col-2">{{$loop->index + 1}}</div>
                        <div class="col-6">{{$category->name}}({{$category->count_articles ? $category->count_articles : '0'}})</div>
                        <div class="col-4">
                            <a class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if(count($category->child) == 0)
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#confirm{{$category->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                            @component('layout_admin.components.modal_categories')
                                @slot('id')
                                    {{$category->id}}
                                @endslot
                            @endcomponent
                        </div>

                    </li>
                        <?php $parent_index = $loop->index + 1;?>
                        @if(count($category->child) > 0)
                        <li class="collapse" id="{{'category-' . $category->id}}">
                            <ul class="d-flex flex-column bg-light text-dark my-1 py-1 pl-0" >
                                @foreach($category->child as $child)
                                    <li class="d-flex align-items-center text-center pb-1">
                                        <div class="col-2">{{$parent_index . '.' . ($loop->index + 1)}}</div>
                                        <div class="col-6">{{$child->name}}({{$child->articles->count()}})</div>
                                        <div class="col-4">
                                            <a class="btn btn-primary" href="{{route('categories.edit', ['categoryId' => $child->id])}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#confirm{{$child->id}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @component('layout_admin.components.modal_categories')
                                                @slot('id')
                                                    {{$child->id}}
                                                @endslot
                                            @endcomponent
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>


@endsection