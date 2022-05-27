<template>
  <div class="login-wrapper">
    <div class="login__box">
      <div
        class="maru-overlay"
        v-show="loading"
      >
        <spin-loading></spin-loading>
      </div>
      <form
        @submit.prevent="login"
        class="login__form"
      >
        <h2 class="login__header">Đăng nhập</h2>
        <text-input
          v-model="formData.email"
          required="true"
          ref="email"
        ></text-input>
        <text-input
          v-model="formData.password"
          required="true"
          ref="password"
        ></text-input>
        <button class="login__button">
          Đăng nhập
        </button>
        <router-link
          class="login__link"
          to="/signup"
        >
          Chưa có tài khoản?
        </router-link>
      </form>
    </div>
    <div class="login__side"></div>
  </div>
</template>

<script>
import TextInput from "./shared/TextInput.vue";
import SpinLoading from "./shared/SpinLoading.vue";
import { login } from "../actions/authenticate.js";

export default {
  name: "Login",
  components: {
    TextInput,
    SpinLoading,
  },
  data: () => ({
    formData: {
      email: "",
      password: "",
    },
  }),
  computed: {
    loading: {
      get() {
        return this.$store.Authentication.loading;
      },
      set(value) {
        this.$store.Authentication.loading = value;
      },
    },
  },
  methods: {
    redirect() {
      this.$router.replace({ name: "admin-dashboard" });
    },
    login() {
      this.$refs.email.validateForm();
      this.$refs.password.validateForm();
      if (this.$refs.email.errorMessage) {
        return;
      }
      if (this.$refs.password.errorMessage) {
        return;
      }
      this.loading = true;
      login(this.formData, this.redirect);
      setTimeout(() => {
        this.loading = false;
      }, 2000);
    },
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.login-wrapper {
  display: flex;
  height: 100vh;
  overflow: hidden;
  font-weight: 400;
}
.login__box {
  flex-basis: 50%;
  order: 2;
  background: #eee;
  padding: 1.5rem;
  white-space: nowrap;
}
.login__side {
  flex-basis: 50%;
  background: #eee;
}
.login__header {
  font-size: 2rem;
  margin: 20px;
  color: #333;
  font-weight: 600;
}
.login__form {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 1.5rem;
  margin: auto;
  background: #fff;
  width: 70%;
  height: 100%;
  border-radius: 6px;
  border: 1px solid var(--light-border);
  box-shadow: 0 0 5px rgba(0 0 0 / 20%);
}
.login__button {
  padding: 10px 20px;
  width: 100%;
  font-size: 0.9em;
  margin-top: 20px;
  background: #007bff;
  color: #fff;
}
.login__link {
  text-decoration: none;
  margin-top: 20px;
  color: #333;
}
.login__link:hover {
  color: #333;
}

@media screen and (max-width: 769px) {
  .login__box {
    flex-basis: 100%;
  }
  .login__form {
    width: 100%;
  }
  .login__side {
    display: none;
  }
}
</style>