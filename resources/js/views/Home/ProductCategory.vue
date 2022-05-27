<template>
  <div
    class="product-ctg"
    :key="$route.path"
  >
    <div
      class="maru-overlay"
      v-if="loading"
    ></div>
    <div
      class="product-ctg__error"
      v-if="products.length == 0"
    >{{error}}</div>
    <v-card-container
      v-else
      :label="cateName"
    >
      <div slot="vcontainer">
        <grid-product :products="products" />
      </div>
    </v-card-container>
  </div>
</template>

<script>
import { getProducts } from "../../actions/product.js";
import GridProduct from "./GridProduct.vue";
import VCardContainer from "./VCardContainer.vue";

export default {
  name: "home-product-category",
  components: {
    GridProduct,
    VCardContainer,
  },
  computed: {
    ctg_slug: {
      get() {
        return this.$route.params.category_slug;
      },
    },
    products: {
      get() {
        return this.$store.product.products;
      },
    },
    loading: {
      get() {
        return this.$store.product.loading;
      },
    },
    cateName: {
      get() {
        return this.$store.product.cateName;
      },
    },
    error: {
      get() {
        return this.$store.product.error;
      },
    },
  },
  created() {
    getProducts(1, 20, "asc", this.ctg_slug);
  },
};
</script>

<style>
.product-ctg {
  max-width: 1200px;
  padding: 0 10px;
  margin: 0 auto;
}
.product-ctg__error {
  background: #fff;
  width: 100%;
  margin: 10px auto;
  padding: 10px;
  border-left: 6px solid #dc3545;
  box-shadow: var(--bg-shadow);
  color: #333;
  border-radius: 3px;
}
</style>