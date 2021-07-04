<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/admin/app.js') }}" type="text/javascript"></script>
</body>
</html>
