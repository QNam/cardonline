<template>
    <div>
            <div class="profile_sum mb-4" :style="{'background-image': 'url(' + cardContent.background_img_url + ')'}">
                <input type="file"  ref="uploadBg" id="uploadBackground" class="d-none" @change="onBackgroundChange">
                <div class="d-flex align-items-center justify-content-between">
                    <label for="uploadBackground" class="d-inline-block profileEdit_bg">
                        <i class="fas fa-camera me-1"></i> Chỉnh sửa ảnh bìa
                    </label>
                </div>
            </div>
            <van-popup v-model="modalEditImage" position="top" :style="{ height: '100%', width: '100%' }">
                <template v-if="loadingSave">
                    <loading-full />
                </template>
                <template v-else>
                    <van-nav-bar
                        title="Chỉnh sửa ảnh bìa"
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
                    <photo-editor :stencilSize="stencilSize" :img="imageEdit" @change="onChangePhotoEditor"/>\
                </template>
            </van-popup>
    </div>
</template>

<script>
import PhotoEditor from '../Template/PhotoEditor'
import { mapActions, mapState } from 'vuex'
import LoadingFull from '../Loading/LoadingFull'

export default {
    components: {
        PhotoEditor,
        LoadingFull
    },
    data() {
        return {
            imageEdit: null,
            modalEditImage: false,
            imageCroped: null,
            loadingSave: false,
            stencilSize: {
                width: window.screen.width,
                height: 350
            }
        }
    },
    computed: {
        ...mapState({
            cardContent: state => state.card.cardContent,
        }),
    },
    mounted() {
        let backgroundCache = localStorage.getItem('FUKI_BACKGROUND')

        if(backgroundCache) {
            this.$store.commit('SET_BACKGROUND_IMAGE_URL', backgroundCache)
        }
    },
    methods: {
        onClickLeftMDEditImage() {
            this.$refs.uploadBg.value = null
            this.modalEditImage = false
        },

        onBackgroundChange(event) {
            const image = event.target.files[0]
            if(image.size >= 1500000) {
                this.$notify({ type: 'danger', message: 'Ảnh không quá 1.5MB', duration: 1500 })
                return
            }
            this.imageEdit = URL.createObjectURL(image)

            this.modalEditImage = true
        },

        async saveImage() {
            this.loadingSave = true
            await this.$store.dispatch('uploadBackground', this.imageCroped)
            this.loadingSave = false
            this.modalEditImage = false
        },

        onChangePhotoEditor(img) {
            this.imageCroped = img
        }
    },

}
</script>

<style scoped>
.profile_sum {
    background-size: cover;
    margin-top: 50px;
    min-height: 256px;
    padding: 20px;
    background-color: #ccc;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.profileEdit_bg {
    padding: 4px 16px;
    border-radius: 8px;
    background-color: #fff;
    border: none;
    font-weight: 500;
}

</style>