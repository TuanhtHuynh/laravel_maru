<template>
  <div class="home">
    <v-card-container
      class="home__discount"
      label="Giảm giá"
    >
      <div slot="vcontainer">
        <grid-product
          :loading="loading"
          :products="products_discount"
        />
      </div>
    </v-card-container>
    <v-card-container
      class="home__last"
      label="Mới nhất"
    >
      <div slot="vcontainer">
        <grid-product
          :loading="loading"
          prefix="last_"
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
import {
  getProducts,
  getLastProducts_Discount,
} from "../../actions/product.js";
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
    products_discount: {
      get() {
        return this.$store.product.products_discount;
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
        return this.$store.product.total_item;
      },
    },
  },
  created() {
    this.products = [];
    getLastProducts_Discount(5);
    getProducts(1, this.perpage, "asc");
  },
  methods: {
    inifinite() {
      if (this.page < this.last_page && this.total_item > 0) {
        this.loading = true;
        let page = this.page + 1;
        getProducts(page, this.perpage, "asc", true);
        setTimeout(() => {
          this.loading = false;
        }, 2000);
      }
    },
  },
};
</script>
<style>
.home__discount {
  margin: 1.5rem auto;
}
.home__last {
  margin: 1.5rem auto;
}
</style>