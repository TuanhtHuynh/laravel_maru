<template>
  <div class="maru-container">
    <div class="maru__header">
      <mega-menu
        appname="Maru"
        @MenuToggle="MenuToggle"
      ></mega-menu>
      <home-top-bar
        :class="{menu__opening:menutoggle}"
        :products="products_filter"
        fieldname="product_name"
        filterby="product_name"
      ></home-top-bar>
      <v-carousel
        :class="{menu__opening:menutoggle}"
        v-show="showCarousel"
        :slides="topbars"
      ></v-carousel>
    </div>
    <div
      class="maru__content"
      :class="{menu__opening: menutoggle}"
    >
      <breadcrumb :routepath="path"></breadcrumb>
      <router-view />
    </div>
    <div
      class="home__footer"
      :class="{menu__opening: menutoggle}"
    >
      <v-footer></v-footer>
      <footer-address></footer-address>
    </div>
  </div>
</template>

<script>
import MegaMenu from "./MegaMenu/Menu.vue";
import HomeTopBar from "./Topbar.vue";
import VCarousel from "./Carousel/Carousel.vue";
import Breadcrumb from "../shared/Breadcrumb.vue";
import { getTopbarImage } from "../../actions/topbar.js";
import { getProductsSuggest } from "../../actions/product.js";
import VFooter from "./Footer/VFooter.vue";
import FooterAddress from "./Footer/FooterAddress.vue";

export default {
  components: {
    MegaMenu,
    HomeTopBar,
    VCarousel,
    Breadcrumb,
    VFooter,
    FooterAddress,
  },
  data: () => ({
    menutoggle: false,
  }),
  computed: {
    path: {
      get() {
        return this.$route.fullPath;
      },
    },
    categories: {
      get() {
        return this.$store.categories;
      },
    },
    topbars: {
      get() {
        return this.$store.topbar.topbars;
      },
    },
    products_filter: {
      get() {
        return this.$store.product.products_filter;
      },
    },
    showCarousel() {
      return (
        !this.$route.params.product_slug &&
        this.$route.path != "/tim-kiem" &&
        !this.$route.params.NotFound &&
        this.$route.path != "/gioi-thieu"
      );
    },
  },
  mounted() {
    getTopbarImage();
    getProductsSuggest(1, 0, "asc");
  },
  methods: {
    MenuToggle(istoggle) {
      this.menutoggle = istoggle;
    },
    getProductsfilter(value) {
      getProductsSuggest(1, 5, "asc", value);
    },
  },
};
</script>

<style>
.maru__header {
  display: flex;
  flex-direction: column;
  width: 100%;
}
.maru__content {
  margin-bottom: 1.5rem;
  transition: all 0.3s ease;
}
.home__footer {
  background: #fff;
  border-top: 1px solid #d6d6d6;
  padding: 30px 0 0;
  line-height: 1.7em;
  position: relative;
  z-index: 11;
}
@media screen and (max-width: 769px) {
  /* .nav__links.toggle .main_content {
    display: none;
  } */
  .menu__opening {
    display: none;
    transition: all 0.3s ease;
  }
}
</style>