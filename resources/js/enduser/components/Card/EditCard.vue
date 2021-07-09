<template>
    <main>
        <div class="d-none">
            <img src="/static/themes/thumb1.png">
            <img src="/static/themes/thumb2.png">
            <img src="/static/icons/icon3.jpg">
            <img src="/static/icons/icon4.jpg">
        </div>
        <template v-if="loadingFetch">
            <loading-full />
        </template>
        <div :loading="loadingFetch" class="profileEdit">
            <template v-if="tab == 1">
                <van-nav-bar
                    title="Chỉnh sửa trang cá nhân"
                    left-text="Back"
                    left-arrow
                    fixed
                    @click-left="onClickLeftNavbar"
                >
                <template #right>
                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                    <a  v-else @click.stop="saveCard">
                        <span class="van-nav-bar__text">Lưu</span>
                    </a>
                </template>
                </van-nav-bar>
                <card-background />
                <template  v-if="cardContent && cardContent.id"> 
                    <card-avatar />
                </template>
                <div class="profileEdit_name">
                    <input type="text" class="mt-3"
                        :value="cardContent.userName" 
                        @change="$store.commit('SET_CARD_NAME', $event.target.value)">
                </div>
                <div class="container pb-5">
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Email</label>
                        <input type="text" 
                            :value="cardContent.email" 
                            @change="$store.commit('SET_CARD_EMAIL', $event.target.value)" 
                            class="form-control form-control-custom">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="mb-2">Số điện thoại</label>
                        <input type="text" 
                            :value="cardContent.phoneNumber" 
                            @change="$store.commit('SET_CARD_PHONE_NUMBER', $event.target.value)" 
                            class="form-control form-control-custom">
                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="mb-2 d-flex w-100 align-items-center justify-content-between">
                            <span>Mô tả bản thân</span>
                            <small class="text-muted" v-if="cardContent.descr.length <= 250">{{ cardContent.descr.length }}/250</small>
                        </label>
                        <textarea class="form-control form-control-custom" 
                            :maxlength="250"
                            :rows="descInputHeight"
                            :value="cardContent.descr" 
                            @input="$store.commit('SET_CARD_DESC', $event.target.value)"></textarea>
                    </div>
                </div>

                <van-popup v-model="showQr">
                    <img :src="cardContent.qrCode" alt="">
                </van-popup>
                <img :src="cardContent.qrCode" class="d-none" alt="cache">

                <van-tabbar v-model="tab">
                    <van-tabbar-item name="1" icon="home-o"></van-tabbar-item>
                    <van-tabbar-item @click="showQr = true" name="1" icon="qr"></van-tabbar-item>
                    <van-tabbar-item name="2" icon="setting-o"></van-tabbar-item>
                    <van-tabbar-item @click="goToProfile" icon="user-o"></van-tabbar-item>
                </van-tabbar>
            </template>
            
            <template v-if="tab == 2">
                <van-nav-bar
                    title="Cài đặt"
                    left-text="Back"
                    left-arrow
                    fixed
                    @click-left="tab = 1"
                >
                <template #right>
                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                    <a  v-else @click.stop="saveCard">
                        <span class="van-nav-bar__text">Lưu</span>
                    </a>
                </template>
                </van-nav-bar>
                <div style="margin-top: 50px">
                    <van-collapse v-model="settingTab" accordion>
                        <van-collapse-item title="Giao diện" name="1">
                            <div class="px-2 d-flex align-items-center justify-content-between">
                                <label for="">Màu nền</label>
                                <input type="color" :value="cardContent.background_color" @change="$store.commit('SET_BACKGROUND_COLOR', $event.target.value)">
                            </div>
                        </van-collapse-item>

                        <van-collapse-item title="Bố cục" name="3">
                            <div class="px-2 d-flex align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:;" 
                                            :class="{'rounded-lg themeSelected': cardContent.theme == 1}" 
                                            @click="$store.commit('SET_THEME', 1)" 
                                            class="d-block">
                                            <img src="/static/themes/thumb1.png" class="img-fluid" style="max-height: 328px" alt="">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:;" 
                                            :class="{'rounded-lg themeSelected': cardContent.theme == 2}" 
                                            @click="$store.commit('SET_THEME', 2)" 
                                            class="d-block">
                                                <img src="/static/themes/thumb2.png" class="img-fluid" style="max-height: 328px" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </van-collapse-item>

                        <van-collapse-item title="Icons" name="4">
                            <div class="px-2 d-flex align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <a href="javascript:;" 
                                            :class="{'rounded-lg themeSelected': cardContent.iconTheme == 1}" 
                                            @click="$store.commit('SET_ICON_THEME', 1)" 
                                            class="d-block">
                                            <img src="/static/icons/icon3.jpg?v=1.1" class="img-fluid" style="max-height: 328px" alt="">
                                        </a>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <a href="javascript:;" 
                                            :class="{'rounded-lg themeSelected': cardContent.iconTheme == 2}" 
                                            @click="$store.commit('SET_ICON_THEME', 2)"
                                            class="d-block">
                                            <img src="/static/icons/icon4.jpg?v=1.1" class="img-fluid" style="max-height: 328px" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </van-collapse-item>

                        <van-collapse-item title="Liên kết  mạng xã hội" name="2">
                            <div class="profileEdit__social">
                                <van-empty v-if="cardContent.links.length <= 0" description="Chưa có liên kết MXH nào !" />

                                <template v-else>
                                <div class="qncard mb-4">
                                    <!-- <draggable 
                                        :move="onCardLinkMove"
                                        :list="cardContent.links"
                                        group="social">
                                    </draggable> -->
                                    <template v-for="link, key in cardContent.links">
                                        <div class="sociallItem mb-4 rounded-3 px-4 py-3 shadow d-flex align-items-center justify-content-between"  
                                            :key="key"
                                            v-if="listSocial && listSocial[link.type]"
                                            @click="openEditSocialLink(link)" >
                                            <template>
                                                <img :src="listSocial[link.type].thumb + '?v=1.1'" style="width: 35px; height: 35px" alt="">
                                                <h5>{{ listSocial[link.type].name }}</h5>
                                                <div v-on:click.stop.prevent="removeSocialLink(link)" 
                                                    v-if="!loadingRemoveLink[link.link_id] || Object.keys(loadingRemoveLink).length == 0">
                                                    <van-icon name="cross" />
                                                </div>
                                                <van-loading v-if="loadingRemoveLink[link.link_id] === true" type="spinner" />
                                            </template>
                                        </div>
                                    </template>
                                </div> 

                                </template>
                                <van-button color="#1989fa" class=" w-100" @click="selectSocialNetwork = true"> <b class="text-light">Thêm liên kết</b></van-button>
                                
                                <van-popup @closed="$store.commit('RESET_SOCIAL_EDIT')" v-model="selectSocialNetwork" round position="bottom" :style="{ height: '70%' }" >
                                    <div class="px-3 pt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h4>Mạng xã hội</h4>
                                            <img v-if="listSocial && listSocial[socialEdit.type] && socialEdit.type" :src="listSocial[socialEdit.type].thumb" style="width: 30px; height: 30px" alt="">
                                        </div>
                                        
                                        <div class="mt-4">
                                            <div class="d-flex">
                                                <input ref="editSocialLink" type="text" 
                                                    class="ps-0 rounded-0 form-control border-start-0 border-end-0 border-top-0 " 
                                                    :placeholder="isBank ? 'Số tài khoản' : 'Đường dẫn, Số điện thoại, Email,...'"
                                                    :value="socialEdit.link"
                                                    @change="$store.commit('SET_SOCIAL_EDIT', {link: $event.target.value})" 
                                                >
                                                <div>
                                                    <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                                                    <span v-else class="van-nav-bar__text cursor-pointer" @click="saveSocicalLink">Lưu</span>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row mt-4">
                                            <template v-for="(social, skey) in listSocial"> 
                                                <a class="col-3 mb-4 cusor-pointer" v-if="social.show" :key="skey" @click.stop="onSelectSocial(skey)">
                                                    <img :src="social.thumb + '?v=1.1'" class="img-fluid" alt="">
                                                </a>
                                            </template>
                                        </div>
                                    </div>
                                </van-popup>
                            </div>
                        </van-collapse-item>
                    </van-collapse>
                </div>
            </template>
            
        </div>
    </main>
