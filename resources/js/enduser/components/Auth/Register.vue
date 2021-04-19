<template>
<div class="registerForm authForm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="authForm__wrap">
                    <h3 class="text-center mb-4">Đăng ký</h3>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Email" :class="{'form-control-error': submited && !$v.email.required}" v-model.trim="$v.email.$model">
                        <span class="error" v-if="submited && !$v.email.required">Email không được bỏ trống !</span>
                        <span class="error" v-if="submited && !$v.email.email && $v.email.required">Email không đúng định dạng !</span>
                        <span class="error" v-if="!emailUnique">Email đã được sử dụng ! </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Username</label>
                        <input type="text" class="form-control" placeholder="Username" :class="{'form-control-error': submited && !$v.userName.required}" v-model.trim="$v.userName.$model">
                        <span class="error" v-if="submited && !$v.userName.required">Họ tên không được bỏ trống ! </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Mã số thẻ</label>
                        <input type="text" class="form-control" placeholder="Card Number" :class="{'form-control-error': submited && !$v.cardId.required}" v-model.trim="$v.cardId.$model">
                        <span class="error" v-if="submited && !$v.cardId.required">Mã số thẻ không được bỏ trống ! </span>
                        <span class="error" v-if="!cardIdExists">Mã số thẻ không đúng hoặc đã được sử dụng ! </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Password" :class="{'form-control-error': submited && !$v.password.required}" v-model.trim="$v.password.$model">
                        <span class="error" v-if="submited && !$v.password.required">Mật khẩu không được bỏ trống ! </span>
                    </div>
                    <div class=" mt-5">
                        <button class="btn w-100 text-center" :class="{'registerLoading': loadingSubmit}" @click="register">
                            <span class="d-none me-1"><i class="fas fa-circle-notch fa-spin"></i></span>
                            Đăng Ký
                        </button>
                    </div>
                </div>
                <div class="authForm__footer mt-3">
                    <router-link :to="{name: 'Login'}">Đăng nhập</router-link>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import { checkCardIsExists, register } from '../../../api/card'

export default {
    data() {
        return {
            email: '',
            userName: '',
            cardId: '',
            password: '',

            submited: false,
            emailUnique: true,
            cardIdExists: true,

            loadingSubmit: false
        }
    },
    validations: {
        userName: {
            required,
            minLength: minLength(4),
            maxLength: maxLength(125)
        },
        email: {
            required,
            maxLength: maxLength(125),
            email
        },
        cardId: {
            required,
            maxLength: maxLength(125),
        },
        password: {
            required,
            maxLength: maxLength(125),
        },
    },

    mounted() { 
        if(this.$route.query && typeof this.$route.query.id !== 'undefined') {
            this.cardId = this.$route.query.id
        }
    },

    methods: {
        async register() {
            this.submited = true
            this.loadingSubmit = true
            this.$v.$touch()

            if(this.$v.$invalid) {
                return false
            } 

            const cardIdExists = await this.checkCardIsExists(this.cardId)
            const emailExists = await this.checkCardIsExists(this.email, 'email')
            
            this.cardIdExists = cardIdExists
            this.emailUnique = !emailExists

            if(!this.cardIdExists || !this.emailUnique) {
                this.loadingSubmit = false
                return false
            }

            const params = {
                cardId: this.cardId,
                userName: this.userName,
                email: this.email,
                password: this.password,
            }

            try {
                await register(params)

                this.$router.push({ name: 'Login' })
                this.loadingSubmit = false
            } catch($e) {
                console.log($e)
                this.loadingSubmit = false
                this.$notify({
                    type: 'error',
                    text: 'Có lỗi xảy ra! Vui lòng thử lại sau.'
                });
            }
        },

        async checkCardIsExists(value, type = 'cardId') {
            const params = {
                type: type,
                value: value
            }
            const rep = await checkCardIsExists(params)
            
            return rep.data.data.exists
        }
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

.registerLoading {
    opacity: .5;
    pointer-events: none;
}

.registerLoading span {
    display: inline!important;
}

.registerLoading span i {
    color: #fff;
}
</style>