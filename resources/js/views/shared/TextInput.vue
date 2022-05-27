<template>
  <div class="input-wrapper">
    <input
      class="input__box"
      :placeholder="placeholder"
      :class="{
       'input__invalid': errorMessage,
       'input__box--right': min}"
      type="text"
      :value="value"
      @input="handleChange($event)"
      ref="childRef"
    />
    <p
      class="input__error"
      v-if="errorMessage"
    >{{errorMessage}}</p>
  </div>
</template>

<script>
export default {
  name: "text-input",
  props: ["value", "minLength", "min", "required", "placeholder"],
  data() {
    return { validated: false };
  },
  computed: {
    errorMessage() {
      if (!this.validated) {
        return "";
      }
      if (this.required && this.value.length == 0) {
        return "vui lòng nhập thông tin";
      } else if (this.minLength && this.minLength > this.value.length) {
        return "Ít nhất " + this.minLength + " kí tự";
      } else if (this.min && this.min > +this.value.replace(/\./g, "")) {
        return "Giá trị không nhỏ hơn " + this.min;
      }
      return "";
    },
  },
  methods: {
    handleChange(event) {
      this.$emit("input", event.target.value);
      this.validated = true;
    },
    validateForm() {
      this.validated = true;
    },
  },
};
</script>

<style>
.input-wrapper {
  width: 100%;
  margin: 1rem 0;
  border-radius: 3px;
  overflow: hidden;
}
.input__box:focus {
  outline: none;
}
.input__box {
  padding: 6px 12px;
  width: 100%;
  border: 2px solid #ddd;
}
.input__error {
  font-size: 12px;
  margin: 0;
  padding: 0;
  color: #dc3545;
}
.input__invalid {
  border: 1px solid #dc3545;
  border-radius: 3px;
}
.input__box--right {
  text-align: right;
}
</style>