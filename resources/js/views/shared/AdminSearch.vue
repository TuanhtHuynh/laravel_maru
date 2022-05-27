<template>
  <div class="admin_topbar">
    <div class="admin_topbar__search">
      <input
        type="text"
        v-model="q"
        @keyup.enter="onSearch"
      />
      <button>
        <i class="bx bx-search icon"></i>
      </button>
    </div>
    <div class="admin_topbar__dropdown">
      <select
        name="perpage"
        @change="handlePerpageChange"
      >
        <option
          v-for="perpage in perpagelist"
          :key="perpage"
          :selected="selected == perpage"
          :value="perpage"
        >{{perpage}}</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  name: "admin-search",
  props: {
    q: { type: String },
    selected: { type: Number },
  },
  data() {
    return { perpagelist: [5, 10, 15, 500] };
  },
  methods: {
    handlePerpageChange(event) {
      this.$emit("onPerpageChange", event.target.value);
    },
    onSearch() {
      this.$emit("onSearch");
    },
  },
};
</script>

<style scoped>
</style>