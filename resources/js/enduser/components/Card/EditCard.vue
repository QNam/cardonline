<template>
    <div class="profileEdit">
        
        <template v-if="tab == 1">
            <van-nav-bar
                title="Chỉnh sửa trang cá nhân"
                left-text="Back"
                left-arrow
                fixed
                @click-left="onClickLeftNavbar"
            >
            <template #right>
                <a @click.stop="saveCard">
                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                    <span v-else class="van-nav-bar__text">Lưu</span>
                </a>
            </template>
            </van-nav-bar>
            <!-- <div class="profile_sum mb-4" :style="{'background-image': 'url(' + cardContent.background_img_url + ')'}">
                <input type="file" id="uploadBackground" class="d-none" @change="onBackgroundChanged">
                <div class="d-flex align-items-center justify-content-between">
                    <label for="uploadBackground" class="d-inline-block profileEdit_bg">
                        <i class="fas fa-camera me-1"></i> Chỉnh sửa ảnh bìa
                    </label>
                </div>
            </div> -->
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
            <div class="container pb-5">
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Email</label>
                    <input type="text" v-model="cardContent.email" class="form-control form-control-custom">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Số điện thoại</label>
                    <input type="text" v-model="cardContent.phoneNumber" class="form-control form-control-custom">
                </div>
                <div class="form-group mb-4">
                    <label for="" class="mb-2">Mô tả bản thân</label>
                    <textarea class="form-control form-control-custom" v-model="cardContent.descr"></textarea>
                </div>

                <a href="javascript:;" style="color: #1989fa" @click.stop="tab = 2">Chỉnh sửa liên kết MXH</a>
                <!-- <div class="profileEdit__save text-end mt-3" :class="{'loadingSave': loadingSave}">
                    <button @click="saveCard"><span class="d-none me-2"><i class="fas fa-circle-notch fa-spin"></i></span>Lưu</button>
                </div> -->
            </div>
        </template>
        
        <template v-if="tab == 2">
            <van-nav-bar
                title="Chỉnh sửa liên kết MXH"
                left-text="Back"
                left-arrow
                fixed
                @click-left="tab = 1"
            >
            <template #right>
                <a @click.stop="saveCard">
                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                    <span v-else class="van-nav-bar__text">Lưu</span>
                </a>
            </template>
            </van-nav-bar>
            <div v-if="cardContent.links" class="profileEdit__social">
                <van-empty v-if="cardContent.links.length <= 0" description="Chưa có liên kết MXH nào !" />

                <template v-else>
                <div class="qncard mb-4">
                    <div class="sociallItem mb-4 rounded-3 px-4 py-3 shadow d-flex align-items-center justify-content-between" 
                        v-for="link, key in cardContent.links" 
                        :key="key"
                        @click="openEditSocialLink(link)"
                        draggable="true">
                        <img :src="listSocial[link.type].thumb" style="width: 35px; height: 35px" alt="">
                        <h5>{{ listSocial[link.type].name }}</h5>
                        <van-icon v-if="loadingRemoveLink[link.link_id] === false || Object.keys(loadingRemoveLink).length == 0" 
                                    name="cross" 
                                    v-on:click.stop.prevent="removeSocialLink(link)" />
                        <van-loading v-if="loadingRemoveLink[link.link_id] === true" type="spinner" />
                    </div>
                </div> 

                </template>
                <van-button color="#1989fa" class=" w-100" @click="selectSocialNetwork = true"> <b class="text-light">Thêm liên kết</b></van-button>
                
                <van-popup @closed="resetEditLinks" v-model="selectSocialNetwork" round position="bottom" :style="{ height: '70%' }" >
                    <div class="px-3 pt-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4>Mạng xã hội</h4>
                            <img v-if="socialEdit.name" :src="listSocial[socialEdit.name].thumb" style="width: 30px; height: 30px" alt="">
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex">
                                <input ref="editSocialLink" type="text" v-model="socialEdit.link" class="ps-0 rounded-0 form-control border-start-0 border-end-0 border-top-0 " placeholder="Đường dẫn">
                                <div>
                                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                                    <span v-else class="van-nav-bar__text cursor-pointer" @click="saveSocicalLink">Lưu</span>
                                </div>
                            </div> 
                        </div>
                        <div class="row mt-4">
                            <template v-for="(social, skey) in listSocial"> 
                                <a class="col-2 mb-4 cusor-pointer" :key="skey" @click.stop="onSelectSocial(skey)">
                                    <img :src="social.thumb" class="img-fluid" alt="">
                                </a>
                            </template>
                        </div>
                    </div>
                </van-popup>
            </div>
        </template>
    </div>
