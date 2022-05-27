<template>
  <tr class="m-table__body">
    <td class="m-table__td--center">{{category.id}}</td>
    <td class="m-table__td">{{category.name}}</td>
    <td class="m-table__td">{{category.slug}}</td>
    <td>
      <router-link
        class="m-table__button m-table__button--edit"
        :to="{name: 'category_edit', params:{id: category.id}}"
      >
        <i class="bx bx-edit m-table__buttonicon"></i>
      </router-link>
      <button
        class="m-table__button m-table__button--delete"
        @click="onDelete"
        @onDelete="onDelete"
      >
        <i class="bx bx-trash"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  name: "Category",
  props: {
    category: { type: Object, require: true },
    styleclass: { type: String },
  },
  methods: {
    onDelete(id) {
      this.$emit("onDelete", this.category.id);
    },
  },
};
</script>

<style>
.m-table__body:nth-of-type(even) {
  background: #f3f3f3;
}
.m-table__td {
  font-size: 0.9rem;
  padding: 10px;
  font-weight: 400;
}
.m-table__button {
  display: inline-block;
  padding: 6px 12px;
  border-radius: 0.25em;
  user-select: none;
  vertical-align: middle;
}
.m-table__button--edit {
  background: #ffc107;
  margin-right: 6px;
}
.m-table__button--delete {
  background: #dc3545;
}
</style>