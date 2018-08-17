<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NTG Technology</title>
    <link href="{{URL::to('bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

</head>
<body>


<div id="app">
    <router-view></router-view>
</div>



<script src="{{URL::to('js/app.js')}}"></script>


</body>
</html>