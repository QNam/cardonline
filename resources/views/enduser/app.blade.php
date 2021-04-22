<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Card Online</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap&subset=vietnamese">
    <script>
        var SOCIAL_NETWORKS = '{!! json_encode(config('variable.social_data')) !!}'
    </script>
</head>
<body>
    <div id="app"></div>
    <link rel="stylesheet" href="{{ mix('css/enduser.css') }}">
    <script src="{{ mix('js/enduser/app.js') }}" type="text/javascript"></script>
</body>
</html>
