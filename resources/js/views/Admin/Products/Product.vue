<template>
  <tr class="m-table__body">
    <td class="m-table__td--center">{{product.id}}</td>
    <td class="m-table__td">{{product.product_name}}</td>
    <td class="m-table__td--number">{{product.price | format-vnd}}</td>
    <td class="m-table__td--center">{{product.category_name}}</td>
    <td>
      <div>
        <router-link
          class="m-table__button m-table__button--edit"
          :to="{name: 'product-edit',
          params:{id: product.id}}"
        >
          <i class="bx bx-edit m-table__buttonicon"></i>
        </router-link>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  name: "product",
  props: ["product"],
};
</script>

<style scoped>
</style>