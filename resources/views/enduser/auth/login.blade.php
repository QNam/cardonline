<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('static/imgs/logo.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('static/imgs/logo.png') }}">
    <title>FUKI 4.0 - Phụ kiện thông minh 4.0</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&amp;display=swap&amp;subset=vietnamese">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        * {
            padding: 0; 
            margin: 0; 
            color: #333; 
            font-family: 'Cabin';
        }
        p,h1,h2,h3,h4,h5,h6,ul,li,label {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none!important;
            color: #333;
        }

        li {
            list-style: none!important;
        }

        .authForm .form-check-label {
            font-weight: 500;
        }
        .authForm .form-group label {
            font-weight: 700;
            margin-bottom: 8px;
        }
        .authForm .form-group input{
            padding: 11px;
            border-radius: 4px;
        }

        .authForm .form-group input::-moz-placeholder {
            color: #ccc;
        }

        .authForm .form-group input:-ms-input-placeholder {
            color: #ccc;
        }

        .authForm .form-group input::placeholder {
            color: #ccc;
        }
        .authForm button {
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%);
            padding: 12px 24px;
            color: #fff;
            font-weight: 700;
            background-color: #333
        }

        .authForm button:hover {
            color: #fff;
            background-color: #333;
        }

        .authForm {
            margin-bottom: 40px
        }
        .authForm__wrap {
            width: 100%;
            border-radius: 12px;
            padding: 32px;
            background-color: rgb(226, 232, 240)
        }

        .authForm__wrap>h3 {
            font-weight: 700;
        }



        .authForm__footer {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            justify-content: space-between
        }

        .authForm__footer a {
            font-size: 14px;
            color: #333;
        }

        @media only screen and (max-width: 565px) {
            .authForm__wrap{
                padding: 24px;
            }
        } 

    </style>
    <style type="text/css">
        .navbar {
            margin-bottom: 40px
        }

        .navbar__wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .navbar ul {
            display: flex
        }

        .navbar ul li {
            padding: 16px
        }

        .navbar ul li i {
            font-size: 20px
        }

        .navbar ul li .goToShop {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            font-weight: 700;
        }

        .navbar--mobile__wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
            position: relative;
        }

        .navbar--mobile {
            display: none;
            margin-bottom: 40px
        }

        .navbar--mobile .dropdown-menu {
            transform: unset !important;
            inset: unset !important;
            top: 80px !important;
            left: 0 !important;
            width: 100%;
            padding: 16px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%);
        }

        .navbar--mobile .dropdown-menu li {
            padding: 8px 0px
        }

        .navbar--mobile .dropdown-menu li a {
            font-weight: 700
        }

        .navbar--mobile .dropdown-menu li a i {
            color: #ccc
        }

        .navbar--mobile .nav-item.dropdown {
            width: 40px;
            height: 40px;
            border: 2px solid #333;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: static;
        }

        .navbar--mobile .nav-item i {
            font-size: 30px;
            color: #333;
        }

        .dropdown-item i {
            width: 40px;
            display: inline-block;
        }

        @media only screen and (max-width: 565px) {
            .navbar {
                display: none
            }

            .navbar--mobile {
                display: block
            }
        }
    </style>
    <style type="text/css">
        .footer__wrap {
            padding: 8px 24px;
            border-top: 1px solid rgba(74, 85, 104);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer__wrap>p {
            font-weight: 700;
        }

        .footer__wrap ul {
            display: flex;
            align-items: center;
        }

        .footer__wrap ul li {
            padding: 8px;
        }

        .footer__wrap ul li a {
            font-weight: 700;
            color: #333;
        }

        @media only screen and (max-width: 565px) {
            footer .footer__wrap p {
                text-align: center
            }

            footer .footer__wrap p {
                text-align: center
            }

            footer .footer__wrap ul {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
    <style type="text/css">
        .mainPage {
            width: 100%;
            min-height: 100vh;
            background-image: url('https://access.pavietnam.vn/images/pink_new/images/bg_body.jpg');
            display: flex;
            flex-direction: column;
            justify-content: space-between
        }
    </style>
    <style type="text/css">
        p.error,
        span.error {
            font-size: 11px;
            color: #dc3333;
            margin-top: 8px;
            font-weight: bold;
        }

        .loginLoading {
            opacity: .5;
            pointer-events: none;
        }

        .loginLoading span {
            display: inline !important;
        }

        .loginLoading span i {
            color: #fff;
        }
    </style>
    <style type="text/css">
        label.error {
            font-size: 12px;
            color: #dc3333;
            margin-top: 8px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div>
        <div class="mainPage">
            <div>
                <nav class="navbar">
                    <div class="container">
                        <div class="navbar__wrap">
                            <a  href="/" class="navbar__logo">
                                <img  src="{{ asset('/static/imgs/logo.png') }}" alt="" style="width: 120px;">
                            </a>
                            <ul>
                                <li><a  href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a  href=""><i class="fab fa-youtube"></i></a></li>
                                <li><a  href=""><i class="fab fa-instagram"></i></a></li>
                                <li><a  href="" class="goToShop">Go to shop </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <nav  class="navbar--mobile">
                    <div class="container">
                        <div class="navbar--mobile__wrap"><a  href="">
                            <img src="{{ asset('/static/imgs/logo.png') }}" alt="" style="width: 120px;"></a>
                            <li class="nav-item dropdown">
                                <a  href="#" id="navbar--mobile" 
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    class="nav-link">
                                        <i aria-hidden="true" class="fas fa-bars"></i>
                                </a>
                                <ul  aria-labelledby="navbar--mobile" class="dropdown-menu">
                                    <li><a  href="#" class="dropdown-item"><i class="fab fa-facebook-f me-2"></i> Facebook</a></li>
                                    <li><a  href="#" class="dropdown-item"><i class="fab fa-youtube me-2"></i> Youtube</a></li>
                                    <li><a  href="#" class="dropdown-item"><i class="fab fa-instagram me-2"></i> Instagram</a></li>
                                    <li><a  href="#" class="dropdown-item"><span class="me-2"></span> Go to shop</a></li>
                                </ul>
                            </li>
                        </div>
                    </div>
                </nav>
            </div>
            <div  class="loginForm authForm">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-4">
                            <form id="loginForm" action="{{ route('UserLogin') }}" method="POST">
                                @csrf
                                <div class="authForm__wrap">
                                    <h3  class="text-center mb-4">Đăng nhập</h3>
                                    @if(Session::has('LOGIN_STATUS'))
                                        <label class="error">{{ Session::get('LOGIN_STATUS') }}</label>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Email</label> 
                                        <input type="text" name="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="">Mật khẩu</label>
                                        <input type="password" name="password" placeholder="Mật khẩu" class="form-control">
                                    </div>
                                    <div class="form-check mt-3">
                                        <input type="checkbox" value="" name="remember" id="flexCheckDefault" class="form-check-input">
                                        <label for="flexCheckDefault" class="form-check-label">
                                            Ghi nhớ đăng nhập
                                        </label>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" class="btn w-100 text-center">
                                            <span class="d-none me-1"><i class="fas fa-circle-notch fa-spin"></i></span>
                                            Đăng nhập
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="authForm__footer mt-3">
                                <a  href="" style="visibility: hidden;">Quên mật khẩu</a> 
                                <a href="{{ route('Register') }}" class="">Tạo tài khoản mới</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div >
                <footer >
                    <div class="container">
                        <div class="footer__wrap flex-wrap">
                            <p  class="flex-grow-1">Copyright © 2021</p>
                            <ul  class="flex-grow-2">
                                <li ><a  href="">Home</a></li>
                                <li ><a  href="">Blog</a></li>
                                <li ><a  href="">Shop</a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Vui lòng nhập email !",
                    email: "Email không đúng định dạng !"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu !",
                }
            }
        });
    </script>
</body>

</html>