<template>
  <div class="row mb">
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-dark"
      style="width: 100%;"
    >
      <!-- <a class="navbar-brand" href="#"><img src="https://picsum.photos/200/50/?random=100" alt="logo">&nbsp;&nbsp;&nbsp;校園工具人派遣</a> -->
      <router-link
        to="/"
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
              class="nav-link"
              to="/register"              
            >註冊</router-link>
          </li>
          <li class="nav-item active">
            <a
              class="nav-link"
              href="#"
            >登入/登出<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="#">我要刊登</a> -->
            <router-link
              to="/submit"
              class="nav-link"
            >我要刊登</router-link>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              幫助
            </a>
            <div
              class="dropdown-menu"
              aria-labelledby="navbarDropdown"
            >
              <a
                class="dropdown-item"
                href="#"
              >聯絡我們</a>
              <a
                class="dropdown-item"
                href="#"
              >刊登辦法</a>
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
  import { router } from "@/main.js";
  export default {
    methods: {
      logout() {
        window.localStorage.removeItem("loginstatus");
        this.$router.push("/login");
      }
    }
  };
</script>
