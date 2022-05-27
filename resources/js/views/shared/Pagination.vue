<template>
  <div
    class="m-pagination"
    v-if="pages.length > 1"
  >
    <ul class="m-pagination__links">
      <li class="m-pagination__item">
        <button
          class="m-pagination__btn"
          :disabled="currentPage === 1"
          @click.prevent="OnPrevClick(currentPage)"
        >&lt;</button>
      </li>
      <li
        class="m-pagination__item"
        v-for="(page, index) in pages"
        :key="index"
        :class="{actived: currentPage === page}"
      >
        <button
          class="m-pagination__link"
          @click="OnPaginationClick(page)"
        >{{page}}</button>
      </li>
      <li class="m-pagination__item">
        <button
          class="m-pagination__btn"
          :disabled="currentPage === lastPage"
          @click.prevent="OnPaginationClick(currentPage+1)"
        >&gt;</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "pagination",
  props: {
    url: { type: String },
    lastPage: { type: Number },
  },
  data() {
    return { currentPage: 1 };
  },
  computed: {
    pages() {
      const delta = 2;
      const center =
        this.currentPage < this.lastPage / 2
          ? Math.ceil(this.lastPage / 2) + 1
          : this.currentPage;
      let range = [];
      if (this.lastPage < 6) {
        range = this.getRange(1, this.lastPage);
      } else {
        if (this.currentPage < center - delta) {
          range = this.getRange(1, center).concat("...", this.lastPage);
        }
        if (this.currentPage >= center - delta) {
          if (this.currentPage < center) {
            const left = this.getRange(this.currentPage - 1, center - 1);
            range = [1, "...", ...left, "...", this.lastPage];
          }
          if (
            this.currentPage >= center &&
            this.currentPage < this.lastPage - delta
          ) {
            const left = this.getRange(center - 1, this.currentPage + 1);
            range = [1, "...", ...left, "...", this.lastPage];
          }
          if (
            this.currentPage >= center &&
            this.currentPage >= this.lastPage - delta
          ) {
            const right = this.getRange(
              this.lastPage - delta - 2,
              this.lastPage
            );
            range = [1, "...", ...right];
          }
        }
      }

      return range;
    },
  },
  methods: {
    getRange(start, end) {
      return Array(end - start + 1)
        .fill()
        .map((v, i) => i + start);
    },
    OnPrevClick(page) {
      if (page - 1 > 0) {
        this.currentPage = page - 1;
        this.$emit("OnPaginationClick", page - 1);
      }
    },
    OnNextClick(page) {
      if (page + 1 < this.lastPage) {
        this.currentPage = page + 1;
        this.$emit("OnPaginationClick", page + 1);
      }
    },
    OnPaginationClick(page) {
      if (page !== "...") {
        this.currentPage = page;
        this.$emit("OnPaginationClick", page);
      }
    },
  },
};
</script>

<style scoped>
.m-pagination__links {
  display: flex;
  text-decoration: none;
  list-style-type: none;
  justify-content: center;
  align-items: center;
  padding: 20px;
  background: #fff;
  user-select: none;
}

.m-pagination__item {
  list-style: none;
  text-align: center;
  border: 1px solid var(--light);
  border-radius: 6px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: 500;
  height: 45px;
  width: 45px;
}

.m-pagination__item.actived,
.m-pagination__item.actived .m-pagination__link {
  color: #fff;
  background: var(--primary);
}
.m-pagination__btn,
.m-pagination__link {
  background: none;
}
</style>