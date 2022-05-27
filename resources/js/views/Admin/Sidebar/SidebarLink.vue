<template>
  <router-link
    class="sidebar__link"
    :to="to"
  >
    <i
      class="sidebar__icon"
      :class="icon"
    ></i>
    <span
      class="sidebar__text"
      @click="logout"
    >
      <slot />
    </span>

  </router-link>
</template>

<script>
export default {
  name: "sidebar-link",
  props: ["to", "icon"],
  methods: {
    logout() {
      this.$emit("logout");
    },
  },
};
</script>

<style scoped>
.sidebar.toggle .sidebar__link {
  padding: 0.5em;
}
.sidebar__link {
  display: flex;
  align-items: center;
  width: 100%;
  height: 100%;
  color: #fff;
  font-weight: 400;
  padding: 0;
  text-decoration: none;
}
.sidebar__icon {
  display: flex;
  color: #fff;
  align-items: center;
  font-size: 1.5rem;
  justify-content: center;
  min-width: 50px;
}
.sidebar__text {
  font-weight: 400;
  visibility: hidden;
  opacity: 0;
}
.sidebar.toggle .sidebar__text {
  visibility: visible;
  opacity: 1;
}
</style>