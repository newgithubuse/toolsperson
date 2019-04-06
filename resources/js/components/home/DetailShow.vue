<template>
  <div>
    <div class="alltocenter">
      <img
        :src="content.img"
        alt=""
      >
    </div>
    <div class="alltocentercolumn">
      <h1>{{content.title}}</h1>
      <h2>{{content.text}}</h2>
      <div style="text-align:center;word-break: break-all">
        <p>{{content.detial}}</p>
      </div>
    </div>
  </div>
</template>
<style>
  .alltocenter {
    display: flex;
    justify-content: center;
  }
  .alltocentercolumn {
    display: flex;
    align-items: center;
    flex-direction: column;
  }
</style>
<script>
  import store from "@/store";
  export default {
    computed: {
      content() {
        return this.$store.state.contents.find(item => {
          return item.id == this.$route.params.id;
        });
      }
    }
  };
</script>