<template>
<div class="loginForm authForm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="authForm__wrap">
                    <h3 class="text-center mb-4">Đăng nhập</h3>
                    <p class="text-center error" v-if="error.loginFail">Tài khoản hoặc mật khẩu không chính xác </p>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" v-model.trim="$v.email.$model" placeholder="Email">
                        <span class="error" v-if="submited && !$v.email.required">Email không được bỏ trống !</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" v-model.trim="$v.password.$model" placeholder="Mật khẩu">
                        <span class="error" v-if="submited && !$v.password.required">Mật khẩu không được bỏ trống !</span>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>
                    <div class=" mt-5">
                        <button class="btn w-100 text-center" :class="{'loginLoading': loginLoading}" @click="login">
                            <span class="d-none me-1"><i class="fas fa-circle-notch fa-spin"></i></span>
                            Đăng nhập
                            </button>
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
import { required, maxLength } from 'vuelidate/lib/validators'
import { login } from '../../../api/card'

export default {
    data() {
        return {
            email: null,
            password: null,
            submited: false,
            loginLoading: false,
            error: {
                loginFail: false
            }
        }
    },
    validations: {
        email: {
            required,
            maxLength: maxLength(125)
        },
        password: {
            required,
            maxLength: maxLength(125),
        },
    },
    methods: {
        async login() {
            this.submited = true
            this.error.loginFail = false
            this.$v.$touch()

            if(this.$v.$invalid) {
                return false
            } 

            this.loginLoading = true

            try {
                const params = {
                    email: this.email,
                    password: this.password,
                }

                const rep = await login(params)
                const user = rep.data.data.data;
                window.location = process.env.MIX_APP_URL + user.id

                this.loginLoading = false
            } catch(e) {
                if(e.response) {
                    const rep = e.response
                    if(rep.status == 401) {
                        this.error.loginFail = true
                        this.password = null
                        this.submited = false
                    } 
                }
                this.loginLoading = false
            }
        }
    }
}
</script>

<style scoped>
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
    display: inline!important;
}

.loginLoading span i {
    color: #fff;
}
</style>