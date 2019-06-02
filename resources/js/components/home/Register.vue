<template>
  <div class="border">
    <h1 class="displaycenter">
      會員註冊
    </h1>
    <form @submit.prevent="validateBeforeSubmit">
      <div class="form-col">
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="email">Email address</label>
            <input
              v-validate="{ required: true, email: true }"
              data-vv-as="email"
              name="email"
              type="email"
              class="form-control"
              placeholder="Enter email"
              v-model="input.email"
            >
            <div
              class="alert alert-danger"
              v-show="this.errors.has('email')"
            >
              {{ errors.first('email') }}
            </div>
          </div>
        </div>
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="password">Password</label>
            <input
              v-validate="{required : true ,alpha_num : true ,min : 6 ,max : 16}"
              data-vv-as="password"
              name="password"
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="input.password"
            >
            <div
              class="alert alert-danger"
              v-show="errors.has('password')"
            >
              {{ errors.first('password') }}
            </div>
          </div>
        </div>
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="password_confirmation">Password confirmation</label>
            <input
              v-validate="{required : true ,is : input.password}"
              data-vv-as="password_confirmation"
              name="password_confirmation"
              type="password"
              class="form-control"
              placeholder="Password confirmation"
            >
            <div
              class="alert alert-danger"
              v-show="errors.has('password_confirmation')"
            >
              {{ errors.first('password_confirmation') }}
            </div>
          </div>
        </div>
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="name">name</label>
            <input
              v-validate="{ required: true ,min : 2, max : 10}"
              data-vv-as="name"
              name="name"
              type="name"
              class="form-control"
              placeholder="Name"
              v-model="input.name"
            >
            <div
              class="alert alert-danger"
              v-show="errors.has('name')"
            >
              {{ errors.first('name') }}
            </div>
          </div>
        </div>
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="phone">phone</label>
            <input
              v-validate="{ required: true ,numeric : true ,length : 10}"
              data-vv-as="phone"
              name="phone"
              type="tel"
              class="form-control"
              placeholder="Phone"
              v-model="input.phone"
            >

            <div
              class="alert alert-danger"
              v-show="errors.has('phone')"
            >
              {{ errors.first('phone') }}
            </div>
            <small style="color:Orange">
              ex:09xxxxxxxx
            </small>
          </div>
        </div>
        <div class="displaycenter">
          <div class="form-group col-7">
            <label for="phone">gender</label>
            <div>
              <input
                type="radio"
                id="Female"
                name="Female"
                value=0
                class="radio"
                v-model="input.gender"
              >&nbsp;Male
              <input
                type="radio"
                id="Male"
                name="Male"
                value=1
                class="radio"
                v-model="input.gender"
              >&nbsp;Female
            </div>
          </div>
        </div>
        <div class="displaycenter">
          <button
            type="submit"
            class="btn btn-primary mb"
          >Submit</button>
        </div>
      </div>
    </form>

  </div>
</template>
<style scoped>
  h1 {
    padding: 30px;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .radio + .radio {
    margin-left: 30px;
  }
</style>

<script>
  export default {
    data() {
      return {
        input: {
          email: "",
          password: "",
          name: "",
          phone: "",
          gender: ""
        }
      };
    },
    methods: {
      validateBeforeSubmit() {
        this.$validator.validateAll().then(result => {
          if (result) {
            axios
              .post("v1/user/registered", this.input)
              .then(response => {
                let res = response.data;
                console.log(res);
                if (res.code == 1) {
                  alert(res.msg);
                  this.$router.push({ path: "/login" });
                } else {
                  alert(res.msg);
                }
              })
              .catch(err => {});
          } else {
            alert("請確認格式正確!");
          }
        });
      }
    }
  };
</script>






