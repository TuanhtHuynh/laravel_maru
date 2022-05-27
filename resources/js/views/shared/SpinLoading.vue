<template>
  <div class="loading-container">
    <div class="loading loading-full"></div>
  </div>
</template>

<script>
export default {
  name: "spin-loading",
};
</script>

<style>
.loading-container {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  overflow: hidden;
  display: block;
  transition: all 0.3s ease;
}
.loading {
  display: flex;
  justify-content: center;
  background: rgba(0 0 0 / 22%);
  transition: all 0.3s ease-out;
}
.loading-full {
  align-items: center;
  height: 100%;
}
.loading::after {
  content: "";
  width: 50px;
  height: 50px;
  border: 10px solid #ddd;
  border-top-color: #eee;
  border-radius: 50%;
  background: none;
  animation: loading 1s linear infinite;
}
@keyframes loading {
  to {
    transform: rotate(1turn);
  }
}
</style>