<template>
  <div class="admin-account">
    <div
      class="admin-account__info"
      @click="visible=!visible"
    >
      <img
        class="admin-account__img"
        loading="lazy"
        :src="userimage"
      >
      <span>{{username}}</span>
    </div>
    <ul
      class="admin-account__dropdown"
      :class="{open: visible}"
    >
      <li
        class="admin-account__item"
        @click.prevent="logout"
      >
        <router-link
          class="admin-account__link"
          to="#"
        >
          <i class="bx bx-log-out admin-account__icon"></i>
          <div class="admin-account__text">
            Logout
          </div>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "admin-header-account",
  props: ["userimage", "username"],
  data: () => ({
    visible: false,
  }),
  methods: {
    logout() {
      this.$emit("logout");
    },
  },
};
</script>

<style>
.admin-account {
  width: 150px;
  height: 100%;
  margin-right: 10px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}
.admin-account__info {
  display: flex;
  align-items: center;
  height: 100%;
}
.admin-account__img {
  width: auto;
  margin-right: 10px;
  height: 100%;
  object-fit: cover;
}
.admin-account__dropdown.open {
  opacity: 1;
  visibility: visible;
}
.admin-account__dropdown {
  list-style: none;
  display: flex;
  position: absolute;
  top: 40px;
  right: 15px;
  left: auto;
  background: #fff;
  margin: 0;
  padding: 0;
  width: 10em;
  text-decoration: none;
  max-height: 100px;
  box-shadow: 0 0 15px rgba(0 0 0 / 10%);
  border-radius: 0 0 3px 3px;
  overflow: hidden;
  color: #777;
  z-index: 1000;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease-in-out;
}

.admin-account__item {
  display: flex;
  align-items: center;
  width: 100%;
}
.admin-account__link:hover {
  background-image: linear-gradient(rgba(0 0 0 / 20%) 0 0);
}
.admin-account__link {
  width: 100%;
  display: flex;
  align-items: center;
  padding: 6px;
}
.admin-account__icon {
  min-width: 22px;
  justify-content: center;
  align-items: center;
  font-size: 1rem;
}
</style>