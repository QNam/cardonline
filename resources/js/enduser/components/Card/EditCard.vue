<template>
    <div class="profileEdit" v-loading="loadingFetch">
        <template v-if="tab == 1">
            <div class="profile_sum mb-4" :style="{'background-image': 'url(' + cardContent.background_img_url + ')'}">
                <input type="file" id="uploadBackground" class="d-none" @change="onBackgroundChanged">
                <!-- <a href="" class="profileEdit__back"><i class="fas fa-chevron-left me-2"></i> Trang cá nhân</a> -->
                <div class="d-flex align-items-center justify-content-between">
                    <label for="uploadBackground" class="d-inline-block profileEdit_bg">
                        <i class="fas fa-camera me-1"></i> Chỉnh sửa ảnh bìa
                    </label>
                    <div class="dropdown">
                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-align-justify"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="javascript:;" @click="tab = 1">Thay đổi thông tin</a></li>
                            <li><a class="dropdown-item" href="javascript:;" @click="tab = 2">Mạng xã hội</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="profileEdit_avatar">
                <img :src="cardContent.avatar_img_url" alt="">
                <label class="profileEdit_avatar__upload" for="uploadAvatar">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" id="uploadAvatar" class="d-none" @change="onAvatarChanged">
            </div>
            <div class="profileEdit_name">
                <input type="text" v-model="cardContent.userName" class="mt-3">
            </div>
            <div class="container">
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Email</label>
                    <input type="text" v-model="cardContent.email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Số điện thoại</label>
                    <input type="text" v-model="cardContent.phoneNumber" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="mb-2">Mô tả bản thân</label>
                    <textarea class="form-control"  v-model="cardContent.descr"></textarea>
                </div>
                <div class="profileEdit__save text-end mt-3" :class="{'loadingSave': loadingSave}">
                    <button @click="saveCard"><span class="d-none me-2"><i class="fas fa-circle-notch fa-spin"></i></span>Lưu</button>
                </div>
            </div>
        </template>
        <template v-if="tab == 2">
            <div class="profileEdit__social">
                <div class="container">
                    <div class="profileEdit__header mb-4 d-flex align-items-center justify-content-between">
                        <i @click="tab = 1" class="fas fa-chevron-left"></i>
                        <h3>Mạng xã hội</h3>
                        <div class="dropdown">
                            <span id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-align-justify"></i>
                            </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="javascript:;" @click="tab = 1">Thay đổi thông tin</a></li>
                                <li><a class="dropdown-item" href="javascript:;" @click="tab = 2">Mạng xã hội</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex selectSocial__item mb-2" v-for="(link, lind) in cardContent.links" :key="lind">
                        <el-input placeholder="Đường dẫn" v-model="link.link" class="input-with-select">
                            <el-select v-model="link.type" slot="prepend" placeholder="" value-key="name">
                                <el-option v-for="(social, key, index) in listSocial" :key="index" :value="key">
                                    <img class="social-icon me-2" :src="social.thumb" alt="">
                                </el-option>
                            </el-select>
                        </el-input>
                    </div>
                    <button class="selectSocial__item__add mt-3" @click="socialItemAdd"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </template>
        <template v-if="tab == 3">

        </template>
    </div>
</template>

<script>

import { getCardById, CardDTO, storeCard } from '../../../api/card'
import { uploadImage } from '../../../api/image'
import { getUrlImage } from '../../../ultis'

