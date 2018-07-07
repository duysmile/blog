@extends('layout_admin.master')
@section('title', 'Edit Article')

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
        <form class="col-12" method="post" action="{{route('articles.update', $article->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{$article->title}}">
                    </div>
                    <script src="{{asset('node_modules/tinymce/tinymce.min.js')}}">
                    </script>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea rows="7" class="form-control" id="content" name="content" required>
                            {{$article->content}}
                        </textarea>
                        <script type="text/javascript">
                            var editor_config = {
                                path_absolute : "/",
                                selector: "#content",
                                plugins: [
                                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                                    "insertdatetime media nonbreaking save table contextmenu directionality",
                                    "emoticons template paste textcolor colorpicker textpattern"
                                ],
                                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                                relative_urls: false,
                                file_browser_callback : function(field_name, url, type, win) {
                                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                                    if (type == 'image') {
                                        cmsURL = cmsURL + "&type=Images";
                                    } else {
                                        cmsURL = cmsURL + "&type=Files";
                                    }

                                    tinyMCE.activeEditor.windowManager.open({
                                        file : cmsURL,
                                        title : 'Filemanager',
                                        width : x * 0.8,
                                        height : y * 0.8,
                                        resizable : "yes",
                                        close_previous : "no"
                                    });
                                }
                            };
                            tinymce.init(editor_config);
                        </script>
                    </div>
                </div>
                <div class="col-3">
                    <div>
                        <label for="">
                            Choose Category
                        </label>
                        @foreach($categories as $categoryParent)
                            <div class="form-check">
                                <input data-id="{{$categoryParent->id}}" data-type="parent"
                                        type="checkbox" class="form-check-input" name="category" value="{{$categoryParent->id}}"
                                    @if(in_array($categoryParent->name, $article_category))
                                       checked
                                    @endif
                                >
                                <label class="form-check-label" for="exampleCheck1">{{$categoryParent->name}}</label>
                                @if(count($categoryParent->child) > 0)
                                    <span data-toggle="collapse" data-target="#category{{$categoryParent->id}}">
                                &nbsp;<i class="fa fa-chevron-down"></i>
                            </span>
                                @endif
                            </div>
                            @if(count($categoryParent->child) > 0)
                                <div id="category{{$categoryParent->id}}" class="collapse">
                                    @foreach($categoryParent->child as $child)
                                        <div class="ml-3 form-check">
                                            <input data-type="child" data-parent="{{$categoryParent->id}}"
                                                    type="checkbox" class="form-check-input" name="category" value="{{$child->id}}"
                                               @if(in_array($child->name, $article_category))
                                                    checked
                                               @endif
                                            >
                                            <label class="form-check-label">{{$child->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div>
                        <label for="">
                            Time public
                        </label>
                        <input type="text" class="form-control" id="datetimepicker" name="time_public" required value="{{date('H:i  d.m.Y',strtotime($article->time_public))}}">
                        <script>
                            jQuery('#datetimepicker').datetimepicker({
                                format:'H:i d.m.Y',
                                minDate:'0',
                                maxDate:'+1970/02/02', //a month later
                            });
                        </script>
                    </div>
                    <hr>
                    <div>
                        <label for="">
                            Thumbnail
                        </label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">

                        <img src="{{$article->images[0]->url}}" alt="" id="imgThumbnail" class="w-100 p-2 border mt-2">
                        {{--preview image--}}
                        <script>
                            function readUrl(input){
                                if(input.files && input.files[0]){
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $('#imgThumbnail').attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#thumbnail").change(function(){
                                $('#imgThumbnail').removeClass('d-none');
                                readUrl(this);
                            })
                        </script>
                        {{--end preview--}}
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('articles.index')}}" class="btn btn-default bg-light">
                Back
            </a>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $("input:checkbox[data-type|='child']").change(function () {
                if ($(this).is(':checked')) {
                    let id_parent = $(this).attr('data-parent');
                    $("input:checkbox[data-id|= " + id_parent + "]").prop('checked', true);;
                }
            });
            $("input:checkbox[data-type|='parent']").change(function () {
                if (!$(this).is(':checked')) {
                    let id_parent = $(this).attr('data-id');
                    $("input:checkbox[data-parent|= " + id_parent + "]").prop('checked', false);;
                }
            });
        });
    </script>
@endsection