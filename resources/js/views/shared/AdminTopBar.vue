<template>
  <div class="v-admin_topbar">
    <div class="admin_topbar__search">
      <form
        :action="urlSearch"
        method="get"
      >
        <input
          class="admin_topbar__input"
          name="q"
          type="text"
          v-model="q"
          @keyup.enter="OnSearchEnter"
        />
        <button>
          <i class="bx bx-search admin_topbar__icon"></i>
        </button>
      </form>
    </div>
    <select
      class="admin_topbar__select"
      name="perpage"
      @change="OnPerpageChange"
    >
      <option
        v-for="perpage in perpagelist"
        :key="perpage"
        :selected="+selected == perpage"
        :value="perpage"
      >{{perpage}}</option>
    </select>
  </div>
</template>

<script>
export default {
  name: "admin-topbar",
  props: {
    query: { type: String },
    selected: { type: Number },
    urlSearch: { type: String },
  },
  data() {
    return { perpagelist: [5, 15, 25, 500] };
  },
  computed: {
    q: {
      get() {
        return this.query;
      },
      set(value) {
        this.$emit("update:query", value);
      },
    },
  },
  created() {
    this.q = this.query;
  },
  methods: {
    InputChange(event) {
      this.q = event.target.value;
    },
    OnSearchEnter(event) {
      this.$emit("onSearch", event);
    },
    OnPerpageChange(event) {
      if (event.target.value > 0) {
        this.$emit("onPerpage", event);
      }
    },
  },
};
</script>

<style scoped>
.v-admin_topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #ddd;
  padding: 10px;
  margin-bottom: 15px;
}
.admin_topbar__input,
.admin_topbar__select {
  border-radius: 3px;
  border: 1px solid var(--iq-primary);
  width: 150px;
  height: 30px;
}
.admin_topbar__input:focus,
.admin_topbar__select:focus {
  outline: none;
}
.admin_topbar__input {
  padding: 0 0 0 1rem;
}
.admin_topbar__icon {
  font-size: 1.5em;
  padding: 4px;
}
</style>