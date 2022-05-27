<template>
  <div>
    <div class="d-flex align-items-center justify-content-end">
      <router-link
        class="btn btn-warning"
        to="/category"
      ><i class="bx bx-left-arrow-alt"></i></router-link>
    </div>
    <form @submit="onSubmit">
      <div class="form-group">
        <label for="">tên danh mục</label>
        <input
          name="category_name"
          type="text"
          v-model="form.name"
          @blur="handleBlur"
          @input="handleChange"
          :focusable="focus.category_name ? focus.category_name : false"
          :class="(error.name ? 'has-error ' : '')+'form-control'"
        >
        <p v-if="error.name && focus.category_name">{{error.name}}</p>
      </div>
      <div class="form-group">
        <label for="">slug</label>
        <input
          name="slug"
          type="text"
          v-model="form.slug"
          @blur="handleBlur"
          @input="handleChange"
          :focusable="focus.slug ? focus.slug : false"
          :class="(error.slug ? 'has-error ' : '')+'form-control'"
        >
        <p v-if="error.slug && focus.slug">{{error.slug}}</p>
      </div>
      <button
        type="submit"
        class="btn btn-primary"
      >Lưu lại</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "productForm",
  props: {},
  data() {
    return {
      form: { name: "", slug: "" },
      focus: { category_name: false, slug: false },
      error: {},
      url: "http://localhost:8000/api",
    };
  },
  created() {
    const id = this.$route.params.id;
    if (this.$route.params.id) {
      this.getCategoryById(id);
    }
  },
  methods: {
    getCategoryById(id) {
      axios
        .get(this.url + "/getCategoryById/" + id)
        .then((data) => (this.form = data.data))
        .catch((error) => alert(error));
    },
    handleBlur(event) {
      const { name } = event.target;
      if (name === "category_name") {
        this.focus.category_name = true;
      }
      if (name === "slug") {
        this.focus.slug = true;
      }
    },
    handleChange(event) {
      this.formValidation();
    },
    onSubmit(e) {
      e.preventDefault();
      this.formValidation();
    },
    formValidation() {
      this.error = {};
      if (this.form.name.length < 3) {
        this.error.name = "Ít nhất 3 kí tự";
      }
      if (this.form.slug.length < 3) {
        this.error.slug = "Ít nhất 3 kí tự";
      }
    },
  },
};
</script>
<style scoped>
</style>