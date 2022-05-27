<template>
  <div class="product-edit">
    <div class="product-edit__top">
      <h1 class="product__header">Thêm sản phẩm</h1>
      <router-link
        class="m-table__button m-table__button--primary"
        to="/admin/product"
      >Danh sách</router-link>
    </div>
    <product-form
      :categories="categories"
      :product="product"
      @submit="updateProduct"
    ></product-form>
  </div>
</template>

<script>
import ProductForm from "./ProductForm";
import { getCategories } from "../../../actions/categories.js";
import { editProduct } from "../../../actions/product.js";
export default {
  name: "product-edit-page",
  components: {
    ProductForm,
  },
  computed: {
    product: {
      get() {
        return this.$store.product.product_detail;
      },
    },
    categories: {
      get() {
        return this.$store.category.categories;
      },
      set(value) {
        this.$store.category.categories = value;
      },
    },
  },
  created() {
    getCategories(1, 0, "asc");
    editProduct(this.$route.params.id);
  },
  methods: {
    updateProduct() {},
  },
};
</script>

<style>
</style>