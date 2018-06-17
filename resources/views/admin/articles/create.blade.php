@extends('layout_admin.master')
@section('title', 'Create Article')

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
        <form class="col-12" method="post" action="{{route('articles.store')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <script src="{{asset('node_modules/tinymce/tinymce.min.js')}}">
            </script>
            <script type="text/javascript">
                tinymce.init({
                    selector: '#content',
                });
            </script>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea rows="5" class="form-control" id="content" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('articles.index')}}" class="btn btn-default bg-light">
                Back
            </a>
        </form>
    </div>
@endsection