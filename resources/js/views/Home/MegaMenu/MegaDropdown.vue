<template >
  <li
    class="menu__item menu__item--mega"
    @mouseleave="mouseLeave"
    @mouseover="mouseOver"
  >
    <router-link
      class="menu__link"
      to="#"
    >{{parent.menu_name}}</router-link>
    <div
      class="megamenu"
      :key="megaKey"
      :class="{isOpen: isOpen && submenus.length>0}"
    >
      <ul
        class="megamenu__content"
        v-for="sub in submenus"
        :key="sub.id"
      >
        <li class="megamenu__header">
          {{sub.submenu_name}}
        </li>
        <div
          v-for="menulevel in sub.menu_level2s"
          :key="'sub_menu_'+menulevel.id"
        >
          <li class="megamenu__item">
            <router-link
              @click.native="routerClick()"
              class="megamenu__link"
              :to="`/maru${menulevel.menulevel2_url}`"
            >{{menulevel.menulevel2_name}}</router-link>
          </li>
        </div>
      </ul>
    </div>
  </li>
</template>

<script>
export default {
  name: "mega-dropdown",
  props: ["menu_toggle", "submenus", "parent"],
  data() {
    return { isOpen: false, megaKey: 1 };
  },
  methods: {
    routerClick(event) {
      this.isOpen = false;
      this.$emit("closeSidebar", false);
      this.megaKey = Math.random();
    },
    mouseOver(event) {
      this.isOpen = true;
    },
    mouseLeave(event) {
      setTimeout(() => {
        this.isOpen = false;
      }, 200);
    },
  },
};
</script>
<style>
.megamenu {
  position: absolute;
  display: none;
  background: var(--foody-second-2);
  width: 100vw;
  top: 40px;
  left: 0;
  z-index: 999;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease-out;
  min-height: 200px;
}
.megamenu__content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-self: flex-start;
  max-width: 40%;
  margin: 0 auto;
  padding: 16px 0;
}
.megamenu__item {
  margin-top: 10px;
}
.megamenu__link:hover {
  color: #ddd;
  text-decoration: none;
}
.megamenu__link {
  text-transform: none;
  color: #fff;
}
.megamenu__header {
  text-transform: uppercase;
  font-weight: 600;
  margin-bottom: 6px;
}
.megamenu.isOpen {
  display: flex;
}
.megamenu:hover {
  display: flex;
}
</style>