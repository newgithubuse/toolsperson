<template>
  <div class="border">
    <h1
      class="displaycenter"
      style="margin-bottom:30px"
    >
      個人資料
    </h1>
    <div class="displaycenter h80p">
      <div class="form-group col-7 ">
        <div class="row">
          <div class="col-12">
            <h3>姓名</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div
              class="inlineblock"
              v-show="!modifyStatus"
            >
              <h5>{{user.name}}</h5>
            </div>
            <div class="inlineblock">
              <input
                type="text"
                v-show="modifyStatus"
                v-model="input.name"
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="displaycenter h80p">
      <div class="form-group col-7">
        <div class="row">
          <div class="col-12">
            <h3>信箱</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div
              class="inlineblock"
              v-show="!modifyStatus"
            >
              <h5>{{user.email}}</h5>
            </div>
            <div class="inlineblock">
              <input
                type="text"
                v-show="modifyStatus"
                v-model="input.email"
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="displaycenter h80p">
      <div class="form-group col-7">
        <div class="row">
          <div class="col-12">
            <h3>電話</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div
              class="inlineblock"
              v-show="!modifyStatus"
            >
              <h5>{{user.phone}}</h5>
            </div>
            <div class="inlineblock">
              <input
                type="text"
                v-show="modifyStatus"
                v-model="input.phone"
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-6 displaycenter">
            <button
              class="btn btn-primary"
              @click="modify"
              v-show="!modifyStatus"
            >修改資訊
            </button>
            <button
              class="btn btn-primary"
              @click="updateProfile"
              v-show="modifyStatus"
            >
              完成修改
            </button>
          </div>
          <div class="col-6 displaycenter">
            <button
              class="btn btn-light"
              @click="cancelmodify"
            >取消
            </button>
          </div>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
  .border {
    box-sizing: border-box;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .inlineblock {
    display: inline-block;
    justify-content: flex-end;
    width: 100%;
    text-align: left;
  }
  input {
    width: 100%;
    border-radius: 5px;
  }
  .h80p {
    height: 80px;
  }
</style>
<script>
  import store from "@/store";
  export default {
    data() {
      return {
        input: {
          name: "",
          email: "",
          phone: ""
        },
        modifyStatus: false
      };
    },
    computed: {
      user() {
        return this.$store.state.user;
      }
    },
    methods: {
      modify() {
        this.input.name = this.user.name;
        this.input.email = this.user.email;
        this.input.phone = this.user.phone;
        this.modifyStatus = true;
      },
      cancelmodify() {
        this.input.name = "";
        this.input.email = "";
        this.input.phone = "";
        this.modifyStatus = false;
      },
      updateProfile() {
        let localUser = JSON.parse(window.localStorage.getItem("user"));
        let oldemail = localUser.email;
        localUser.name = this.input.name;
        localUser.email = this.input.email;
        localUser.phone = this.input.phone;
        axios
          .patch("v1/user/profile/update", {
            oldemail: oldemail,
            name: localUser.name,
            email: localUser.email,
            phone: localUser.phone
          })
          .then(res => {
            console.log(localUser);
            window.localStorage.setItem("user", JSON.stringify(localUser));
            this.$store.dispatch("updateUserProfile", localUser);
            this.cancelmodify();
          })
          .catch(err => {});
      }
    }
  };
</script>