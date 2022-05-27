<template>
  <div class="product__index">
    <admin-topbar
      :query="$store.product.query"
      urlSearch="/category"
      @onSearch="OnSearchEnter"
      @onPerpage="OnPerpageChange"
      :selected="+perpage"
    ></admin-topbar>
    <div>
      <spin-loading v-show="loading"></spin-loading>
      <div
        class="m-table__responsive"
        v-show="!loading"
      >
        <table class="m-table">
          <thead class="m-table__thead">
            <tr>
              <th>#</th>
              <th>Tên</th>
              <th>Giá</th>
              <th>Danh mục</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <product
              v-for="_product in products"
              :product="_product"
              :key="_product.id"
            ></product>
          </tbody>
        </table>
      </div>
    </div>
    <div
      id="pagination"
      v-if="!loading"
    >
      <pagination
        :currentPage="page"
        :lastPage="last_page"
        @OnPaginationClick="OnPaginationClick"
      ></pagination>
    </div>

  </div>
</template>

<script>
import Product from "./Product.vue";
import AdminTopbar from "../../shared/AdminTopBar.vue";
import Pagination from "../../shared/Pagination.vue";
import { getProducts } from "../../../actions/product";
import SpinLoading from "../../shared/SpinLoading.vue";

export default {
  name: "table-product-index",
  components: {
    Product,
    Pagination,
    AdminTopbar,
    SpinLoading,
  },

  created() {
    const query = this.$route.query;
    this.loading = true;
    this.fetchData(query);
    setTimeout(() => {
      this.loading = false;
    }, 2000);
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
    products: {
      get() {
        return this.$store.product.products;
      },
    },
    page() {
      return this.$store.product.page;
    },
    perpage() {
      return this.$store.product.perpage;
    },
    last_page() {
      return this.$store.product.last_page;
    },
  },
  methods: {
    //...actions,
    getProducts,
    OnSearchEnter(event) {
      const { value } = event.target;
      if (value != "") {
        this.query = value;
        this.getProducts(
          1,
          +this.$store.product.perpage,
          this.$store.product.sort,
          value
        );
      } else {
        this.getProducts(
          1,
          +this.$store.product.perpage,
          this.$store.product.sort
        );
      }
    },
    fetchData(query) {
      if (query.q) {
        this.getProducts(1, +this.perpage, this.$store.product.sort, query.q);
      } else {
        this.getProducts(
          1,
          +this.$store.product.perpage,
          this.$store.product.sort
        );
      }
    },
    OnPerpageChange(event) {
      this.getProducts(1, +event.target.value, this.$store.product.sort);
    },
    OnPaginationClick(page) {
      if (this.q == "") {
        this.getProducts(
          page,
          +this.$store.product.perpage,
          this.$store.product.sort
        );
      } else {
        this.getProducts(
          page,
          +this.$store.product.perpage,
          this.$store.product.sort,
          this.query
        );
        }
    },
  },
};
</script>
<style>
.loading {
  width: calc(100% + 250px);
}

.m-table__thead th {
  padding: 12px;
  font-size: 0.9rem;
  font-weight: 700;
}
</style>