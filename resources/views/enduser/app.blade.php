<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('static/imgs/logo.png') }}">
    <title>FUKI 4.0 - Phụ kiện thông minh 4.0</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap&subset=vietnamese">
    <script>
        @if( isset($listSocial))
        var SOCIAL_NETWORKS = '{!! json_encode($listSocial) !!}'
        @endif
    </script>
</head>
<body>
    <div class="container">
        <div id="app"></div>
    </div>
    
    <link rel="stylesheet" href="{{ mix('css/enduser.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    <script src="{{ mix('js/enduser/app.js') }}" type="text/javascript"></script>
</body>
</html>
