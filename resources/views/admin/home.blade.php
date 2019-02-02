@extends('layout_admin.master')
@section('title', 'Home')
@section('content')
    <div class="row pt-5">
        <div class="col-md-8 col-12">
            <canvas id="myChart"></canvas>
            <div class="text-center mt-2">
                <h5 class="pt-1 text-center d-inline-block">
                    Chart of articles and views
                </h5>
                <button id="change-type" class="btn btn-primary text-light">
                    Change type
                </button>
            </div>

            <script>
                $(document).ready(function(){
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var temp = {
                        height: 600,
                        width: 600,
                        type: 'bar',
                        data: {
                            labels: [
                                @foreach($time as $key => $month)
                                        @if($key < 5)
                                    "{{$month->date}}",
                                @endif
                                @endforeach
                            ],
                            datasets: [{
                                label: 'Views of month',
                                data: [
                                    @foreach($time as $key => $month)
                                    @if($key < 5)
                                    {{$month->view}},
                                    @endif
                                    @endforeach
                                ],
                                backgroundColor: [
                                    @foreach($time as $key => $month)
                                            @if($key < 5)
                                        'rgba(54, 162, 235, 0.2)',
                                    @endif
                                    @endforeach
                                ],
                                borderColor: [
                                    @foreach($time as $key => $month)
                                            @if($key < 5)
                                        'rgba(54, 162, 235, 1)',
                                    @endif
                                    @endforeach
                                ],
                                borderWidth: 1
                            },
                                {
                                    label: 'Sum of articles of month',
                                    data: [
                                        @foreach($time as $key => $month)
                                        @if($key < 5)
                                        {{$month['sum-articles']}},
                                        @endif
                                        @endforeach
                                    ],
                                    backgroundColor: [
                                        @foreach($time as $key => $month)
                                                @if($key < 5)
                                            'rgba(255, 99, 132, 0.2)',
                                        @endif
                                        @endforeach
                                    ],
                                    borderColor: [
                                        @foreach($time as $key => $month)
                                                @if($key < 5)
                                            'rgba(255,99,132,1)',
                                        @endif
                                        @endforeach
                                    ],
                                    borderWidth: 1
                                },
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    };
                    var myChart = new Chart(ctx, temp);
                    $('#change-type').click(function(){
                        if(myChart.config.type == 'line'){
                            temp.type = 'bar';
                        }
                        else{
                            temp.type = 'line';
                        }
                        myChart.destroy();
                        var ctx = document.getElementById("myChart").getContext('2d');
                        myChart = new Chart(ctx, temp);
                    })
                })

            </script>
        </div>
        <div class="col-md-4 col-12">
            <div class="mt-2">
                <h5>
                    Top Users of
                    <form action="{{route('admin', 1)}}" class="d-inline-block" id="form-top-user">
                        <select class="form-control" name="time" id="time-top-user">
                            @foreach($time as $time_public)
                                <option value="{{$loop->index}}"
                                    @if($loop->index == $time_topUser)
                                        selected
                                    @endif
                                >
                                    {{$time_public->date}}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </h5>
            </div>

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Articles</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topUsers as $topUser)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$topUser->author}}</td>
                            <td>{{$topUser->articles}}</td>
                            <td>{{$topUser->views_article}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row border-top mt-5 pt-5">
        <div class="col-12">
            <h3 class="text-primary">
                ACTIVE COMMENT
            </h3>

            <div class="d-flex flex-column">
                @foreach($articles as $article)
                <h5 class="p-3 bg-warning">
                    Title:
                    <a href="{{ $app->make('url')
                        ->to('/'. (isset($article->categories[0]) ? $article->categories[0]->name : 'no-category')
                         . "/" . $article['title-en'])}}"
                        target="_blank"
                    >
                        {{$article['title']}}</a>
                    <span class="badge badge-pill badge-info">{{$article->count}}</span>
                    <i class="fa fa-chevron-down" data-toggle="collapse" data-target="#group-{{$article->id}}"></i>
                </h5>
                <ul id="group-{{$article->id}}" class="collapse list-group mb-2">
                    @foreach($article->comments as $comment)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <i class="fa fa-user text-success"></i>
                                <span class="text-success">
                                    &nbsp;{{$comment->name}}
                                </span>
                                <span class="d-block pl-3 text-primary">
                                    <i class="fa fa-comments text-primary"></i>
                                    &nbsp;{{$comment->content}}
                                </span>
                            </div>
                            <div data-comment="{{$comment->id}}">
                                <button class="btn btn-success btn-active">
                                    Active
                                </button>
                                <button class="btn btn-danger btn-del">
                                    Delete
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row p-5 border-top mt-5">
        <div class="col-12 text-center">
            DASHBOARD by Duy Nguyen.
        </div>
    </div>
<script>
    $(document).ready(function(){
       $('#time-top-user').on('change', function(){
           $('#form-top-user').submit();
       });
       $(".btn-active").on('click', function () {
           var instance = this;
           if($(this).text().trim() == "Active") {
               $.ajax({
                   headers:{
                       'X-CSRF-TOKEN': '{{csrf_token()}}'
                   },
                   url: '{{route('active_comment')}}',
                   dataType: 'json',
                   type: 'PATCH',
                   contentType: 'application/json',
                   data: JSON.stringify({
                       'comment': $(this).parent().attr('data-comment')
                   }),
                   success: function(response) {
                       $(instance).html("<i class='fa fa-check'></i>");
                       $(instance).attr("disabled", "true");
                   },
                   error: function (error) {
                       console.log(error);
                   }
               })
           } else {

           }
       })
        $(".btn-del").on('click', function () {
            var instance = this;
            if($(this).text().trim() == "Delete") {
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    url: '{{route('delete_comment')}}',
                    dataType: 'json',
                    type: 'DELETE',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        'comment': $(this).parent().attr('data-comment')
                    }),
                    success: function(response) {
                        $(instance).html("<i class='fa fa-trash'></i>");
                        $(instance).attr("disabled", "true");
                    },
                    error: function (error) {
                        console.log(error);
                    }

                })
            } else {

            }

        })
    });
</script>
@endsection