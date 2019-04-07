<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      刊登事項
    </h1>
    <div class="row mb">

      <div class="col-8">
        <h2>{{content.title}}</h2>
      </div>

      <div class="col-4 displayaligncenter">刊登者 :</div>
    </div>
    <div class="row mb">
      <div class="col-7 displayaligncenter">
        <h3>{{content.text}}</h3>
      </div>
      <div class="col-5 imgdiv">
        <img
          :src="content.img"
          alt=""
        >
      </div>
    </div>
    <div class="row mb">
      <div class="col-12">
        <h5>
          {{content.detail}}
        </h5>
      </div>
    </div>
    <div class="row mb">
      <div class="col-12 displaycenter">
        <buttom class="btn btn-primary">報名委託</buttom>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
  .border {
    padding: 10px 30px;
  }
  .imgdiv {
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .titlestyle {
    line-height: 80px;
    box-sizing: border-box;
    border-bottom: 1px solid #dee2e6;
  }
  .displayaligncenter {
    display: flex;
    align-items: center;
  }
</style>
<script>
  import store from "@/store";
  export default {
    data() {
      return {
        username: ""
      };
    },
    computed: {
      content() {
        return this.$store.state.contents.find(item => {
          return item.id == this.$route.params.id;
        });
      }
    },
    methods: {},
    mounted() {}
  };
</script>