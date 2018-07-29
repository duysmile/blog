@extends('layout_admin.master')
@section('title', 'Home')
@section('content')
    <div class="row pt-5">
        <div class="col-8">
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
        <div class="col-4">
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
<script>
    $(document).ready(function(){
       $('#time-top-user').on('change', function(){
          $('#form-top-user').submit();
       });
    });
</script>
@endsection