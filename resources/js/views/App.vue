<template>
  <router-view :key="$route.path"></router-view>
</template>

<script>
import { getCategoriesPromise } from "../actions/categories";

export default {
  name: "App",
  mounted() {
    getCategoriesPromise().then((data) => {
      this.addSingleProductRouteFromCategories(data);
    });
  },
  methods: {
    addSingleProductRouteFromCategories(ctg) {
      let { routes } = this.$router.options;
      let routeData = routes.find((r) => r.path === "/");
      routeData.children.splice(0, 1);
      ctg.forEach((category) => {
        routeData.children.push({
          // push single product
          path: `/${category.slug}/:product_slug`,
          name: `${category.slug}-product`,
          component: () => import("./Home/SingleProduct.vue"),
        });
      });
      this.$router.addRoutes([routeData]);
    },
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;0,700;1,400&display=swap");
:root {
  --iq-primary: #11abd6;
  --primary: #007bff;
  --foody-primary: #e60505;
  --foody-secord: #b30404;
  --foody-second-2: #ea4b4b;
  --foody-border: #6b5050;
  --m-light: #fdfaff;
  --border-light: #d6d6d6;
  --bg-shadow: 0px 1px 4px 0px #0a0a0a26;
  --product-card-width: 222px;
}
body,
html {
  min-height: 100vh;
}
body {
  font-family: "Roboto", sans-serif;
  font-weight: 400;
  overflow-x: hidden;
  background: #eee;
  box-sizing: border-box;
}
.maru__content {
  z-index: 0;
  width: 100%;
  display: block;
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

.fade-enter,
.fade-leave-to {
  opacity: 0;
  transform: translateX(2em);
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3 ease;
}
@media screen and (max-width: 769px) {
  .main_content {
    padding-top: 60px;
  }
}
.vue-color {
  background: var(--success);
  text-align: center;
  padding: 6px 12px;
  color: #fff;
}

.maru-overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 99;
  background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0 0);
  display: block;
}
.maru-overlay-full {
  position: fixed;
  width: 100%;
  height: 100%;
  overflow: hidden;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: 99;
  background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0 0);
  display: block;
}
form label {
  font-weight: 600;
}
form button {
  float: right;
}
tr td button {
  display: flex;
  align-content: center;
}
table i {
  color: #fff;
}
.error-border {
  border: 1px solid var(--danger) !important;
  outline: none !important;
  box-shadow: none !important;
}

.v-flex {
  display: flex;
  align-items: center;
}
.v-justify-center {
  justify-content: center;
}
.v-justify-around {
  justify-content: space-between;
}
</style>
