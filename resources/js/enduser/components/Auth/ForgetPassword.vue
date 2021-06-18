<template>
<div class="registerForm authForm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="authForm__wrap">
                    <h3 class="text-center mb-4">Quên mật khẩu</h3>
                    <span class="error" v-if="!cardIdExists">Email hoặc mã xác nhận khi mua hàng không chính xác !</span>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Email" v-model.trim="$v.email.$model">
                        <span class="error" v-if="submited && !$v.email.required">Email không được bỏ trống !</span>
                        <span class="error" v-if="submited && !$v.email.email && $v.email.required">Email không đúng định dạng !</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Mã xác nhận</label>
                        <input type="text" class="form-control" placeholder="Mã xác nhận" v-model.trim="$v.confirmCode.$model">
                        <span class="error" v-if="submited && !$v.confirmCode.required">Mã xác nhận không được bỏ trống ! </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Password" v-model.trim="$v.password.$model">
                        <span class="error" v-if="submited && !$v.password.minLength">Mật khẩu lớn hơn 6 ký tự ! </span>
                        <span class="error" v-if="submited && !$v.password.required">Mật khẩu không được bỏ trống ! </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Password" v-model.trim="$v.repeatPassword.$model">
                        <span class="error" v-if="submited && !$v.repeatPassword.sameAsPassword"> Mật khẩu không khớp! </span>
                    </div>
                    <div class=" mt-5">
                        <button class="btn w-100 text-center" :class="{'is-loading': loadingSubmit}" @click="sendForgetPassword">
                            <span class="d-none me-1"><i class="fas fa-circle-notch fa-spin"></i></span>
                            Đổi mật khẩu
                        </button>
                    </div>
                </div>
                <div class="authForm__footer mt-3">
                    <a href="/login">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { required, minLength, maxLength, email, sameAs } from 'vuelidate/lib/validators'
import { checkAccountToForgetPassword, forgetPassword } from '../../../api/card'

export default {
    data() {
        return {
            email: '',
            password: '',
            repeatPassword: '',
            confirmCode: '',

            submited: false,
            cardIdExists: true,
            loadingSubmit: false
        }
    },
    validations: {
        email: {
            required,
            maxLength: maxLength(125),
            email
        },
        confirmCode: {
            required,
        },
        password: {
            required,
            minLength: minLength(6),
            maxLength: maxLength(125),
        },
        repeatPassword: {
            sameAsPassword: sameAs('password')
        }
    },

    mounted() { 
    },

    methods: {
        async sendForgetPassword() {
            this.submited = true
            this.loadingSubmit = true
            this.$v.$touch()

            if(this.$v.$invalid) {
                this.loadingSubmit = false
                return false
            } 
            try {
                const rep = await checkAccountToForgetPassword({email: this.email, confirm_code: this.confirmCode})
                this.cardIdExists = rep.data.data.exists
                
                const repForgetPassword = await forgetPassword({
                    email: this.email, 
                    confirm_code: this.confirmCode,
                    password: this.password
                })

                this.loadingSubmit = false
                window.location.href = '/login'
            } catch($e) {
                console.log($e)
                this.loadingSubmit = false
                this.$notify({
                    type: 'danger',
                    message: 'Có lỗi xảy ra! Vui lòng thử lại sau.'
                });
            }
        },
    }
}
</script>

<style scoped>
span.error {
    font-size: 11px;
    color: #dc3333;
    margin-top: 8px;
    font-weight: bold;
}

.is-loading {
    opacity: .5;
    pointer-events: none;
}

.is-loading span {
    display: inline!important;
}

.is-loading span i {
    color: #fff;
}
</style>