<template>
  <form class="input-autocomplete">
    <div class="input-autocomplete__box">
      <input
        class="input-autocomplete__input"
        v-model="search"
        autocomplete="off"
        @blur="unToggle"
        @focus="toggle"
        name="q"
      />
      <button
        class="input-autocomplete__button"
        type="submit"
        @click.stop.prevent="handleSearch"
      >
        <i
          class="bx bx-search input-autocomplete__icon"
          @click.stop.prevent="handleSearch"
        ></i>
      </button>

    </div>
    <div
      class="input-autocomplete__popover"
      v-show="visible && matches.length"
    >
      <div
        class="input-autocomplete__empty"
        v-show="!matches.length"
      >không tìm thấy {{search}}</div>
      <ul
        class="input-autocomplete__options"
        v-show="matches.length"
      >
        <li
          class="input-autocomplete__option"
          v-for="item in matches"
          :key="item[filterby]"
        >
          <router-link
            class="input-autocomplete__link"
            :to="`/${item.category_slug}/${item.product_slug}`"
          >
            {{item[fieldname]}}
          </router-link>
        </li>
      </ul>
    </div>
  </form>
</template>

<script>
export default {
  name: "input-search",
  props: ["products", "filterby", "fieldname", "value"],
  data() {
    return {
      search: "",
      visible: false,
    };
  },
  computed: {
    matches() {
      let init_suggest = [...this.products.slice(0, 5)];
      if (!this.search) {
        return init_suggest;
      }
      let result = this.products.filter((item) => {
        return item[this.filterby]
          .toLowerCase()
          .includes(this.search.toLowerCase());
      });
      return result;
    },
  },
  mounted() {
    this.search = this.$route.query.q;
  },
  methods: {
    toggle() {
      this.visible = true;
    },
    unToggle() {
      setTimeout(() => {
        this.visible = false;
      }, 500);
    },
    handleSearch(event) {
      if (this.search.length > 0) {
        let redirect = "/tim-kiem?q=" + this.search;
        this.$router.push(redirect);
      }
    },
  },
};
</script>

<style>
.input-autocomplete {
  position: relative;
}
.input-autocomplete__box {
  display: flex;
  min-width: 350px;
}
.input-autocomplete__button {
  cursor: pointer;
  border-radius: 0 3px 3px 0;
  overflow: hidden;
  border: 2px solid #eee;
}
.input-autocomplete__icon {
  font-size: 1.5rem;
  display: flex;
  align-items: center;

  font-weight: 700;
  color: #333;
}
.input-autocomplete__input:focus {
  outline: none;
  border: 2px solid #eee;
}
.input-autocomplete__input {
  border-radius: 3px 0 0 3px;
  border: 2px solid #eee;
  padding: 0 0 0 1rem;
  height: 40px;
  width: 100%;
}
.input-autocomplete__empty {
  text-align: center;
  color: #777;
}
.input-autocomplete__popover {
  background: #fff;
  position: absolute;
  top: 45px;
  left: 0;
  right: 0;
  z-index: 100;
  border-radius: 0 0 4px 4px;
  padding: 10px;
  transition: all 0.5s ease-out;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
  max-height: 170px;
  overflow: hidden;
}
.input-autocomplete__options {
  color: #777;
  font-size: 0.875em;
  font-weight: 400;
  list-style: none;
  padding: 0;
  margin-top: 5px;
  width: 100%;
}
.input-autocomplete__option {
  display: flex;
  padding: 4px 16px 4px;
}
.input-autocomplete__option:hover {
  background-image: linear-gradient(rgba(0 0 0 / 10%) 0 0);
}
.input-autocomplete__link {
  padding: 0;
  margin: 0;
  width: 100%;
  height: 100%;
}
</style>