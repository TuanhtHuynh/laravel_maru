<template>
  <div>
    this is a secure area
    {{msg}}
  </div>
</template>

<script>
export default {
  name: "security",
  props: {
    msg: String,
  },
};
</script>

<style>
body {
  background: #fff;
}
</style>