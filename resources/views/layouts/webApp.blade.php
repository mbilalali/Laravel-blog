<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MAD Tee') }}</title>

    <meta name="keywords" content="" />
    <meta name="description" content=" " />
    @include('layouts.partials.webMeta')


</head>
<body>

@include('layouts.partials.WebHeader')



@yield('content')



@include('layouts.partials.webFooter')

</body>
</html>
