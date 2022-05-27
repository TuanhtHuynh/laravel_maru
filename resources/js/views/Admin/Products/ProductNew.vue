<template>
  <div class="product-new">
    <div class="product-new__top">
      <h1 class="product__header">Thêm sản phẩm</h1>
      <router-link
        class="m-table__button m-table__button--primary"
        to="/admin/product"
      >Danh sách</router-link>
    </div>
    <product-form
      :categories="categories"
      @submit="createProduct"
    ></product-form>
  </div>
</template>

<script>
import ProductForm from "./ProductForm.vue";
import { getCategories } from "../../../actions/categories.js";
import { addProduct } from "../../../actions/product.js";
export default {
  name: "product-new",
  components: {
    ProductForm,
  },
  data() {
    return {
      product: {
        product_name: "",
        category: {},
        price: 0,
        quantily: 1,
        imageUrl: "",
      },
    };
  },
  computed: {
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
  },
  destroyed() {
    this.categories = [];
  },
  methods: {
    createProduct(value) {
      this.product = value;
      this.product.imageUrl = "cxcx";
      this.$forceUpdate();
      addProduct(this.product);
    },
  },
};
</script>

<style>
.product-new__top {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>