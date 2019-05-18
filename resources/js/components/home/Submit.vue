<template>
  <div>
    <div class="border">
      <h1 class="displaycenter">會員刊登</h1>
      <div class="displaycenter">
        <div class="form-group col-7 ">
          <label>標題</label>
          <input
            type="input"
            class="form-control"
            id="colFormLabel"
            placeholder="徵人主題"
            v-model.trim="input.title"
          >
        </div>
      </div>
      <div class="displaycenter">
        <div class="form-group col-7 ">
          <label>內容</label>
          <input
            type="input"
            class="form-control"
            id="colFormLabel"
            placeholder="服務內容"
            v-model.trim="input.text"
          >
        </div>
      </div>
      <div class="displaycenter">
        <div class="form-group col-7 ">
          <label>詳細內容敘述</label>
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="5"
            placeholder="詳細內容"
            v-model="input.detail"
          ></textarea>
        </div>
      </div>
      <div class="displaycenter">
        <div class="form-group col-7 ">
          <label>圖片網址</label>
          <input
            type="input"
            class="form-control"
            id="colFormLabel"
            placeholder="圖片網址"
            v-model.trim="input.img"
          >
        </div>
      </div>
      <div class="row mb">
        <div class="col-12">
          <div class="displaycenter">
            <div class="col-2"></div>
            <div class="col-8">
              <div class="row">
                <div class="col-6">
                  <div class="displaycenter">
                    <button
                      class="btn btn-primary"
                      @click="submithandler"
                    >傳送</button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="displaycenter">
                    <button
                      class="btn btn-light"
                      @click="cancelhandler"
                    >取消</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .btn-primary {
    width: 80%;
  }
  .btn_light {
    width: 80%;
  }
</style>
<script>
  import store from "@/store";
  import moment from "moment";
  export default {
    data: function() {
      return {
        input: {
          img: "https://picsum.photos/300/150/?random=14",
          title: "",
          text: "",
          footer: "",
          createdatetime: "",
          detail: "",
          email: ""
        },
        loading: false
      };
    },
    methods: {
      submithandler() {
        if (this.input.title && this.input.text && this.input.img) {
          this.loading = true;

          this.input.email = JSON.parse(
            window.localStorage.getItem("user")
          ).email;
          this.input.createdatetime = moment().format("YYYY-MM-DD HH:mm:ss");
          this.input.footer = moment(
            this.input.createdatetime,
            "YYYYMMDD HH:mm:ss"
          ).fromNow();
          axios
            .post("v1/user/submit", this.input)
            .then(response => {
              let res = response.data;
              if (res.code == 1) {
                this.cancelhandler();
                this.loading = false;
                this.$store.commit("setcontents", res.data);
                this.$router.push({ path: "/search" });
              } else {
                alert(res.msg);
              }
            })
            .catch(err => {
              console.log("post失敗");
              console.log(err);
            });
        } else {
          return;
        }
      },
      cancelhandler() {
        this.input.title = "";
        this.input.text = "";
        this.input.img = "";
      }
    }
  };
</script>
