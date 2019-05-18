<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      報名記錄
    </h1>
    <div class="row">
      <div class="col-12 itemdisplay">
        <div
          class="row item mb bottomborderstyle"
          v-for="(item,index) in history"
          :key=index
        >
          <div
            class="col-lg-2"
            style="overflow:hidden"
          >
            <img
              :src="item.img"
              alt=""
            >
          </div>
          <div class="col-lg-7 itemtextdisplay">
            <h3>{{item.title}}</h3>
            <h4>{{item.text}}</h4>
            <h5>刊登者 : {{item.name}}</h5>
          </div>
          <div class="col-lg-3 itemtextdisplay">
            <div>
              <button
                type="submit"
                class="btn btn-primary mb"
                style="height:50px;display:block"
                @click="cancelregistration(item.id)"
              >
                取消報名
              </button>
            </div>
            <div>
              <button
                type="submit"
                class="btn btn-info mb"
                style="height:50px;display:block"
                @click="checkstatus(item.id)"
              >
                查看狀態
              </button>
            </div>
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
      history() {
        return store.state.registrationhistory;
      }
    },
    methods: {
      cancelregistration(id) {
        axios
          .delete("v1/user/registration/delete/" + id)
          .then(response => {
            let res = response.data;
            this.$store.dispatch("deleteRegistration", res.data.id);
          })
          .catch(err => {
            console.log("取消失敗");
            console.log(err);
          });
      },
      checkstatus(id) {
        let user = JSON.parse(window.localStorage.getItem("user"));
        axios
          .get("v1/user/check/" + id, { params: { email: user.email } })
          .then(response => {
            let res = response.data;
            if (res.code == 1) {
              alert(res.data);
            } else {
              alert(res.msg);
            }
          })
          .catch(err => {
            console.log("get失敗");
            console.log(err);
          });
      }
    },
    mounted() {
      let user = JSON.parse(window.localStorage.getItem("user"));
      return axios
        .get("v1/user/registration/history", {
          params: {
            email: user.email
          }
        })
        .then(response => {
          let res = response.data;
          if (res.code == 1) {
            this.$store.dispatch("getRegistrationHistory", res.data);
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

