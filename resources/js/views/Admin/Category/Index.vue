<template>
  <div>
    <div
      class="maru-overlay-full"
      v-if="loading"
    ></div>
    <admin-topbar
      :query="$store.product.query"
      urlSearch="/admin/category"
      @onSearch="OnSearchEnter"
      @onPerpage="OnPerpageChange"
      :selected="+perpage"
    ></admin-topbar>
    <table class="m-table">
      <thead class="m-table__thead">
        <tr>
          <th class="m-table__header">#</th>
          <th class="m-table__header">Tên</th>
          <th class="m-table__header">slug</th>
          <th class="m-table__header"></th>
        </tr>
      </thead>
      <tbody>
        <category
          v-for="category in categories"
          :category="category"
          :key="category.id"
        />
      </tbody>
    </table>
  </div>
</template>

<script>
import Category from "./Category.vue";
import AdminTopbar from "../../shared/AdminTopBar.vue";
import { getCategories } from "../../../actions/categories.js";

export default {
  name: "table-category-index",
  components: {
    AdminTopbar,
    Category,
  },
  computed: {
    loading: {
      get() {
        return this.$store.category.loading;
      },
      set(value) {
        this.$store.category.loading = value;
      },
    },
    categories: {
      get() {
        return this.$store.category.categories;
      },
    },
    perpage: {
      get() {
        return this.$store.category.perpage;
      },
    },
    page: {
      get() {
        return this.$store.category.page;
      },
    },
  },
  mounted() {
    this.loading = true;
    this.loading = false;
    this.getCategories(1, 5, "asc");
  },
  methods: {
    getCategories,
    OnSearchEnter(event) {
      const { value } = event.target;
      if (value != "") {
        this.query = value;
        this.getCategories(
          1,
          +this.$store.category.perpage,
          this.$store.category.sort,
          value
        );
      } else {
        this.getCategories(
          1,
          +this.$store.category.perpage,
          this.$store.category.sort
        );
      }
    },
    OnPerpageChange(event) {
      this.getCategories(1, +event.target.value, this.$store.category.sort);
    },
  },
};
</script>
<style>
.m-table {
  width: 100%;
  background: #fff;
  border: 1p solid #d6d6d6;
  border-radius: 6px;
  border-collapse: collapse;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}
.m-table__thead {
  background: #f8f9fa;
}
.m-table__header {
  padding: 12px;
  font-size: 0.9rem;
  font-weight: 700;
}
</style>