</template>

<script>

import { getCardById, CardDTO, storeCard, saveCardAvatar, saveCardBackground, removeCardLink} from '../../../api/card'
import { uploadImage, uploadImageBase64 } from '../../../api/image'
import { getUrlImage } from '../../../ultis'
import CardAvatar from './CardAvatar'
import CardBackground from './CardBackground'
import LoadingFull from '../Loading/LoadingFull'
import { mapActions, mapState } from 'vuex'
import draggable from 'vuedraggable'

export default {
    components: {
        CardAvatar,
        CardBackground,
        LoadingFull,
        draggable
    },
    data() {
        return {
            tab: 1,
            showQr: false,
            listSocial: [],
            selectSocialNetwork: false,
            loadingRemoveLink: {},
            loadingSave: false,
            loadingFetch: false,
            settingTab: 1, 
            sortSocial: []
        }
    },
    async mounted() {
        await this.getCardInfo()
        this.sortSocial = this.cardContent.links
        this.listSocial = JSON.parse(window.SOCIAL_NETWORKS)
    },
    computed: {
        ...mapState({
            cardContent: state => state.card.cardContent,
            socialEdit: state => state.card.socialEdit
        }),

        descInputHeight() {
            let row = Math.floor(this.cardContent.descr.length / 35)

            return row <= 8 && row >= 0  ? row + 2 : 5
        },

        isBank() {
            return this.listSocial && this.listSocial[this.socialEdit.type] && this.socialEdit.type && this.listSocial[this.socialEdit.type]['appType'] == 'bank'
        }
    },
    methods: {
        onCardLinkMove() {
            //dung xoa
        },
        goToProfile() {
            window.location.href = this.cardContent.url
        },

        onSelectSocial(social) {
            this.$store.commit('SET_SOCIAL_EDIT', {
                type: social,
                link: this.listSocial[social]['uri']
            })
            this.$refs.editSocialLink.focus()
        },

        onClickLeftNavbar() {
            window.history.back();
        },

        openEditSocialLink(link) {
            this.$store.commit('SET_SOCIAL_EDIT', {
                id: link.link_id, 
                type: link.type,
                link: link.link
            })

            this.selectSocialNetwork = true
        },

        async removeSocialLink(link) {
            let tmp = {}
            tmp[link.link_id] = true
            this.loadingRemoveLink = tmp
            
            try {
                await removeCardLink(link.link_id, this.cardContent.id)
                this.loadingRemoveLink = {}
                const links = this.cardContent.links.filter( val => val.link_id != link.link_id)
                this.$store.commit('SET_CARD_LINKS', links)
            } catch (error) {
                console.log(error)
                this.loadingRemoveLink = {}
                
            }
            
        },

        async saveSocicalLink() {
            if(!this.socialEdit.id) {
                const link = {
                    card_id: this.cardContent.id,
                    link: this.socialEdit.link,
                    type: this.socialEdit.type,
                    sort: 0
                }
                this.$store.commit('PUSH_CARD_LINKS', link)
            } else {
                const links = this.cardContent.links.map( (val, key) => {
                    if(val.link_id == this.socialEdit.id) {
                        val.card_id = this.cardContent.id
                        val.link = this.socialEdit.link
                        val.type = this.socialEdit.type
                    }
                    val.sort = key

                    return val
                })
                
                this.$store.commit('SET_CARD_LINKS', links)
            }

            this.selectSocialNetwork = false
            await this.saveCard()
        },
        
        async getCardInfo() {
            const cardId = this.$route.params.id
            this.loadingFetch = true
            await this.$store.dispatch('getCardInfo', {id: cardId})
            this.loadingFetch = false
        },

        async saveCard() {
            this.loadingSave = true
            try {
                await this.$store.dispatch('saveCard')
                await this.getCardInfo()
                this.$notify({ type: 'success', message: 'Lưu thành công !', duration: 1000 })
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
.themeSelected {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
}
.profileEdit__social {
    /* margin-top: 50px; */
    /* padding: 16px; */
}

.profileEdit {
    padding-bottom: 40px;
    /* background-color: #F9FAFC; */
}
.profileEdit__back {
    -webkit-text-stroke: 2px #fff; /* width and color */
}

.profileEdit_name {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
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
    font-weight: bold;
    font-size: 18px;
    color: #333333d9;
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