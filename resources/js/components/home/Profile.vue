<template>
  <div class="border">
    <h1 class="displaycenter">
      個人資料
    </h1>
    <div class="displaycenter">
      <div class="form-group col-7 ">
        <div class="row">
          <div class="col-3">
            <label>name</label>
          </div>
          <div class="col-9">
            <div class="inlineblock">{{user.name}}</div>
          </div>
        </div>

      </div>
    </div>

    <div class="displaycenter mb">
      <div class="form-group col-7">
        <div class="row">
          <div class="col-3">
            <label>email</label>
          </div>
          <div class="col-9">
            <div class="inlineblock">{{user.email}}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="displaycenter">
      <div class="form-group col-7 ">
        <div class="row">
          <div class="col-3">
            <label>gender</label>
          </div>
          <div class="col-9">
            <div class="inlineblock">{{user.gender}}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="displaycenter mb">
      <div class="form-group col-7">
        <div class="row">
          <div class="col-3">
            <label>phone</label>
          </div>
          <div class="col-9">
            <div class="inlineblock">{{user.phone}}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-6 displaycenter">
            <button class="btn btn-primary">修改資訊
            </button>
          </div>
          <div class="col-6 displaycenter">
            <button class="btn btn-light">取消
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
    padding: 20px 30px;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
  .inlineblock {
    display: inline-block;
    width: 100%;
    text-align: right;
  }
</style>
<script>
  export default {
    computed: {
      user() {
        let localUser = JSON.parse(window.localStorage.getItem("user"));
        if (localUser.gender == 1) {
          localUser.gender = "Male";
        } else {
          localUser.gender = "Female";
        }
        return localUser;
      }
    },
    methods: {}
  };
</script>