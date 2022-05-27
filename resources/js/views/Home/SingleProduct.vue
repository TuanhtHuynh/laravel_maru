<template>
  <div class="product-single-container">
    <spin-loading v-if="loading"></spin-loading>
    <div
      class="product-single"
      v-if="!loading"
    >
      <div class="product-single__image">
        <img :src="buildImageUrl(product.imageUrl)">
      </div>
      <div class="product-single__info">
        <div class="product-single__name">{{product.product_name}}</div>
        <span
          class="product-single__price"
          :class="{'product-single__price--disabled': product.price_discount>0}"
        >{{product.price | format-vnd}}đ
        </span>
        <span
          class="product-single__price--sub"
          v-show="product.price_discount>0"
        >{{product.price_discount | format-vnd}}đ
        </span>
        <div class="product-single__description">
          {{product.product_description}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { getProductDetail } from "../../actions/product.js";
import SpinLoading from "../shared/SpinLoading.vue";
export default {
  components: {
    SpinLoading,
  },
  computed: {
    loading: {
      get() {
        return this.$store.product.loading;
      },
    },
    product: {
      get() {
        return this.$store.product.product_detail;
      },
    },
    product_slug: {
      get() {
        return this.$route.params.product_slug;
      },
    },
    category_slug: {
      get() {
        return this.$route.params.category_slug;
      },
    },
  },
  mounted() {
    getProductDetail(this.category_slug, this.product_slug);
  },
  methods: {
    buildImageUrl(image) {
      if (!image) return "/img/no-image.jpg";
      return `/img/${image}`;
    },
  },
};
</script>

<style>
body {
  background: #eee;
}
.product-single-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 6px 1rem;
  min-height: 500px;
}
.product-single {
  background: #fff;
  border-radius: 2px;
  border: 1px solid var(--border-light);
  display: flex;
  box-shadow: var(--bg-shadow);
  line-height: 1.5;
}
.product-single__info {
  padding: 10px 22px;
  flex: 1;
}
.product-single__image {
  border-radius: 3px;
  overflow: hidden;
  flex-basis: 30%;
}
.product-single__image img {
  width: 100%;
  height: auto;
}
.product-single__name {
  font-size: 22px;
  font-weight: bold;
  color: #464646;
  margin-bottom: 10px;
}
.product-single__price {
  font-size: 16px;
  color: #333;
  font-weight: 700;
  position: relative;
  white-space: nowrap;
  margin-right: 10px;
  margin-bottom: 10px;
}
.product-single__price--sub {
  font-weight: 500;
}
.product-single__price--disabled {
  text-decoration: line-through;
  color: #aaa;
  font-weight: 400;
}
/* .product-single__price:not(:empty)::after {
  content: "đ";
  position: absolute;
  top: -9;
  left: 100%;
  font-size: 12px;
  margin-bottom: 10px;
} */
.product-single__description {
  font-size: 1rem;
  color: #464646;
  margin-bottom: 10px;
}
</style>