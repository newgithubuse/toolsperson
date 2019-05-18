<template>
  <div class="border">
    <h1 class="displaycenter titlestyle">
      聯絡我們
    </h1>
    <div
      class="displaycolumncenter"
      style="margin-bottom:20px;"
    >
      <label>訊息內容</label>
      <textarea
        placeholder="想對我們說的話..."
        cols="30"
        rows="10"
        style="width:100%"
      ></textarea>
    </div>
    <div class="displaycenter">
      <button class="btn btn-primary">傳送</button>
    </div>
  </div>
</template>
<style scoped>
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
  .displaycolumncenter {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>
<script>
  import store from "@/store";
  export default {};
</script>