export default {
    data() {
        return {
            cardContent: new CardDTO(),
            tab: 1,
            listSocial: [],
            loadingSave: false,
            loadingFetch: false,
        }
    },
    mounted() {
        this.getCardInfo()
        this.listSocial = JSON.parse(window.SOCIAL_NETWORKS)
    },
    methods: {
        async getCardInfo() {
            this.loadingFetch = true
            const rep = await getCardById(this.$route.params.id)
            const data = rep.data.data

            this.cardContent = new CardDTO(data)
            
            if(!this.cardContent.links) {
                this.cardContent.links = []
                this.cardContent.links.push(CardDTO.setDefaultLinksFormat())
            }
            this.loadingFetch = false
        },

        socialItemAdd() {
            this.cardContent.links.push(CardDTO.setDefaultLinksFormat())
        },

        async onAvatarChanged(event) {
            const image = event.target.files[0]
            const rep = await uploadImage({image})

            const img = getUrlImage(rep.data.data.img)

            this.cardContent.avatar_img = rep.data.data.img
            this.cardContent.avatar_img_url = img
        },

        async onBackgroundChanged(event) {
            const image = event.target.files[0]
            const rep = await uploadImage({image})

            const img = getUrlImage(rep.data.data.img)

            this.cardContent.background_img = rep.data.data.img
            this.cardContent.background_img_url = img
        },

        async saveCard() {
            const params = {
                id: this.cardContent.id,
                userName: this.cardContent.userName,
                phoneNumber: this.cardContent.phoneNumber,
                email: this.cardContent.email,
                descr: this.cardContent.descr,
                background_img: this.cardContent.background_img,
                avatar_img: this.cardContent.avatar_img,
                links: this.cardContent.links
            }

            this.loadingSave = true
            
            try {
                await storeCard(params)
                this.$notify.success({
                    message: 'Lưu thành công !',
                });
                this.getCardInfo()
            } catch(e) {

            } finally {
                this.loadingSave = false
            }
        }
    },
}
</script>
<style>
.social-icon {
    width: 20px;
    height: 20px;
    object-fit: cover;
}
.selectSocial__item .el-input-group__prepend {
    width: 20%;
}
/* .selectSocial__item .el-input>.el-input__inner {
    border-left: none;
}
.selectSocial__item .el-select {
    width: 20%;
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
}
.selectSocial__item .el-select input.el-input__inner{
    border-right: none;
    border-left: 1px solid #DCDFE6;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;

} */
</style>
<style scoped>
.profileEdit__header {
    padding-top: 12px
}
.profileEdit__header h3{
    font-size: 18px;
}

.selectSocial__item__add {
    border: 1px dashed rgb(57 117 237);
    color: rgb(57 117 237);
    width: 100%;
    background-color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
}

.selectSocial__item__add i {
    color: rgb(57 117 237);
}
.profileEdit {
    padding-bottom: 40px;
    /* background-color: #F9FAFC; */
}
.profileEdit__back {
    -webkit-text-stroke: 2px #fff; /* width and color */
}
.profile_sum {
    min-height: 350px;
    padding: 20px;
    background-color: #ccc;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.profileEdit_name {
    display: flex;
    align-items: center;
    justify-content: center;
     margin-bottom: 40px;
}

.profileEdit_bg {
    padding: 4px 16px;
    border-radius: 8px;
    background-color: #fff;
    border: none;
    font-weight: 500;
}

.profileEdit_avatar {
    margin-top: -132px;
    width: 172px;
    height: 172px;
    border-radius: 50%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    position: relative;
}

.profileEdit_avatar__upload {
    position: absolute;
    bottom: 2px;
    right: 20px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #242526;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.profileEdit_avatar__upload i {
    color: #fff;
}

.profileEdit_avatar img {
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: 100%;
}

.profileEdit_name input {
    border: none;
    outline: none;
    background-color: transparent;
    text-align: center;
    font-size: 24px;
}
.profileEdit_name input:focus {
    border-bottom: 2px solid rgb(145, 143, 143);
}

.form-control {
    background: #FFFFFF;
    padding: 8px 16px;
    border: 1px solid #dedee0;
    box-sizing: border-box;
    border-radius: 12px;
}

.form-group label{
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;

    /* anvuinew/gray80 */

    color: #646D84;
}

.profileEdit__save button {
    /* align-items: center;
    justify-content: center; */
    padding: 4px 24px;
    border-radius: 4px;
    background-color: rgb(57 117 237);
    color: #fff;
    font-weight: 700;
    border: none;
}

.profile_sum .dropdown  button{
    border-radius: 50%;
    width: 32px;
    height: 32px;
    background-color: #fff;
    border: none;
}

.loadingSave {
    opacity: .5;
    pointer-events: none;
}

.loadingSave span {
    display: inline!important;
}
.loadingSave span i {
    color: #fff;
}

</style>