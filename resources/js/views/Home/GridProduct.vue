<template>
  <div class="product-container">
    <div
      class="product-card"
      v-for="product in products"
      :key="`${prefix ? prefix : ''}${product.id}`"
    >

      <div
        class="product-card__image"
        :class="{'is-sk-loading': loading}"
      >
        <router-link :to="`/${product.category.category_slug}/${product.product_slug}`">
          <img :src="`/img/${product.imageUrl}`" />
        </router-link>
      </div>
      <div class="product-card__info">
        <div
          class="product-card__name"
          :class="{'is-sk-loading': loading}"
        >
          <router-link :to="`/${product.category_slug}/${product.product_slug}`">
            {{product.product_name | truncate-text}}
          </router-link>
        </div>

        <div
          class="product-card__description"
          :class="{'is-sk-loading': loading}"
        >
          <span>
            {{product.product_description | truncate-text(27)}}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "grid-product",
  props: ["products", "loading", "prefix"],
  computed: {
    isloading: {
      get() {
        return this.$parent.loading;
      },
    },
  },
};
</script>
<style scoped>
body {
  background: #eee;
}
.product-container {
  padding: 0.3em;
  margin: 0 auto;
  display: grid;
  min-height: 228px;
  grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
  column-width: 200px;
  grid-column-gap: 12px;
  grid-row-gap: 12px;
}
.product-card {
  background: #fff;
  /* box-shadow: 0 10px 1rem rgba(0, 0, 0, 0.1); */
  border: 1px solid #dfdfdf;
  overflow: hidden;
  width: 100%;
}
.is-sk-loading {
  position: relative;
  background: #e2e2e2;
  overflow: hidden;
}
.is-sk-loading::before {
  position: absolute;
  content: "";
  width: 100%;
  height: 100%;
  left: 0;
  transform: translateX(-100%);
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.2),
    transparent
  );
  animation: sk-loading 1.5s infinite;
}

@keyframes sk-loading {
  100% {
    transform: translateX(100%);
  }
}
.product-card__image.is-sk-loading img {
  visibility: hidden;
}

.product-card__image {
  width: 100%;
  height: auto;
  overflow: hidden;
}
.product-card__image img {
  width: 100%;
  min-height: 156.6px;
  transition: 0.5s ease-in-out;
  transform-origin: right;
}
.product-card:hover img {
  transform: scale(1.5);
}
.product-card__info {
  padding: 10px;
}
.product-card__name.is-sk-loading a,
.product-card__description.is-sk-loading span {
  visibility: hidden;
}
.product-card__name {
  margin-bottom: 10px;
  font-size: 0.875rem;
  font-weight: 700;
  color: #333;
}

.product-card__description {
  margin-bottom: 10px;
  font-size: 0.75rem;
  color: #777;
}

@media screen and (max-width: 769px) {
  .product-container {
    padding: 0.3em;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-width: 50%;
    grid-column-gap: 12px;
    grid-row-gap: 12px;
  }
}
</style>