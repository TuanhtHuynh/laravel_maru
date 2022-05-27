<template>
  <div class="admin-container">
    <admin-sidebar @logout="logout">
    </admin-sidebar>
    <div class="admin__main">
      <div class="admin__header">
        <div></div>
        <admin-header-account
          userimage="/img/10_1646904490_image_default.png"
          username="maruadmin"
          @logout="logout"
        ></admin-header-account>
      </div>
      <div class="admin__content">
        <breadcrumb :routepath="removeparams()"></breadcrumb>
        <router-view />
      </div>
      <div class="admin__footer">Tuan 2022</div>
    </div>
  </div>
</template>

<script>
import AdminSidebar from "./AdminSidebar.vue";
import Breadcrumb from "../shared/Breadcrumb.vue";
import { logout } from "../../actions/authenticate.js";
import AdminHeaderAccount from "./AdminHeaderAccount.vue";

export default {
  name: "admin-layout",
  components: {
    AdminSidebar,
    Breadcrumb,
    AdminHeaderAccount,
  },
  methods: {
    logout() {
      let token = localStorage.getItem("token");
      logout(token, this.afterlogout);
    },
    afterlogout() {
      localStorage.removeItem("token");
      this.$router.push("/admin/login");
    },
    removeparams() {
      let route = this.$route;
      let params = this.$route.params.id;
      return route.path.replace(`/${params}`, "");
    },
  },
};
</script>

<style>
* {
  font-family: "Roboto", sans-serif;
}

.admin__icon {
  width: 24px;
  height: 24px;
  font-size: 1rem;
  color: #aaa;
}
.admin-container {
  display: flex;
  min-height: 100vh;
  flex: 1 1 auto;
  background: #eee;
  overflow-x: hidden;
}

.admin__main {
  display: flex;
  width: 100%;
  overflow-x: hidden;
  flex-direction: column;
  white-space: nowrap;
  overflow-y: auto;
}
.admin__header {
  display: flex;
  justify-content: space-between;
  padding: 5px;
  background: #fff;
  border-bottom: 1px solid rgba(0 0 0 / 20%);
  height: 2.5rem;
  font-weight: 400;
  color: #666;
}
.admin__content {
  padding: 2rem;
  flex: 1 1 auto;
}
.admin__footer {
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  border-top: 1px rgba(0 0 0 / 20%) solid;
  color: #aaa;
  font-size: 12px;
  font-weight: 400;
  flex: 0 1 40px;
}
.breadcrumbs {
  margin: 0;
}
.m-table__responsive {
  overflow-x: auto;
  box-shadow: 0 0 5px rgba(0 0 0 / 15%);
}
.m-table {
  width: 100%;
  background: #fff;
  border: 1p solid #d6d6d6;
  border-radius: 6px;
  border-collapse: collapse;
  overflow: hidden;
}
.m-table__thead {
  background: #f8f9fa;
}
.m-table__body:nth-of-type(even) {
  background: #f3f3f3;
}
.m-table__td {
  font-size: 0.9rem;
  padding: 10px;
  font-weight: 400;
}
.m-table__td--number {
  text-align: right;
}
.m-table__td--center {
  text-align: center;
}
.m-table__buttonicon {
  display: flex;
  align-items: center;
}
.m-table__button {
  display: inline-block;
  padding: 6px 30px;
  border-radius: 0.25em;
  user-select: none;
  vertical-align: middle;
  text-align: center;
  color: #fff;
  line-height: 28px;
  height: 28px;
}
.m-button {
  padding: 6px 50px;
  border-radius: 0.25em;
  user-select: none;
  color: #fff;
  line-height: 30px;
}
.m-table__button:hover {
  cursor: pointer;
  background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0 0);
}
.m-table__button--edit {
  background: #ffc107;
  padding: 6px 12px;
  margin-right: 6px;
}
.m-table__button--primary {
  background: #007bff;
}
.m-table__button--delete {
  background: #dc3545;
}
</style>