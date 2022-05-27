<template>
  <div class="product-container">
    <h1>Danh sách sản phẩm</h1>
    <div class="product-top">
      <div></div>
      <router-link
        class="m-button m-table__button--primary"
        :to="{name: 'product-new'}"
      >
        Thêm sản phẩm
      </router-link>
    </div>
    <table-product-index></table-product-index>
  </div>
</template>

<script>
import TableProductIndex from "./Index.vue";
export default {
  name: "product-index",
  components: {
    TableProductIndex,
  },
};
</script>

<style>
.product-container {
  width: 100%;
}
.product-top {
  display: flex;
  justify-content: space-between;
}
.m-button {
  height: 2.5rem;
  margin-bottom: 15px;
}
</style>