<template>
  <div class="dropdown">
    <select
      class="dropdown__select"
      :value="selecteditem"
      @input="Change"
    >
      <option
        v-for="item in items"
        :key="item.id"
        :value="item.id"
      >{{ item.name }}</option>
    </select>
    <span class="custom-arrow">
      <i class="bx bxs-sort-alt dropdown__icon"></i>
    </span>
  </div>
</template>

<script>
export default {
  name: "v-select",
  props: ["items", "selecteditem"],
  data() {
    return {
      visible: false,
      selected: 0,
    };
  },
  mounted() {
    this.selected = this.items.find((item) => item.id === this.selecteditem);
  },

  mounted() {
    window.addEventListener("blur", this.closeDropdown, true);
  },
  destroyed() {
    window.addEventListener("blur", this.closeDropdown);
    //this.selected = {};
  },
  methods: {
    closeDropdown() {
      this.visible = false;
    },
    Change(event) {
      this.$emit("input", event.target.value);
      this.visible = false;
    },
  },
};
</script>

<style>
.dropdown {
  width: 100%;
  background: #fff;
  height: 30px;
  margin: 15px 0px;
  border-radius: 3px;
  position: relative;
  display: grid;
  place-items: center;
}

.dropdown__select {
  padding: 10px 1rem;
  color: #333;
  background: #fff;
  border: 1px solid #ddd;
  font-size: 0.9em;
  width: 100%;
  border-radius: 3px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  height: calc(2rem + 2px);
}
.dropdown__select option {
  margin: 8px 1.5rem;
}
.dropdown__optionss {
  max-height: 150px;
}
.dropdown__select:focus,
.dropsown__select:hover {
  outline: none;
  border: 1px solid #07bff0;
}
.custom-arrow {
  position: absolute;
  right: 2px;
  top: 0;
  height: 100%;
}
.dropdown__box {
  width: 100%;
  height: 100%;
  font-size: 0.9rem;
  user-select: none;
  cursor: pointer;
}
.dropdown__select {
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  user-select: none;
  width: 100%;
  height: 2rem;
}

.dropdown__popover {
  position: absolute;
  top: 105%;
  left: 0;
  right: 0;
  background: #fff;
  min-height: 150px;
  transition: all 0.3s ease-out;
  border-top: 0;
  border-left: 1px solid var(--light-border);
  border-right: 1px solid var(--light-border);
  border-bottom: 1px solid var(--light-border);
  box-shadow: 0 2px 2px rgba(0 0 0 / 22%);
  border-radius: 0 0 6px 6px;
}
.dropdown__options {
  list-style-type: none;
  padding: 0;
}
.dropdown__option:hover {
  cursor: pointer;
  background-image: linear-gradient(rgba(0 0 0 / 22%) 0 0);
}
.dropdown__option {
  font-size: 0.9rem;
  padding: 0.5rem;
}
.dropdown__icon {
  font-size: 1.5rem;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  color: #aaa;
  width: 30px;
  height: 30px;
}
</style>