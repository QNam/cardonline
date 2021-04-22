<template>
  <div>
    <template v-if="$route.name == 'EditCard'">
      <router-view></router-view>
    </template>  
    <template v-else>
      <div class="mainPage">
      <navbar />
      <notifications position="top right"/>
      <transition>
        <router-view></router-view>
      </transition>
      <Footer />
      </div>
    </template>
  </div>
</template>

<script>
import Navbar from './Template/Navbar'
import Footer from './Template/Footer'

export default {
  components: { Navbar, Footer },
  data() {
    return {
    }
  },

  methods: {
  },
}
</script>

<style scoped>
.mainPage {
  width: 100%;
  min-height: 100vh;
  background-image: url('https://access.pavietnam.vn/images/pink_new/images/bg_body.jpg');
  display: flex;
  flex-direction: column;
  justify-content: space-between
}
</style>