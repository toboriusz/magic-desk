<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Application name</title>

    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

</head>
<body>
    <div id="app"></div>
    
    <script src="{{ url(mix('js/app.js')) }}"></script>
    @if(config('app.env') == 'local')
      <script src="http://localhost:35729/livereload.js"></script>
    @endif
</body>
</html>
