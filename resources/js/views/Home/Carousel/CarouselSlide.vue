<template>
  <transition
    :name="dir"
    mode="in-out"
  >
    <div
      v-show="
    visibleSlide===index"
      class="carousel-slide"
    >
      <slot></slot>
    </div>
  </transition>
</template>

<script>
export default {
  name: "carousel-slide",
  props: ["index", "visibleSlide"],
  computed: {
    dir: {
      get() {
        return this.$parent.direction;
      },
    },
  },
};
</script>

<style>
.carousel-slide {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  transition: transform 0.3 ease-out;
}
.left-enter-active {
  animation: leftInAnimation 0.4s ease-in-out;
}
.left-leave-active {
  animation: leftOutAnimation 0.4s ease-in-out;
}

@keyframes leftInAnimation {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(0);
  }
}
@keyframes leftOutAnimation {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-100%);
  }
}
.right-enter-active {
  animation: rightInAnimation 0.5s ease-in-out;
}
.right-leave-active {
  animation: rightOutAnimation 0.5s ease-in-out;
}

@keyframes rightInAnimation {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(0%);
  }
}
@keyframes rightOutAnimation {
  from {
    transform: translateX(0%);
  }
  to {
    transform: translateX(100%);
  }
}
</style>