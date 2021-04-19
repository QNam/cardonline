<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v={{ time() }}">

</head>
<body>
    <section class="loginPage">
        <nav class="navbar">
            <div class="container">
                <div class="navbar__wrap">
                    <a href="" class="navbar__logo">aaaa</a>
                    <ul>
                        <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="" class="goToShop">Go to shop </a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar--mobile">
            <div class="container">
                <div class="navbar--mobile__wrap">
                    <a href="">logo</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbar--mobile" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbar--mobile">
                        <li><a class="dropdown-item" href="#"><i class="fa fa-facebook me-2" aria-hidden="true"></i> Facebook</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-youtube me-2" aria-hidden="true"></i> Youtube</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-instagram me-2" aria-hidden="true"></i> Instagram</a></li>
                        <li><a class="dropdown-item" href="#"><span class="me-2"></span>  Go to shop</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>

        <div class="loginForm">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-4">
                        <div class="loginForm__wrap">
                            <h3 class="text-center mb-4">Đăng nhập</h3>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Mật khẩu">
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                            <div class=" mt-5">
                                <button class="btn w-100 text-center">Đăng nhập</button>
                            </div>
                        </div>
                        <div class="loginForm__footer mt-3">
                            <a href="">Quên mật khẩu</a>
                            <a href="">Tạo tài khoản mới</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="footer__wrap flex-wrap">
                    <p class="flex-grow-1">Copyright © 2021</p>
                    <ul class="flex-grow-2">
                        <li><a href="">Home</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Shop</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </section>

    <style>
        .loginPage {
            width: 100%;
            height: 100vh;
            background-image: url('https://access.pavietnam.vn/images/pink_new/images/bg_body.jpg');
            display: flex;
            flex-direction: column;
            justify-content: space-between
        }
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

        .loginPage footer {
        }

        .loginPage .footer__wrap {
            padding: 8px 24px;
            border-top: 1px solid rgba(74, 85, 104);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .loginPage .footer__wrap>p {
            font-weight: 700;
        }

        .loginPage .footer__wrap ul {
            display: flex;
            align-items: center;
        }

        .loginPage .footer__wrap ul li {
            padding: 8px;
        }
        .loginPage .footer__wrap ul li a {
            font-weight: 700;
            color: #333;
        }
        .loginForm {
            margin-bottom: 40px
        }
        .loginForm__wrap {
            width: 100%;
            border-radius: 12px;
            padding: 32px;
            background-color: rgb(226, 232, 240)
        }

        .loginForm__wrap>h3 {
            font-weight: 700;
        }
        .loginForm .form-check-label {
            font-weight: 500;
        }
        .loginForm .form-group label {
            font-weight: 700;
            margin-bottom: 8px;
        }
        .loginForm .form-group input{
            padding: 11px;
            border-radius: 4px;
        }

        .loginForm button {
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%);
            padding: 12px 24px;
            color: #fff;
            font-weight: 700;
            background-color: #333
        }


        .loginForm__footer {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            justify-content: space-between
        }

        .loginForm__footer a {
            font-size: 14px;
            color: #333;
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

        .navbar--mobile .dropdown-menu{
            transform: unset!important;
            inset: unset!important;
            top: 80px!important;
            left: 0!important;
            width: 100%;
            padding: 16px
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%);
        }

        .navbar--mobile .dropdown-menu li {
            padding: 8px 0px
        }

        .navbar--mobile .dropdown-menu li a {
            font-weight: 700
        }
        .navbar--mobile .dropdown-menu li a i{
            color: #ccc
        }
        .navbar--mobile .nav-item.dropdown{
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
        @media only screen and (max-width: 565px) {
            .navbar {
                display: none
            }

            .navbar--mobile {
                display: block
            }

            .loginForm .loginForm__wrap{
                padding: 24px;
            }

            .loginPage footer .footer__wrap p {
                text-align: center
            }

            .loginPage footer .footer__wrap p {
                text-align: center
            }

            .loginPage footer .footer__wrap ul {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>