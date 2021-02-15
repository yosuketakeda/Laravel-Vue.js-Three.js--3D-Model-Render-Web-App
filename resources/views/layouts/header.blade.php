<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta name="csrf-token" content="{{ Session::token() }}"> -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Rapid Closure</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" type="text/css">
    <!--<link rel="stylesheet" href="{{ asset('css/bootstrap-reset.css') }}" type="text/css">-->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>