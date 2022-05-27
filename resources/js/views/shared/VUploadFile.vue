<template>
  <div class="upload-file-container">
    <form
      class="upload-file"
      @submit.prevent="upload"
    >
      <input
        class="upload-file__input"
        type="file"
        @input="handleChange"
      >
      <button class="m-table__button m-table__button--primary">Upload</button>
    </form>
    <div v-if="imagePreview || url">
      <img
        class="upload-file__preview"
        :src="imagePreview || url && 'http://localhost:8000/img/'+url"
      >
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "v-upload-file",
  props: ["url"],
  data: () => ({
    image: "",
    imagePreview: "",
  }),
  methods: {
    handleChange(event) {
      this.image = event.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.imagePreview = e.target.result;
      };
    },
    upload() {
      const formData = new FormData();
      formData.set("image", this.image);
      axios
        .post("/api/upload", formData)
        .then((data) => this.$emit("update:url", data.data.url));
    },
  },
};
</script>

<style>
.upload-file-container {
  margin-bottom: 15px;
}
.upload-file {
  background: #fff;
  border-radius: 6px;
  padding: 6px;
  width: 100%;
  justify-content: center;
  border: 1px solid #ddd;
  margin-top: 15px;
  margin-bottom: 15px;
  align-items: center;
  display: flex;
}
.upload-file__input {
  display: flex;
  flex-grow: 1;
}
.upload-file__preview {
  width: 100px;
  height: auto;
  object-fit: cover;
  border-radius: 6px;
  border: 1px solid #ddd;
}
</style>