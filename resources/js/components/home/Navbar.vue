<template>
  <div class="row mb">
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-dark"
      style="width: 100%;"
    >
      <router-link
        to="/search"
        class="navbar-brand"
      ><img
          src="https://picsum.photos/100/50/?random=100"
          alt="logo"
        >&nbsp;&nbsp;&nbsp;校園工具人派遣</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="collapse navbar-collapse justify-content-end"
        id="navbarSupportedContent"
      >
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link
              v-show="!loginstatus"
              class="nav-link"
              to="/register"
            >註冊</router-link>
          </li>
          <li class="nav-item">
            <router-link
              v-show="!loginstatus"
              class="nav-link"
              to="/login"
            >登入</router-link>
          </li>
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
            >刊登辦法</a>
          </li>
          <li class="nav-item">
            <a
              href="#"
              class="nav-link"
            >聯絡我們</a>
          </li>
          <li
            class="nav-item dropdown"
            v-show="loginstatus"
          >
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fas fa-user-alt"></i>
            </a>
            <div
              class="dropdown-menu"
              aria-labelledby="navbarDropdown"
            >
              <router-link
                to="/submit"
                class="dropdown-item"
              >我要刊登</router-link>
              <router-link
                to="/profile"
                class="dropdown-item"
              >個人資料</router-link>
              <router-link
                to="/history"
                class="dropdown-item"
              >刊登記錄</router-link>
              <div class="dropdown-divider"></div>
              <a
                class="dropdown-item"
                href="#"
                @click='logout'
              >登出</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
  import store from "@/store/index.js";
  import { router } from "@/main.js";
  export default {
    computed: {
      loginstatus() {
        return store.state.loginstatus;
      }
    },
    methods: {
      logout() {
        window.localStorage.removeItem("token");
        window.localStorage.removeItem("user");
        this.$store.dispatch("Logout", false);
        this.$router.push("/login");
      }
    }
  };
</script>
