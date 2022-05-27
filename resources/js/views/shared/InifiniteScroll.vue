<template>
  <div
    id="scroll-trigger"
    ref="infinitescrollTrigger"
  >
  </div>
</template>

<script>
export default {
  name: "inifinite-scroll",
  data() {
    return { observer: false };
  },
  mounted() {
    let options = {
      root: null,
      rootMargin: "0px",
      threshold: 0.5,
    };
    this.observer = new IntersectionObserver(this.handleIntersect, options);

    this.observer.observe(this.$refs.infinitescrollTrigger);
  },
  destroyed() {
    this.observer.disconnect();
    this.observer = null;
  },
  methods: {
    handleIntersect(entries) {
      if (entries[0].isIntersecting) {
        this.$emit("inifinte");
      }
    },
  },
};
</script>

<style>
</style>