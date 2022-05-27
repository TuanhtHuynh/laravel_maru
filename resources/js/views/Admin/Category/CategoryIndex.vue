<template>
  <div class="table-container">
    <h1 class="table__header">Danh sách danh mục</h1>
    <table-category-index></table-category-index>
  </div>
</template>

<script>
import TableCategoryIndex from "./Index.vue";

export default {
  name: "category-index",
  components: {
    TableCategoryIndex,
  },
};
</script>

<style>
.table-container {
  min-width: 100%;
}
.table__header {
  font-weight: 400;
}
</style>