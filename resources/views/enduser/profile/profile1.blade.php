@extends('enduser/template')

@section('content')
@php 

@endphp

<div class="profile">
    <div class="profile__background">
        <img src="{{ $card->background_img }}" alt="">
    </div>
    <div class="container">
        <div class="profile__wrap">
            <div class="profile__avatar">
                <img src="{{ $card->avatar_img }}" alt="">
            </div>
            <div class="profile__content">
                <h1>{{ $card->userName }}</h1>
                <div class="profile__desc">
                    {{ $card->descr }}
                </div>
                @if(!empty($card->position)) 
                <div class="profile__position">
                    <span class="me-1"><i class="fas fa-map-marker-alt"></i></span>
                    <span>{{ $card->position }}</span>
                </div>
                @endif

                <div class="profile_connect">
                    <a href="{{ route('SaveToPhone', ['id' => $card->id]) }}">Lưu danh bạ</a>
                    <a href="">Kết nối</a>
                    {{-- <a href="wtai://wp/ap;0386055556;nam doan quoc">TEXT</a> --}}
                </div>

                <div class="profile__socials">
                    @foreach ($cardLink as $link)
                        <div class="profile__social__item">
                            <div>
                                <img src="{{ $link['thumb'] }}" alt="">
                            </div>
                            <a href="{{ $link['link'] }}">{{ $link['name'] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .profile_connect {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 24px;
    }

    .profile_connect a {
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
        box-shadow: 0 0.25rem 0.5rem rgb(0 0 0 / 5%), 0 1.5rem 2.2rem rgb(0 0 0 / 5%);
        position: relative;
        height: 72px;
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
    }
    .profile__wrap {
        padding-top: 150px
    }
    .profile__content {
        padding: 24px;
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
@endsection