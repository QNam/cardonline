<template>
<div class="loginForm authForm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="authForm__wrap">
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
                <div class="authForm__footer mt-3">
                    <a href="">Quên mật khẩu</a>
                    <router-link :to="{name: 'Register'}">Tạo tài khoản mới</router-link>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style scoped>
</style>