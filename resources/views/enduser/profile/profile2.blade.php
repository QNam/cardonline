<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('enduser.template.seo_tag')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}?v={{ time() }}">
</head>
<body>
    <div class="profile">
        <div class="profile__background">
            <img src="{{ $card->background_img }}" class="img-fluid" alt="">
        </div>
        <div class="profile__wrap">
            <div class="profile__avatar">
                <img src="{{ $card->avatar_img }}" alt="">
            </div>
            <div class="profile__content" style="{{ $card->background_color ? "background-color: " . $card->background_color : ''  }}">
                <h1>
                    {{ $card->userName }}
                    @if($card->tick)
                    <a  href="javascript:;" class="ml-1">
                        <img src="{{ asset('static/icon/verified-blue.png') }}" width="28px" style="padding-bottom: 4px;"/></h2>
                    </a>
                    @endif
                </h1>
                <div class="profile__desc">
                    {!! str_replace(PHP_EOL,"<br>",$card->descr) !!}
                </div>
                @if(!empty($card->position)) 
                <div class="profile__position">
                    <span class="me-1"><i class="fas fa-map-marker-alt"></i></span>
                    <span>{{ $card->position }}</span>
                </div>
                @endif

                <div class="profile_connect">
                    <a href="{{ route('SaveToPhone', ['id' => $card->id]) }}">Lưu danh bạ</a>
                    <a href="tel:{{ $card->phoneNumber }}">Kết nối</a>
                </div>

                <div class="profile__socials">
                    @foreach ($cardLink as $link)
                        @if($link['showType'] == 'iconDirect')
                        <a class="profile__social__item" target="_blank" href="{{ $link['link'] }}">
                            <div>
                                <img src="{{ $link['thumb'] }}?v=1.2" alt="">
                            </div>
                            <span>{{ $link['name'] }}</span>
                        </a>
                        @endif
                        @if($link['showType'] == 'card')
                        <div class="profile__social__item" onclick="copyToClipboard('{{ $link['link'] }}')">
                            <div>
                                <img src="{{ $link['thumb'] }}?v=1.2" alt="">
                            </div>
                            <a href="javascript:;">{{ $link['name'] }}</a>
                        </div>
                        @endif
                    @endforeach
                    <div class="row" style="margin: 0; margin-top: 80px">
                        <div class="col-md-8 col-xs-12 col-lg-8" style="margin: 0 auto; display: block">
                            <div id="create1" class="PoweredBy" style="margin-top: 20px; text-align:center"><strong> 
                                <a target="_blank" href="https://shopee.vn/Th%E1%BA%BB-c%C3%A1-nh%C3%A2n-th%C3%B4ng-minh-FUKI-4.0-Card-Visit-th%C3%B4ng-minh-danh-thi%E1%BA%BFp-th%C3%B4ng-minh-i.453514978.4790348140" class="PoweredBy shadow" style=" background-color: black; color: white; padding: 10px;  border-radius: 8px">
                                    Sở hữu thẻ FUKI 4.0 ngay</a></strong></div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        
        @if(Auth::check() && Auth::user()->id == $card->id)
        <div class="editProfile">
            <a href="{{ route('EditUser', ['id' => $card->id]) }}"><i class="fas fa-pen" style="color: #fff"></i></a>
        </div>
        @endif
    </div>
    <script>
    function copyToClipboard(str) {
        // const str = document.getElementById('username').innerText;
        const el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert('Đã copy ' + str);
    }
    </script>

    <style>
        .editProfile {
           position: fixed;
           bottom: 50px;
           right: 50px;
        }

        .editProfile a {
           position: absolute;
           display: inline-block;
           width: 42px;
           height: 42px;
           line-height: 42px;
           text-align: center;
           border-radius: 50%;
           background-color: black
        }
     </style>
    <style>
        .profile_connect {
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }
        .profile_connect a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            height: 40px;
            align-items: center;
            justify-content: center;
            padding: 4px 24px;
            border-radius: 4px;
            background-color: rgb(57 117 237);
            color: #fff;
            font-weight: 700;
        }
        .profile_connect a:last-child {
            background-color: #333;
            color: #fff
        }
        
    </style>
    <style>
        .profile__socials {
            margin-top: 32px;
        }
        .profile__social__item {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 2px 0 rgb(145 158 171 / 54%), 0 15px 13px -4px rgb(145 158 171 / 64%);
            transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            height: 72px;
            background-color: #fff;
        }
        .profile__social__item::after {
            content: ".";
            visibility: hidden;
            display: block
        }
        .profile__social__item>div {
            width: 56px;
            height: 56px;
            overflow: hidden;
            border-radius: 16px;
            left: 12px;
            position: absolute
        }
        .profile__social__item img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }
        .profile__social__item a {
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }
    </style>
    <style>
        .profile__desc {
            margin-top: 16px;
            text-align: center;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            color: #848484;
            font-size: 16px;
        }
        .profile__position {
            margin-top: 16px;
            text-align: center
        }
        .profile__position span i,
        .profile__position span {
            color: #848484;
            font-size: 16px;
        }
    </style>
    <style>
        .profile {
            /* padding-bottom: 40px; */
            /* padding: 0px 15px; */
            position: relative;
            max-width: 480px;
            margin: 0 auto;
        }
        .profile__wrap {
            padding-top: 150px
        }
        .profile__content {
            padding: 24px 24px 80px 24px;
            min-height: 80vh;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 1%);
            margin-top: -75px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }
        .profile__avatar {
            width: 172px;
            height: 172px;
            overflow: hidden;
            margin-left: auto;
            margin-right: auto; 
            border: 5px solid #fff;
            border-radius: 50%
        }
        .profile__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }
        .profile__content h1 {
            margin-top: 60px;
            text-align: center;
            font-size: 32px;
            font-weight: 700;
        }
        .profile__background {
            background-color: #ebebeb;
            max-height: 500px;
            width: 100%;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>