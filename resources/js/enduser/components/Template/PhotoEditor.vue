<template>
<div>
    <!-- :default-size="defaultSize" -->
    <!-- :resize-image="{
            adjustStencil: false
        }" -->
    <cropper
        ref="cropper"
        :src="img"
        :stencil-props="{
            handlers: {},
            movable: true,
            resizable: true,
        }"
        :stencil-size="stencilSize"
        image-restriction="stencil"
        @change="change"
    ></cropper>
    <div class="action-croppers">
        <a @click.stop="flip(true,false)" v-html="icons.flip_horizontally"></a>
        <a @click.stop="flip(false,true)" v-html="icons.flip_vertically"></a>
        <a @click.stop="rotate(90)" v-html="icons.rotate_right"></a>
        <a @click.stop="rotate(-90)" v-html="icons.rotate_left"></a>
    </div>
</div>
</template>

<script>
import { Cropper } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import icons from './icons'

export default {
    props: {
        img: {
            type: String,
            default:'//cardonline.local/images/1619021148.png'
        },
        stencilSize: {
            type: Object,
            default: function() {
                return {
                    width: 172,
                    height: 172
                }
            }
        }
    },
    components: {
        Cropper
    },
    data: function() {
        return {
            icons: icons
        }
    },
    methods: {
        defaultSize({ imageSize, visibleArea }) {
			return {
				width: (visibleArea || imageSize).width,
				height: (visibleArea || imageSize).height,
			};
		},

        change({coordinates, canvas}) {
            this.$emit('change', canvas.toDataURL())
            // console.log(coordinates, canvas)
            // console.log(canvas.toDataURL())
        },
        flip(x,y) {
			this.$refs.cropper.flip(x,y);
		},
		rotate(angle) {
			this.$refs.cropper.rotate(angle);
		},
    },
}
</script>

<style scoped>
.action-croppers {
    display: flex;
    margin-top: 10px;
    justify-content: center;
    /* flex-direction: column; */
}

.action-croppers a {
    background: rgba(0,0,0,.4);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 42px;
    width: 42px;
    margin-right: 10px;
    cursor: pointer;
    transition: background .5s;
}
</style>