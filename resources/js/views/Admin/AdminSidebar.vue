<template>
  <div
    class="sidebar "
    :class="{toggle: isToggle}"
  >
    <div class="sidebar__header">
      <div class="sidebar__header__text">
        Maru
      </div>
      <i
        @click="isToggle=!isToggle"
        class="bx sidebar__toggle"
        :class="{'bx-chevron-left': isToggle, 
        'bx-chevron-right': !isToggle}"
      ></i>
    </div>
    <div class="sidebar__menu">
      <ul class="sidebar__links">
        <li class="sidebar__item">
          <sidebar-link
            to="/admin/dashboard"
            icon="bx bx-tachometer"
          >
            Dashboard
          </sidebar-link>
          <!-- <router-link
            class="sidebar__link"
            to="/"
          >
            <i class="bx bx-tachometer sidebar__icon"></i>
            <span class="sidebar__text">Dashboard</span>
          </router-link> -->
        </li>
        <li class="sidebar__item">
          <sidebar-link
            :to="{name: 'admin-category-index'}"
            icon="bx bx-spreadsheet"
          >
            Category
          </sidebar-link>
        </li>
        <li class="sidebar__item">
          <sidebar-link
            to="/admin/product"
            icon="bx bx-package"
          >
            Product
          </sidebar-link>
        </li>
        <li class="sidebar__item">
          <sidebar-link
            to="/admin/user"
            icon="bx bx-user"
          >
            User
          </sidebar-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import SidebarLink from "./Sidebar/SidebarLink.vue";

export default {
  name: "admin-sidebar",
  components: {
    SidebarLink,
  },
  data: () => ({
    isToggle: true,
  }),
  methods: {
    logout() {
      this.$emit("logout");
    },
  },
};
</script>

<style>
.sidebar {
  display: flex;
  background: #212121;
  transition: all 0.3s ease;
  color: #fff;
  width: 50px;
  flex: 1 1 auto;
  flex-direction: column;
  min-height: 100vh;
  margin: 0;
}
.sidebar__text {
  visibility: hidden;
}
.sidebar.toggle {
  width: 250px;
}
.sidebar__header {
  color: #fff;
  font-size: 1.5rem;
  padding-left: 50px;
  align-items: center;
  position: relative;
  height: 50px;
  margin-bottom: 20px;
}
.sidebar.toggle .sidebar__header__text {
  visibility: visible;
  opacity: 1;
}
.sidebar__header__text {
  display: flex;
  align-items: center;
  padding-left: 0.5em;
  height: 100%;
  visibility: hidden;
  opacity: 0;
}
.sidebar__toggle {
  display: flex;
  color: #fff;
  position: absolute;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #212529;
  border-radius: 50%;
  right: -16px;
  top: 50%;
  transform: translateY(-50%);
  width: 30px;
  height: 30px;
  cursor: pointer;
}
.sidebar__menu {
  display: flex;
  flex-direction: column;
  height: 100%;
}
.sidebar__links {
  width: 100%;
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar__item {
  width: 100%;
  display: flex;
  align-items: center;
  border-radius: 6px;
  height: 50px;
  border-bottom: 1px solid rgba(255 255 255 / 10%);
  text-decoration: none;
}
.sidebar__item:hover .sidebar__link,
.sidebar__link.active {
  color: #fff;
  background-image: linear-gradient(rgba(255 255 255 / 10%) 0 0);
  align-items: center;
}
.sidebar__content {
  display: flex;
}
</style>