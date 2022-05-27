<template>
  <form
    @submit.prevent="createProduct"
    class="product-form"
  >
    <label class="product-form__label">Tên sản phẩm</label>
    <text-input
      v-model="product_d.product_name"
      minLength="5"
      required="true"
      ref="product_name"
    ></text-input>

    <label>Giá bán</label>
    <text-input
      v-model="product_d.price"
      required="true"
      min="10000"
      ref="price"
    ></text-input>
    <label>Danh mục</label>
    <v-select
      :items="categories"
      v-model="product_d.category_id"
      @select="CategoryChange"
    ></v-select>
    <label>Số lượng</label>
    <text-input
      v-model="product_d.quantily"
      required="true"
      min="1"
      ref="quantily"
    ></text-input>
    <label>Hình ảnh</label>
    <v-upload-file :url.sync="product_d.imageUrl"></v-upload-file>
    <ckeditor
      :value="product_d.product_description"
      :config="editorConfig"
    ></ckeditor>
    <div class="product-form__submit">
      <button class="m-table__button m-table__button--primary">
        Lưu lại
      </button>
    </div>
  </form>
</template>

<script>
import Vue from "vue";
import TextInput from "../../shared/TextInput.vue";
import VSelect from "../../shared/VSelect.vue";
import VUploadFile from "../../shared/VUploadFile.vue";
import CKEditor from "ckeditor4-vue";

export default {
  name: "product-form",
  components: {
    TextInput,
    VSelect,
    VUploadFile,
    ckeditor: CKEditor.component,
  },
  props: ["categories", "product"],
  data() {
    return {
      editorConfig: {
        toolbar: [
          [
            "Cut",
            "Copy",
            "Paste",
            "Bold",
            "Italic",
            "Underline",
            "Link",
            "BulletedList",
            "NumberedList",
            "Undo",
            "Redo",
            "Image",
            "Table",
            "TableColumn",
            "TextColor",
            "SpecialChar",
            "Styles",
            "Format",
          ],
        ],
        extraPlugins: "colorbutton,image2,filebrowser",
        removePlugins: "image",
        filebrowserUploadUrl: "/api/ck_upload",
        filebrowserUploadMethod: "form",
        height: 450,
        resize_enabled: false,
        fontSize_defaultLabel: "15px",
      },
      initialValue: {
        product_name: "",
        price: "",
        quantily: "",
        category_id: "",
        product_description: "sản phẩm",
        imageUrl: "",
      },
      price: "",
    };
  },
  computed: {
    product_d() {
      return this.product || this.initialValue;
    },
  },
  watch: {
    "product_d.price": function (value) {
      const result = value
        .toString()
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      Vue.nextTick(() => (this.product_d.price = result));
    },
  },
  methods: {
    CategoryChange(item) {
      this.category = item;
    },
    createProduct(event) {
      this.$refs.product_name.validateForm();
      this.$refs.price.validateForm();
      this.$refs.quantily.validateForm();
      if (this.$refs.product_name.errorMessage) {
        return;
      }
      if (this.$refs.price.errorMessage) {
        return;
      }
      if (this.$refs.quantily.errorMessage) {
        return;
      }
      this.product_d.price = +this.product_d.price.replace(".", "");
      this.$emit("submit", this.product_d);
    },
  },
};
</script>

<style>
.product-form {
  padding: 10px;
}
.m-table__button--primary {
  height: 40px;
}
.product-form__submit {
  margin-top: 15px;
}
</style>