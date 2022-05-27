<template>
  <form>
    <div class="form-group">
      <label for="">tên danh mục</label>
      <input
        name="category_name"
        type="text"
        class="form-control"
      >
    </div>
    <div class="form-group">
      <label for="">slug</label>
      <input
        name="slug"
        type="text"
        class="form-control"
      >
    </div>
    <button
      class="btn btn-primary"
    >Lưu lại</button>
  </form>
</template>

<script>
export default {
  name: "newform",
};
</script>
<style scoped>
</style>