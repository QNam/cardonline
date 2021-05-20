<template>
<div>
    <!-- :default-size="defaultSize" -->
    <!-- :resize-image="{
            adjustStencil: false
        }" -->
    <cropper
        :src="img"
        :stencil-props="{
            handlers: {},
            movable: false,
            resizable: false,
        }"
        :stencil-size="stencilSize"
        image-restriction="stencil"
        @change="change"
    ></cropper>
</div>
</template>

<script>
import { Cropper } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';

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
        }
    },
}
</script>

<style>

</style>