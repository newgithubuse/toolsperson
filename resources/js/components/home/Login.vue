<template>
  <div class="border">
    <h1 class="displaycenter">
      會員登入
    </h1>
    <div class="displaycenter">
      <div class="form-group col-7 ">
        <label for="email">Email address</label>
        <input
          class="form-control"
          placeholder="Enter email"
          v-model="input.email"
        >
      </div>
    </div>

    <div class="displaycenter mb">
      <div class="form-group col-7">
        <label for="Password">Password</label>
        <input
          class="form-control"
          placeholder="Password"
          type="password"
          v-model="input.password"
        >
      </div>
    </div>
    <div class="row mb">
      <div class="col-lg-2 col-0"></div>
      <div class="col-lg-8 col-12">
        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="row">
              <div class="col-lg-8 col-6 displaycenter">
                <button
                  class="btn btn-primary width80"
                  @click="login"
                >登入
                </button>
              </div>
              <div class="col-lg-4 col-6 displaycenter">
                <button class="btn btn-light width80">取消
                </button>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-0"></div>
        </div>
      </div>
      <div class="col-lg-2 col-0"></div>
    </div>
  </div>
</template>
<style scope>
  h1 {
    padding: 30px;
  }
  .width80 {
    width: 80%;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
</style>
<script>
  import store from "@/store";
  import { router } from "@/main.js";
  export default {
    data() {
      return {
        input: {
          email: "",
          password: ""
        }
      };
    },
    methods: {
      login() {
        axios
          .post("v1/auth/login", this.input)
          .then(response => {
            let res = response.data;
            // console.log(res);
            if (res.code == 1) {
              window.localStorage.setItem("token", res.data.token);
              window.localStorage.setItem("user", JSON.stringify(res.data.user));
              this.$router.push("/search");
            } else {
              alert(res.msg);
            }
          })
          .catch(err => {
            console.log("post失敗");
            console.log(err);
          });
        // this.$store.dispatch("Login", true);
      }
    }
  };
</script>