<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="{{url('images/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('images/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <title>Veda CRM</title>

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
{{--<script>--}}
{{--    window.baseUrl = "{{url('/')}}"--}}
{{--    window.today = "{{date('Y-m-d')}}"--}}
{{--</script>--}}

<div id="app"></div>

<script src="{{url('js/app.js')}}"></script>
</body>
</html>
