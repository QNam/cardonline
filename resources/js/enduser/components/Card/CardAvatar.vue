<template>
    <div>
        <div class="profileEdit_avatar">
            <img :src="cardContent.avatar_img_url" alt="">
            <label class="profileEdit_avatar__upload" for="uploadAvatar">
                <i class="fas fa-camera"></i>
            </label>
            <input type="file" ref="uploadAvatar" id="uploadAvatar" class="d-none" @change="onAvatarChanged">
        </div>
        <van-popup v-model="modalEditImage" position="top" :style="{ height: '100%', width: '100%' }">
            <template v-if="loadingSave">
                <loading-full />
            </template>
            <template v-else>
                <van-nav-bar
                    title="Chỉnh sửa ảnh đại diện"
                    left-text="Hủy"
                    right-text="Lưu"
                    left-arrow
                    @click-left="onClickLeftMDEditImage"
                >
                <template #right>
                        <van-loading v-if="loadingSave" type="spinner" color="#1989fa" />
                        <a v-else @click.stop="saveImage">
                            <span class="van-nav-bar__text">Lưu</span>
                        </a>
                </template>
                </van-nav-bar>
                <photo-editor :img="imageEdit" @change="onChangePhotoEditor"/>
            </template>
        </van-popup>
    </div>
</template>

<script>
import PhotoEditor from '../Template/PhotoEditor'
import { mapState, mapActions } from 'vuex'
import LoadingFull from '../Loading/LoadingFull'

export default {
    props: {
        img: {
            type: String,
            default:'//cardonline.local/images/1619021148.png'
        }
    },
    components: {
        PhotoEditor,
        LoadingFull
    },
    data() {
        return {
            imagePreview: this.img,
            imageEdit: null,
            modalEditImage: false,
            imageCroped: null,
            loadingSave: false
        }
    },
    
    mounted() {
        let avartarCache = localStorage.getItem('FUKI_AVATAR')

        if(avartarCache) {
            this.$store.commit('SET_AVATAR_IMAGE_URL', avartarCache)
        }
    },

    computed: {
        ...mapState({
            cardContent: state => state.card.cardContent,
        }),
    },
    methods: {
        onClickLeftMDEditImage() {
            this.$refs.uploadAvatar.value = null
            this.modalEditImage = false
        },

        async saveImage() {
            this.loadingSave = true
            await this.$store.dispatch('uploadAvatar', this.imageCroped)
            this.loadingSave = false
            this.modalEditImage = false
            this.$refs.uploadAvatar.value = null
        },
        
        onChangePhotoEditor(img) {
            this.imageCroped = img
        },

        async onAvatarChanged(event) {
            const image = event.target.files[0]
            if(image.size >= 1500000) {
                this.$notify({ type: 'danger', message: 'Ảnh không quá 1.5MB', duration: 1500 })
                return
            }
            this.imageEdit = URL.createObjectURL(image)

            this.modalEditImage = true
        },
    }
}
</script>

<style scoped>
.profileEdit_avatar {
    border: 7px solid #fff;
    margin-top: -130px;
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
</style>