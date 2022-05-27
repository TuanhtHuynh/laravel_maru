<template>
  <div class="mega-wrapper">
    <nav class="menu__nav">
      <div class="menu__logo">
        <router-link
          class="menu__header"
          to='/'
        >{{appname}}</router-link>
        <div
          class="menu__toggle"
          @click="toggleClick"
        >
          <i
            class="bx bx-menu menu__icon"
            v-if="!toggle"
          ></i>
          <i
            class="bx bx-x menu__icon"
            v-if="toggle"
          ></i>
        </div>
      </div>
      <ul
        class="menu__links"
        :class="{toggle}"
      >
        <!-- sub_menus_count -->
        <div
          v-for="menu in menus"
          :key="menu.id"
        >
          <li
            class="menu__item"
            v-if="menu.sub_menus.length==0"
          >
            <router-link
              :to="menu.menu_url"
              class="menu__link"
            >{{menu.menu_name}}</router-link>
          </li>
          <mega-dropdown
            v-else-if="menu.sub_menus.length>0"
            :parent="menu"
            :menu_toggle="toggle"
            @closeSidebar="closeSidebar"
            :submenus="menu.sub_menus"
          ></mega-dropdown>
        </div>
      </ul>
    </nav>
  </div>
</template>

<script>
import MegaDropdown from "./MegaDropdown.vue";
import { getAllMenus } from "../../../actions/menus";
export default {
  name: "mega-menu",
  components: {
    MegaDropdown,
  },
  props: ["appname"],
  data() {
    return {
      toggle: false,
    };
  },
  created() {
    getAllMenus();
  },
  computed: {
    menus: {
      get() {
        return this.$store.menu.menus;
      },
    },
  },
  methods: {
    toggleClick(event) {
      this.toggle = !this.toggle;
      this.$emit("MenuToggle", this.toggle);
    },
    closeSidebar(value) {
      this.toggle = value;
    },
  },
};
</script>

<style>
.mega-wrapper {
  padding: 0;
  margin: 0;
  max-width: 100%;
  z-index: 999;
  background: var(--foody-primary);
  height: 40px;
  color: #fff;
  text-decoration: none;
}
.menu__nav {
  display: flex;
  align-items: center;
  padding: 0 10px;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
  height: 100%;
  color: #fff;
}
.menu__header {
  color: #fff;
}
.menu__links {
  display: flex;
  color: #fff;
  margin-top: 12px;
  text-decoration: none;
}
nav li {
  list-style: none;
}
.menu__item {
  text-transform: uppercase;
  padding: 1rem 10px;
}
.menu__item:last-of-type {
  margin-top: 0;
}
.menu__link {
  color: #fff;
}
.menu__link:hover {
  color: #fff;
}
.menu__toggle {
  position: absolute;
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  display: none;
}
.menu__disabled {
  pointer-events: none;
}
.menu__logo {
  font-size: 22px;
  color: #fff;
}
.menu__link:hover {
  color: #fff;
}
.menu__icon {
  font-size: 32px;
  display: flex;
  align-items: center;
  color: #fff;
}
.menu__toggle {
  display: none;
}
@media screen and (max-width: 769px) {
  .mega-wrapper {
    position: relative;
    width: 100%;
  }
  .menu__toggle {
    display: block;
    cursor: pointer;
  }
  .megamenu {
    position: static;
    display: flex;
    flex-direction: column;
    max-width: 500px;
    margin-top: 16px;
    overflow: hidden;
    color: #333;
    padding: 0;
    background: #eee;
    box-shadow: none;
  }
  .menu__links {
    position: absolute;
    flex-direction: column;
    left: 100%;
    width: 100%;
    height: calc(100vh - 50px);
    top: 100%;
    margin: 0;
    padding: 0;
    background: #eee;
    overflow-y: auto;
    overflow-x: hidden;
    transition: all 0.5s ease-out;
    width: 0;
  }
  .menu__links.toggle {
    left: 0;
    width: 100%;
  }
  .menu__item {
    padding: 10px;
  }
  .menu__item--mega {
    padding: 10px;
  }
  .megamenu__item,
  .megamenu__link,
  .menu__item {
    color: #333;
  }
  .megamenu__item:hover {
    color: #333;
  }
  .menu__link {
    color: #333;
  }
  .menu__link:hover,
  .megamenu__link:hover {
    color: #333;
  }
  .megamenu__content {
    padding-top: 10px;
    margin: 0;
  }
}
</style>