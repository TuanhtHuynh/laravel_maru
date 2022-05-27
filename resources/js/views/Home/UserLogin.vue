<template>
  <div class="user-login-wrapper">
    <div class="user-login__box">
      <div
        class="maru-overlay"
        v-show="loading"
      >
        <spin-loading></spin-loading>
      </div>
      <form
        @submit.prevent="login"
        class="user-login__form"
      >
        <h2 class="user-login__header">Đăng nhập</h2>
        <text-input
          placeholder="email đăng nhập"
          v-model="formData.email"
          required="true"
          ref="email"
        ></text-input>
        <text-input
          v-model="formData.password"
          placeholder="mật khẩu"
          required="true"
          ref="password"
        ></text-input>
        <button class="user-login__button">
          Đăng nhập
        </button>
        <router-link
          class="user-login__link"
          to="/signup"
        >
          Chưa có tài khoản?
        </router-link>
      </form>
    </div>
    <div class="user-login__side"></div>
  </div>
</template>

<script>
import SpinLoading from "../shared/SpinLoading";
import TextInput from "../shared/TextInput";
import { login } from "../../actions/authenticate.js";

export default {
  name: "user-login",
  components: {
    SpinLoading,
    TextInput,
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
  mounted() {
    this.loading = true;
    setTimeout(() => {
      this.loading = false;
    }, 2000);
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
.user-login-wrapper {
  display: flex;
  height: 100vh;
  overflow: hidden;
  font-weight: 400;
}
.user-login__box {
  flex-basis: 50%;
  order: 2;
  background: #eee;
  padding: 1.5rem;
  white-space: nowrap;
}
.user-login__side {
  flex-basis: 50%;
  background: #eee;
}
.user-login__header {
  font-size: 2rem;
  margin: 20px;
  color: #333;
  font-weight: 600;
}
.user-login__form {
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
.user-login__button {
  padding: 10px 20px;
  width: 100%;
  font-size: 0.9em;
  margin-top: 20px;
  background: #007bff;
  color: #fff;
}
.user-login__link {
  text-decoration: none;
  margin-top: 20px;
  color: #333;
}
.user-login__link:hover {
  color: #333;
}

@media screen and (max-width: 769px) {
  .user-login__box {
    flex-basis: 100%;
  }
  .user-login__form {
    width: 100%;
  }
  .user-login__side {
    display: none;
  }
}
</style>