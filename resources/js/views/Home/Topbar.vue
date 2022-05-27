<template>
  <div class="topbar-container">
    <div class="topbar-wrapper">
      <input-search
        :products="products"
        :filterby="filterby"
        :fieldname="fieldname"
      > </input-search>
      <div class="topbar__account">
        <router-link to="/login">Đăng nhập</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import InputSearch from "../shared/InputSearch.vue";
export default {
  name: "home-top-bar",
  components: {
    InputSearch,
  },
  props: ["products", "filterby", "fieldname"],
};
</script>

<style>
.topbar-container {
  background: #fff;
  border-bottom: 1px #ddd solid;
  max-width: 100%;
  height: 50px;
  transition: all 0.3s ease-out;
}
.topbar-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;
  margin: 0 auto;
  max-width: 1200px;
  height: 50px;
}
@media screen and (max-width: 769px) {
  .input-autocomplete__box {
    min-width: 250px;
  }
}
</style>