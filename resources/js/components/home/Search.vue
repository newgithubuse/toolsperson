<template>
  <div>
    <div class="row mb displaycenter">
      <form class="form-inline my-2 my-lg-0">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          v-model.trim="search"
        >
      </form>
    </div>
    <div class="row mb">
      <div v-if="loading">loading......</div>
      <div
        class="col-12"
        style="padding: 5px 15px"
        v-else
      >
        <div class="card-deck displaycenter">
          <div
            class="card"
            v-for="(item,index) in typetitle"
            @click="itemclick(index)"
            :key=index
          >
            <img
              class="card-img-top"
              :src="item.img"
              alt="Card image cap"
              style="width:300px;height:150px"
            >
            <div class="card-body">
              <h5 class="card-title">{{item.title}}</h5>
              <p class="card-text">{{item.text}}</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">發佈時間&nbsp;:&nbsp;{{item.createdatetime}}</small><br>
              <small class="text-muted">{{item.footer}}</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-1">
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
  .displaycenter {
    display: flex;
    justify-content: center;
  }
</style>

<script>
  import store from "@/store/index.js";
  import router from "vue-router";

  export default {
    data: function() {
      return {
        search: "",
        loading: false
      };
    },
    computed: {
      content() {
        return store.state.contents;
      },
      typetitle() {
        if (this.search != "") {
          return this.content.filter(item => {
            let content = item.title.toLowerCase();
            let keyword = this.search.toLowerCase();
            return content.indexOf(keyword) != -1;
          });
        } else {
          return this.content;
        }
      }
    },
    methods: {
      itemclick(index) {
        let target = this.content[index];
        this.$router.push({ name: "detailshow", params: { id: target.id } });
      }
    }
  };
</script>