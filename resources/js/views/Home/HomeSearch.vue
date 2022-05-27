<template>
  <div class="home-search">

    <div
      class="home-search__info"
      v-show="!loading && products.length"
    >
      {{products.length}} kết quả với từ khoá
      <span class="home-search__query">"{{query}}"</span>
    </div>
    <v-card-container class="home-search__cards">
      <div slot="vcontainer">
        <grid-product
          :loading="loading"
          prefix="sch_"
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
  name: "home-search",
  components: {
    SpinLoading,
    GridProduct,
    VCardContainer,
    VFooter,
    FooterAddress,
    InifiniteScroll,
  },
  data() {
    return { perpage: 20 };
  },
  computed: {
    query() {
      if (this.$route.query.q) {
        return this.$route.query.q;
      }
      return "";
    },
    loading: {
      get() {
        return this.$store.product.loading;
      },
      set(value) {
        this.$store.product.loading = value;
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
    getProducts(1, this.perpage, "asc", false, "", this.query);
  },
  methods: {
    inifinite() {
      if (this.total_item > 0 && this.page < this.last_page) {
        this.loading = true;
        setTimeout(() => {
          getProducts(this.page + 1, this.perpage, "asc", true, "", this.query);
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
.home-search {
  max-width: 1170px;
  margin: 0 auto;
}
.home-search__info {
  margin: 1.5rem 0px;
  color: #444;
}
.home-search__query {
  color: #dc3545;
}
.home-search__cards {
  margin: 0 auto 1.5rem auto;
}
.home__footer {
  background: #fff;
  border-top: 1px solid #d6d6d6;
  padding: 30px 0 0;
  line-height: 1.7em;
  position: relative;
  z-index: 11;
  margin: 0;
}
</style>