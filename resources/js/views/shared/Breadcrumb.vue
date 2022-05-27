<template>
  <ul
    class="breadcrumbs"
    v-if="crumbs.length>2"
  >
    <li
      v-for="(crumb, i) in crumbs"
      :key="i"
      class="breadcrumbs__item"
    >
      <router-link
        :to="crumb.path"
        class="breadcrumbs__link"
        :class="{'breadcrumbs__link--active': isLast(i)}"
      >{{crumb.name}}</router-link>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["routepath"],
  computed: {
    crumbs() {
      return this.makeCrumbs(this.routepath);
    },
  },
  methods: {
    isLast(index) {
      return index === this.crumbs.length - 1;
    },
    makeCrumbs(routePath) {
      let sp_crumbs = routePath.split("/");
      let arr_crumbs = sp_crumbs.map((crumb, i) => {
        var url = routePath.slice(
          0,
          routePath.indexOf("/" + crumb) + crumb.length + 1
        );
        return { name: crumb, path: url };
      });
      if (arr_crumbs[0].path == "/") {
        arr_crumbs[0].name = "Maru";
      }
      return arr_crumbs;
    },
  },
};
</script>

<style>
.breadcrumbs {
  display: flex;
  align-items: center;
  border-radius: 0.37rem;
  padding: 0 1rem;
  list-style: none;
  margin: 0 auto;
  max-width: 1200px;
}
.breadcrumbs__item {
  padding: 10px 0;
}
.breadcrumbs__item:not(:last-of-type)::after {
  content: "/";
  margin: 0 6px;
  color: #ccc;
}
.breadcrumbs__link {
  color: #333;
}
.breadcrumbs__link--active {
  font-weight: 500;
  color: #0664f9;
}
</style>