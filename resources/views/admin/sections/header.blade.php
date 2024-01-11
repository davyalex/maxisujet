<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> {{config('app.name')}} - @yield('title') </title>
    <!-- General CSS Files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{asset('back/assets/css/app.min.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('back/assets/css/style.css')}}"> 
    <link rel="stylesheet" href="{{asset('back/assets/css/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('back/assets/css/custom.css')}}">
    @stack('css')
    <link rel='shortcut icon' type='image/x-icon' href='{{asset('back/assets/img/favicon.ico')}}' />

</head>
