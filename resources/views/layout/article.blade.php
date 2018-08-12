<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=392449574568121&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->
<div class="bg-white p-3 main__container--box-shadow">
    <h2><b>{{$article->title}}</b></h2>
    <span class="d-block mb-4">
        <small class="mr-2">
            <i class="fa fa-user"></i><b>&nbsp;{{$article->author->name}}</b>
        </small>
        <small class="mr-2">
            <i class="fa fa-calendar"></i>&nbsp;{{date('d-m-Y', strtotime($article->time_public))}}
        </small>
        <small class="mr-2">
            <i class="fa fa-eye"></i><b>&nbsp;{{$article->views}}</b>
        </small>
    </span>
    <img src="{{$article->images[0]->url}}" alt="" class="w-100 mb-2">
    <p class="text-justify">
        <small>
            {!! $article->content !!}
        </small>
    </p>
</div>
<div class="bg-white p-3 mt-2 main__container--box-shadow">
    <p class="text-center">
        <i class="fa fa-thumbs-up"></i> YOU MAY ALSO LIKE
    </p>
    <hr>
    <div class="container-fluid">
        <div class="row">
            @foreach($articles_like as $article_like)
            <div class="col-md-4 col-12">
                <div class="flip">
                    <a href="{{route('content', [
                        'category' => count($article_like->categories) ? $article_like->categories[0]->name : 'no-category',
                        'article' => $article_like['title-en']
                    ])}}">
                        <img src="{{$article_like->images[0]->url}}" alt="" class="w-100 like__image--height">
                        <span class="flip-item"></span>
                        <span class="flip-read-more">
                            <img src="{{asset('images/bookmark.png')}}" alt="">
                        </span>
                    </a>
                </div>
                <a href="{{route('content', [
                        'category' => count($article_like->categories) ? $article_like->categories[0]->name : 'no-category',
                        'article' => $article_like['title-en']
                    ])}}">
                    <p class="text-center mt-2">
                        {{$article_like->title}}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- <div class="fb-comments" data-width="100%" data-numposts="5"></div> -->
<div class="container my-2">
	<div class="row p-2">
		1 comment
	</div>

    <ul class="row mb-3 p-0" id="list-comment">
		<li class="d-flex w-100 flex-column border-bottom mt-1">
            @component('layout/comment')
                @slot('name')
                    Duy
                @endslot
                @slot('comment')
                    Comment
                @endslot
            @endcomponent
		</li>
    </ul>

    <div class="row mb-3" id="comment-box-main">
		<form action="" class="w-100" id="post-comment">
            <div class="d-flex">
                <p>
                    LEAVE A COMMENT
                </p>
            </div>
            <div class="d-flex">
                <div class="form-group w-100">
                    <input id="comment" type="text" class="form-control w-100" 
                    placeholder="Comment" name="comment">
                </div>
            </div>
            <div id="comment-post">
                <div class="d-flex w-100">
                    <div class="h-50 icon-avatar">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="w-100">
                        <input name="email" type="email" placeholder="Email(required)" 
                            class="form-control mb-2" required>
                        <input name="name" type="text" placeholder="Name(required)" 
                            class="form-control mb-2" required>
                    </div>
                </div>
                
                <div class="text-right">
                    <button class="btn btn-primary">
                        Post
                    </button>
                </div>
            </div>
		</form>
	</div>
</div>

