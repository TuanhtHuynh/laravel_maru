<template>
  <div class="vcard">
    <div
      class="vcard__header"
      v-if="label"
    >{{label}}</div>
    <div class="vcard__content">
      <slot name="vcontainer"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-card-container",
  props: ["label"],
};
</script>

<style>
.vcard {
  border-radius: 6px;
  max-width: 1170px;
  margin: 0 auto;
  border: 1px solid var(--border-light);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: #fff;
}
.vcard__header::first-letter {
  text-transform: uppercase;
}
.vcard__header {
  background: #fff;
  width: 100%;
  padding: 10px 1rem 10px;
  font-size: 20px;
  font-weight: 700;
}
.vcard__content {
  display: flex;
  min-width: 100%;
  padding: 10px 12px 10px;
  background: #fff;
  min-height: 228px;
}
.vcard__content div {
  width: 100%;
}
</style>