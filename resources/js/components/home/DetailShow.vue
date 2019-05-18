<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      刊登事項
    </h1>
    <div class="row mb">

      <div class="col-8">
        <h2 v-if="!update">{{content.title}}</h2>
        <div
          v-else
          class="displaycolumn"
        >
          <label>標題</label>
          <input
            type="text"
            v-model="input.title"
          >
        </div>

      </div>

      <div class="col-4 displayaligncenter">刊登者 : {{content.name}}</div>
    </div>
    <div class="row mb">
      <div class="col-7 displayaligncenter">
        <h3 v-if="!update">{{content.text}}</h3>
        <div
          v-else
          class="displaycolumn"
        >
          <label>內容</label>
          <input
            type="text"
            v-model="input.text"
          >
        </div>
      </div>
      <div class="col-5 imgdiv">
        <div v-if="!update">
          <img
            :src="content.img"
            alt=""
            style="width:300px;height:150px"
          >
        </div>
        <div
          v-else
          class="displaycolumn"
        >
          <label>圖片網址</label>
          <input
            type="text"
            v-model="input.img"
          >
        </div>
      </div>
    </div>
    <div class="row mb">
      <div class="col-12">
        <h5 v-if="!update">
          {{content.detail}}
        </h5>
        <div
          v-else
          class="displaycolumn"
        >
          <label>詳細內容</label>
          <textarea
            v-model="input.detail"
            name=""
            id=""
            cols="30"
            rows="10"
          ></textarea>
        </div>
      </div>
    </div>
    <div class="row mb">
      <div class="col-12 displaycenter">
        <button
          class="btn btn-primary"
          @click="submitRegistration"
          v-if="other"
        >報名委託</button>
        <div
          v-else
          class="row"
        >
          <button
            class="btn btn-primary"
            @click="updatesubmit"
            v-if="!update"
          >修改刊登內容</button>
          <div
            v-else
            class="col-12"
          >
            <div class="row">
              <div class="col-6">
                <button
                  class="btn btn-primary"
                  @click="updateObject"
                >更新</button>
              </div>
              <div class="col-6">
                <button
                  class="btn btn-light"
                  @click="cancel"
                >取消</button>
              </div>
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
  .imgdiv {
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .displaycolumn {
    display: flex;
    flex-direction: column;
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
        input: { title: "", text: "", detail: "", img: "" },
        update: false
      };
    },
    computed: {
      content() {
        return this.$store.state.contents.find(item => {
          return item.id == this.$route.params.id;
        });
      },
      other() {
        let user = JSON.parse(window.localStorage.getItem("user"));
        if (user.id == this.content.user_id) {
          return false;
        } else {
          return true;
        }
      }
    },
    methods: {
      submitRegistration() {
        let user = JSON.parse(window.localStorage.getItem("user"));
        axios
          .post("v1/public/registration/" + this.content.id, {
            email: user.email
          })
          .then(res => {
            console.log(res);
            alert(res.data.msg);
          })
          .catch(err => {
            console.log("post失敗");
            console.log(err);
          });
      },
      updatesubmit() {
        this.update = true;
      },
      updateObject() {
        this.input.email = JSON.parse(window.localStorage.getItem("user")).email;
        axios
          .patch("v1/user/update/" + this.$route.params.id, this.input)
          .then(response => {
            let res = response.data;
            if (res.code == 1) {
              this.$store.dispatch("updateObject", {
                data: res.data,
                id: this.$route.params.id
              });
              this.update = false;
              alert(res.msg);
            } else {
              this.update = false;
              alert(res.msg);
            }
          })
          .catch(err => {
            this.update = false;
            console.log("patch失敗");
            console.log(err);
          });
      },
      cancel() {
        this.update = false;
      }
    },
    mounted() {}
  };
</script>