{{-- <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"> --}}
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('static/imgs/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/imgs/logo.png') }}">
{{-- <link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000"> --}}
<meta name="msapplication-TileColor" content="#000000">
<meta name="theme-color" content="#ffffff">
<meta property="og:image" content="{{ $card->background_img }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1024">
<meta property="og:image:height" content="1024">
<!--<link rel="apple-touch-icon" sizes="180x180" href="https://poplme.co/assets/frontend/images/favicons/apple-touch-icon.png?v=algq7zqq6R">-->
{{-- <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png"> --}}
<link rel="shortcut icon" href="{{ asset('static/imgs/logo.png') }}">
<meta name="apple-mobile-web-app-title" content="FUKI">
<meta name="application-name" content="FUKI">
<!--<meta name="msapplication-TileColor" content="#00aced">-->
{{-- <meta name="msapplication-TileImage" content="https://poplme.co/assets/frontend/images/favicons/mstile-310x310.png?v=algq7zqq6R">
<meta name="msapplication-TileImage" content="https://poplme.co/assets/frontend/images/favicons/mstile-310x150.png?v=algq7zqq6R">
<meta name="msapplication-TileImage" content="https://poplme.co/assets/frontend/images/favicons/mstile-150x150.png?v=algq7zqq6R">
<meta name="msapplication-TileImage" content="https://poplme.co/assets/frontend/images/favicons/mstile-144x144.png?v=algq7zqq6R">
<meta name="msapplication-TileImage" content="https://poplme.co/assets/frontend/images/favicons/mstile-70x70.png?v=algq7zqq6R"> --}}
<!--<meta name="theme-color" content="#00aced">-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{ $card->userName }}</title>
<meta property="og:title" content="{{ $card->userName }}" data-react-helmet="true">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no, user-scalable=no" />
<meta name="description" content="{{ $card->descr }}">
<meta property="og:description" content="{{ $card->descr }}">
<meta name="msapplication-tap-highlight" content="no">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/imgs/logo.png') }}">
<link rel="stylesheet" href="https://poplme.co/assets/plugins/jquery/intlTelInput.min.css" type="text/css" >
<link rel="stylesheet" href="https://poplme.co/assets/plugins/jquery/jquery-ui.css" type="text/css" >
<meta name="apple-mobile-web-app-status-bar-style" content="default">