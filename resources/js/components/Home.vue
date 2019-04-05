<template>
  <div
    class="container-fluid"
    v-scroll="showTop"
  >
    <Navbar></Navbar>
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-0 col-lg-2"></div>
          <div class="col-12 col-lg-8">
            <transition name="fade">
              <router-view></router-view>
            </transition>
          </div>
          <div class="col-0 col-lg-2"></div>
        </div>
      </div>
    </div>
    <div
      class="gotop"
      @click="gotop"
      ref="toolbarChat"
      :class="goTop?'topblock':''"
    >
      <p>↑</p>
    </div>
  </div>
</template>
<script>
  import Vue from "vue";
  import Sideleft from "@/components/home/Sideleft.vue";
  import Navbar from "@/components/home/Navbar.vue";
  export default {
    components: {
      Navbar
    },
    data() {
      return {
        goTop: false,
        scrollTop: ""
      };
    },
    methods: {
      gotop() {
        let speed = 10;
        let timer = setInterval(function() {
          this.scrollTop =
            document.documentElement.scrollTop ||
            window.pageYOffset ||
            document.body.scrollTop;
          if (this.scrollTop > 0) {
            this.scrollTop =
              this.scrollTop - speed > 0 ? this.scrollTop - speed : 0;
            speed += 20;
            window.scrollTo(0, this.scrollTop);
          } else {
            clearInterval(timer);
          }
        }, 16);
      },
      showTop() {
        this.scrollTop =
          document.documentElement.scrollTop ||
          window.pageYOffset ||
          document.body.scrollTop;
        if (this.scrollTop > 200) {
          this.goTop = true;
        } else {
          this.goTop = false;
        }
      }
    }
  };
</script>