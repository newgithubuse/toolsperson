<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      刊登辦法
    </h1>
    <div class='item'>
      <h2 class='displaycenter'>
        <p>
          登入後點選我要刊登
        </p>
      </h2>
      <div class="imgdiv">
        <img
          src="../../../img/publish1.png"
          alt=""
        >
      </div>
    </div>
    <div class='item'>
      <h2 class="displaycenter">
        <p>輸入刊登事項相關事宜 確認無誤後點選傳送</p>
      </h2>
      <div class="imgdiv">
        <img
          src="../../../img/publish2.png"
          alt=""
        >
      </div>
    </div>
    <div class="item">
      <h2 class="displaycenter">
        <p>刊登過後返回首頁便能看到自己的刊登事項囉!</p>
      </h2>
      <div class="imgdiv">
        <img
          src="../../../img/publish3.png"
          alt=""
        >
      </div>
    </div>
    <div class="item">
      <h2 class="displaycenter">
        <p>若發現自己刊登內容有誤 可以點選修改刊登內容來更改資料喔!</p>
      </h2>
      <div class="imgdiv">
        <img
          src="../../../img/publish4.png"
          alt=""
        >
      </div>
    </div>
  </div>
</template>
<style scoped>
  .item + .item {
    margin-top: 60px;
  }
  img {
    width: 100%;
    height: 100%;
  }
  .imgdiv {
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .border {
    padding: 10px 30px;
  }
  .titlestyle {
    line-height: 80px;
    box-sizing: border-box;
    border-bottom: 1px solid #dee2e6;
  }
  .displaycenter {
    display: flex;
    justify-content: center;
  }
</style>
<script>
  import store from "@/store";
  export default {};
</script>