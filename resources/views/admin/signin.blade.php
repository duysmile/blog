<!doctype html>
<html class="h-100" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{asset('css/main_login.css')}}">
</head>
<body class="bg-secondary h-100">
<div class="d-flex justify-content-center align-items-center h-100">
    <div class="bg-light p-4 body__form--width">
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
        </div>
        <form class="text-center" method="post" action="{{route('login')}}">
            {{csrf_field()}}
            <h3 class="text-center">
                <b>
                    Sign In
                </b>
            </h3>
            <div class="form-group">
                <div class="input-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input required type="email" name="email" class="form-control" placeholder="Enter email" value="{{old('email')}}">
                </div>
                <div class="input-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Password</span>
                    </div>
                    <input required type="password" name="password" class="form-control" placeholder="Enter password">
                </div>
                <div>
                    @if ($error = Session::get('error'))
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Sign In Now</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>