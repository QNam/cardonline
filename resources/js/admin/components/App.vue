<template>
    <div>
        <div class="d-flex align-items-stretch">
            <nav class="sidebar" :class="{'close': !toggleSidebar}">
                <div class="custom-menu">
                    <button type="button" @click="toggleSidebar = !toggleSidebar" class="btn btn-primary"> <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <div class="sidebar__content p-4 pt-5">
                    <h1><a href="index.html" class="logo">Alice</a></h1>
                    <ul class="sidebar__menu">
                        <li><router-link :to="{name: 'Dashboard'}">Trang chủ</router-link></li>
                        <li><router-link :to="{name: 'CardIndex'}">Quản trị viên</router-link></li>
                        <li>
                            <router-link :to="{name: 'CardIndex'}">
                                <span class="w-100 d-inline-flex align-items-center justify-content-between">
                                    Sản phẩm <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </span>
                            </router-link>
                            <ul>
                                <li><router-link :to="{name: 'CardIndex'}">Danh sách thẻ</router-link></li>
                                <li><router-link :to="{name: 'CardIndex'}">Kho thẻ trống</router-link></li>
                            </ul>
                        </li>
                        <li><router-link :to="{name: 'CardIndex'}">Tin tức</router-link></li>
                        <li><router-link :to="{name: 'CardIndex'}">Cài đặt</router-link></li>
                    </ul>
                </div>
            </nav>
            <div class="mainContent">
                <div class="p-4 p-md-5 pt-5">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App',
    data() {
        return {
            toggleSidebar: true
        }
    }
}
</script>

<style>
body {
    font-family: poppins,Arial,sans-serif;
    font-size: 14px;
}
a {
    text-decoration: none!important;
}
ul {
    padding: 0px;
}
li {
    list-style: none;
}
.table th {
    padding: 16px 0px;
}
.pagination li {
    min-width: 30px;
    height: 30px;
    margin-right: 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--bs-gray-dark);
}
.pagination li.active{
    background: #004EF6;
    border-radius: 4px;
    color: #fff;
}
.pagination li a:focus {
    outline: none;
}
.mainContent {
    width: 100%;
    padding: 0;
    min-height: 100vh;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
}
.sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #866ec7;
    color: #fff;
    -webkit-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
    position: relative;
}

.sidebar.close {
    margin-left: -250px;

}

.sidebar .custom-menu {
    display: inline-block;
    position: absolute;
    top: 20px;
    right: 0;
    margin-right: -20px;
    -webkit-transition: .3s;
    -o-transition: .3s;
    transition: .3s;
}

.sidebar .custom-menu .btn.btn-primary {
    background: #6749b9;
    border-color: #6749b9;
}

.sidebar .custom-menu .btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.sidebar.close .custom-menu{
    margin-right: -50px;
}
.sidebar__content h1 {
    margin-bottom: 20px;
    font-weight: 700;
}

.sidebar__content h1 a {
    color: #fff;
}

.sidebar__menu li {
    padding: 8px 0px;
}

.sidebar__menu li ul {
    margin-top: 8px;
    padding-left: 16px;
}
.sidebar__menu li a{
    display: block;
    color: rgba(255,255,255,.8);
    font-size: 16px;
}
</style>