<template>
  <div class="home--productctg">
    <v-card-container
      class="home__cards--productctg"
      :label="cateName"
    >
      <div slot="vcontainer">
        <grid-product
          v-if="!loading"
          :loading="loading"
          prefix="pro-ctg_"
          :products="products"
        />
      </div>
    </v-card-container>
    <inifinite-scroll @inifinte="inifinite"></inifinite-scroll>
  </div>
</template>

<script>
import SpinLoading from "../shared/SpinLoading.vue";
import GridProduct from "./GridProduct.vue";
import VCardContainer from "./VCardContainer.vue";
import VFooter from "./Footer/VFooter.vue";
import FooterAddress from "./Footer/FooterAddress.vue";
import InifiniteScroll from "../shared/InifiniteScroll";
import { getProducts } from "../../actions/product.js";
export default {
  name: "home-index",
  components: {
    SpinLoading,
    GridProduct,
    VCardContainer,
    VFooter,
    FooterAddress,
    InifiniteScroll,
  },
  data() {
    return { perpage: 10 };
  },
  computed: {
    loading: {
      get() {
        return this.$store.product.loading;
      },
      set(value) {
        this.$store.product.loading = value;
      },
    },
    category_slug: {
      get() {
        return this.$route.params.category_slug;
      },
    },
    products: {
      get() {
        return this.$store.product.products;
      },
      set(value) {
        this.$store.product.products = value;
      },
    },
    cateName: {
      get() {
        return this.$store.product.cateName;
      },
    },
    page: {
      get() {
        return this.$store.product.page;
      },
      set(value) {
        this.$store.product.page = value;
      },
    },
    last_page: {
      get() {
        return this.$store.product.last_page;
      },
    },
    total_item: {
      get() {
        return this.$store.product.total;
      },
    },
  },
  created() {},
  mounted() {
    this.products = [];

    this.loading = true;
    getProducts(1, this.perpage, "asc", false, this.category_slug);
    this.loading = false;
  },
  methods: {
    inifinite() {
      if (this.page < this.last_page && this.total_item > 0) {
        this.loading = true;
        getProducts(
          this.page + 1,
          this.perpage,
          "asc",
          true,
          this.category_slug
        );
        setTimeout(() => {
          this.loading = false;
        }, 2000);
      }
    },
  },
};
</script>
<style>
body,
html {
  min-height: 100%;
}
/* .breadcrumbs {
  padding: 0 1rem;
} */
.home--productctg {
  height: 100%;
}
.home__cards--productctg {
  margin: 0 auto 1.5rem auto;
  min-height: 500px;
}
</style>