<script>
    function comment(name, comment, child) {
        var image = '<div class="h-comment icon-avatar">' +
                        '<i class="fa fa-user"></i>' +
                    '</div>';
        var name = '<span class="text-primary">' +
                        name +
                    '</span>' +
                    '<br>';
        var hint = '<small class="hint-text">' +
                        'Your comment is awaiting moderation.' +
                    '</small>' +
                    '<br>';
        var content = '<span class="">' +
                        comment +
                    '</span>' +
                    '<br>';
        
        if(child){
            var button = '<span class="text-primary">' +
                        '<a href="" class="text-primary">' +
                            '<i class="fa fa-thumbs-up mr-1">&nbsp;Like</i>' +
                        '</a>' +
                    '</span>';
            var comment = '<li class="d-flex w-100 flex-column border-top pt-1">' +
                        '<div class="d-flex w-100">' +
                            image +
                            '<div class="w-100">' +
                                '<p>' + 
                                    name + hint + 
                                    content +
                                    button +
                                '</p>' +
                            '</div>' +
                        '</div>' +
                    '</li>';
        }
        else {
            var button = '<span class="text-primary">' +
                        '<a href="" class="text-primary">' +
                            '<i class="fa fa-thumbs-up mr-1">&nbsp;Like</i>' +
                        '</a>' +
                        '<a href="" class="text-primary">' +
                            '<i class="fa fa-reply">&nbsp;Reply</i>' +
                        '</a>' +
                    '</span>';
            var comment = '<li class="d-flex w-100 flex-column border-bottom mt-1">' +
                        '<div class="d-flex w-100">' +
                            image +
                            '<div class="w-100">' +
                                '<p>' + 
                                    name + hint + 
                                    content +
                                    button +
                                '</p>' +
                            '</div>' +
                        '</div>' +
                        '<ul>' +
                        '</ul>' +  
                    '</li>';
        }
        return comment;
    }
    function commentBox(data) {
        $("#comment-box-main").hide();
        $("#comment-box-child").remove();
        var box ='<div class="row mb-3" id="comment-box-child">' +
                    '<form action="" class="w-100" id="post-comment-child">' +
                        '<div class="d-flex">' +
                            '<p>' + 
                                'LEAVE A COMMENT' +
                            '</p>' +
                            '<div class="ml-auto">' +
                                '<button class="close" type="button" onclick="close()">' +
                                    '&times;' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                        '<div class="d-flex">' +
                            '<div class="form-group w-100">' +
                               ' <input id="comment" type="text" class="form-control w-100"' +
                                'placeholder="Comment" name="comment">' +
                            '</div>' +
                        '</div>' +
                        '<div>' +
                            '<div class="d-flex w-100">' +
                                '<div class="h-50 icon-avatar">' +
                                    '<i class="fa fa-user"></i>' +
                                '</div>' +
                                '<div class="w-100">' +
                                    '<input name="email" type="email" placeholder="Email(required)"' +
                                        'class="form-control mb-2" required>' +
                                    '<input name="name" type="text" placeholder="Name(required)"' +
                                        'class="form-control mb-2" required>' +
                                '</div>' +
                            '</div>' +
                            
                            '<div class="text-right">' +
                                '<button class="btn btn-primary">' +
                                    'Post' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                    '</form>' +
               '</div>';
        return box;
    }
    function addComment(data) {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            url: "{{route('comments.store')}}",
            dataType: 'json',
            type: "POST",
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    $(document).ready(function () {
        $(document).on('click', "i.fa-reply", function(e) {
            e.preventDefault();
            $(this).parents("li").append(commentBox(1));
        })
        $(document).on('click', "#comment", function(){
            $("#comment").css("height", "70px")
            $("#comment-post").css("display", "block");
            $("#comment-post").css("height", "100px");
        })
        $(document).on('click',".close", function(){
            $("#comment-box-main").show();
            $("#comment-box-child").remove();
        })
        $(document).on('submit',"#post-comment", function(e) {
            e.preventDefault();
            
            var name = $("input[name='name']").val();
            var email = $("input[name='email']").val();
            var content = $("input[name='comment']").val();
            var id_article = {{$article->id}};
            var data = {name, email, content, id_article};
            addComment(data);
            $("#list-comment").append(comment(name, content, false));
            $("input[name='name']").val("");  
            $("input[name='email']").val("");  
            $("input[name='comment']").val("");  
        })
        //TODO: add reply comment and add CommentController
        $(document).on('submit',"#post-comment-child", function(e) {
            e.preventDefault();
            var name = $("input[name='name']").val();
            var email = $("input[name='email']").val();
            var content = $("input[name='comment']").val();
            $(this).parents("li").children("ul").append(comment(name, content, true));
            $("input[name='name']").val("");  
            $("input[name='email']").val("");  
            $("input[name='comment']").val("");  
        })
    })
</script>
