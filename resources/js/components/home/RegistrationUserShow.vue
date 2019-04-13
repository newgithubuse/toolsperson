<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      報名者列表
    </h1>
    <div class="row">
      <div class="col-12 itemdisplay">
        <div
          class="row item mb bottomborderstyle"
          v-for="(item,index) in username"
          :key=index
        >
          <div class="col-lg-9 itemtextdisplay">
            <h3>{{item.name}}</h3>
          </div>
          <div class="col-lg-3 displayallcenter">
            <button
              type="submit"
              class="btn btn-primary mb"
              style="height:50px;display:block"
            >確認</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
  .border {
    padding: 10px 30px;
  }
  .bottomborderstyle {
    box-sizing: border-box;
    min-height: 100px;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
  }
  .titlestyle {
    line-height: 80px;
    box-sizing: border-box;
    border-bottom: 1px solid #dee2e6;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .item {
    transition: 0.5s;
    &:hover {
      transform: scale(1, 1.1);
      cursor: pointer;
    }
  }
  .itemdisplay {
    display: flex;
    flex-direction: column;
  }
  .itemtextdisplay {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
  }
</style>
<script>
  import store from "@/store";
  export default {
    data() {
      return {
        username: []
      };
    },
    computed: {},
    methods: {},
    mounted() {
      let user = JSON.parse(window.localStorage.getItem("user"));
      axios
        .get("v1/user/registration/get/" + this.$route.params.id, {
          params: {
            email: user.email
          }
        })
        .then(response => {
          let res = response.data;
          console.log(res);
          if (res.code == 1) {
            this.username = res.data;
          } else {
            alert(res.msg);
          }
        })
        .catch(err => {});
    }
  };
</script>