</template>

<script>

import { getCardById, CardDTO, storeCard, saveCardAvatar, saveCardBackground, removeCardLink} from '../../../api/card'
import { uploadImage } from '../../../api/image'
import { getUrlImage } from '../../../ultis'

export default {
    data() {
        return {
            cardContent: new CardDTO(),
            tab: 1,
            listSocial: [],
            selectSocialNetwork: false,
            loadingRemoveLink: {},
            loadingSave: false,
            loadingFetch: false,
            socialEdit: {
                id: null,
                name: null,
                link: null
            }
        }
    },
    mounted() {
        this.getCardInfo()
        this.listSocial = JSON.parse(window.SOCIAL_NETWORKS)
    },
    methods: {
        resetEditLinks() {
            this.socialEdit.id = null
            this.socialEdit.name = null
            this.socialEdit.link = null
        },

        onSelectSocial(social) {
            this.socialEdit.name = social
            this.socialEdit.link = this.listSocial[social]['uri']
            this.$refs.editSocialLink.focus()
        },

        onClickLeftNavbar() {
            window.history.back();
        },

        openEditSocialLink(link) {
            this.socialEdit.id = link.link_id
            this.socialEdit.name = link.type
            this.socialEdit.link = link.link

            this.selectSocialNetwork = true
        },
        async removeSocialLink(link) {
            this.loadingRemoveLink[link.link_id] = true
            try {
                await removeCardLink(link.link_id)
                this.loadingRemoveLink = {}
                this.cardContent.links = this.cardContent.links.filter( val => val.link_id != link.link_id)
            } catch (error) {
                console.log(error)
                this.loadingRemoveLink = {}
                
            }
            
        },

        async saveSocicalLink() {
            if(!this.socialEdit.id) {
                this.cardContent.links.push({
                    card_id: this.cardContent.id,
                    link: this.socialEdit.link,
                    type: this.socialEdit.name
                })
            } else {
                this.cardContent.links = this.cardContent.links.map( val => {
                    if(val.link_id == this.socialEdit.id) {
                        val.card_id = this.cardContent.id,
                        val.link = this.socialEdit.link,
                        val.type = this.socialEdit.name
                    }

                    return val
                })
            }
            await this.saveCard()
            this.selectSocialNetwork = false
        },
        
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


        async onAvatarChanged(event) {
            const image = event.target.files[0]
            const rep = await uploadImage({image})
            saveCardAvatar(this.cardContent.id, rep.data.data.img)
            const img = getUrlImage(rep.data.data.img)

            this.cardContent.avatar_img = rep.data.data.img
            this.cardContent.avatar_img_url = img
        },

        async onBackgroundChanged(event) {
            const image = event.target.files[0]
            const rep = await uploadImage({image})
            saveCardBackground(this.cardContent.id, rep.data.data.img)
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
                this.$notify({ type: 'success', message: 'Lưu thành công !', duration: 1000 })
                this.getCardInfo()
            } catch(e) {
                console.log(e)
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
.profileEdit__social {
    margin-top: 50px;
    padding: 16px;
}

.profileEdit {
    padding-bottom: 40px;
    /* background-color: #F9FAFC; */
}
.profileEdit__back {
    -webkit-text-stroke: 2px #fff; /* width and color */
}
.profile_sum {
    margin-top: 50px;
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
    margin-top: 80px;
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

.form-control.form-control-custom {
    background: #FFFFFF;
    padding: 8px 0px;
    border: none;
    border-top: 1px solid #dedee0;
    box-sizing: border-box;
    border-radius: 0;
}
.form-control:focus {
    outline: none;
    box-shadow: none;
    border-color: #dedee0;
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