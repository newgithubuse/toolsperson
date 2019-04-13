<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      刊登記錄
    </h1>
    <div class="row">
      <div class="col-12 itemdisplay">
        <div
          class="row item mb bottomborderstyle"
          v-for="(item,index) in userobject"
          :key=index
        >
          <div
            class="col-lg-2"
            style="overflow:hidden"
            @click="itemclick(index)"
          >
            <img
              :src="item.img"
              alt=""
            >
          </div>
          <div
            class="col-lg-7 itemtextdisplay"
            @click="itemclick(index)"
          >
            <h3>{{item.title}}</h3>
            <h4>{{item.text}}</h4>
          </div>
          <div class="col-lg-3 displayallcenter">
            <button
              type="submit"
              class="btn btn-primary mb"
              style="height:50px;display:block"
              @click="registrationcheck(index)"
            >查看報名者</button>
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
  .displayallcenter {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
    computed: {
      userobject() {
        return store.state.userobject;
      }
    },
    methods: {
      itemclick(index) {
        let target = this.userobject[index];
        this.$router.push({ name: "detailshow", params: { id: target.id } });
      },
      registrationcheck(index) {
        let target = this.userobject[index];
        this.$router.push({
          name: "registrationuser",
          params: { id: target.id }
        });
      }
    },
    mounted() {
      let user = JSON.parse(window.localStorage.getItem("user"));
      return axios
        .get("v1/user/get", {
          params: {
            email: user.email
          }
        })
        .then(response => {
          let res = response.data;
          if (res.code == 1) {
            this.$store.dispatch("getUserObject", res.data);
          } else {
            alert(res.msg);
          }
        })
        .catch(err => {
          console.log("get使用者物件失敗");
          console.log(err);
        });
    }
  };
</script>

