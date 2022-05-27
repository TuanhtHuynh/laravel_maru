<template>
  <div class="carousel">
    <carousel-slide
      v-for="(slide, i) in slides"
      :key="i"
      :index="i"
      :visibleSlide="visibleSlide"
      :direction="direction"
    >
      <div class="carousel__box">
        <img
          loading="lazy"
          class="carousel__image"
          :src="`${CheckMode()}${slide.imageUrl}`"
        />
      </div>
    </carousel-slide>
    <button
      @click.prevent="next"
      class="carousel__button carousel__button--next"
    >
      <i class="bx bx-chevron-right carousel__icon"></i>
    </button>
    <button
      @click.prevent="prev"
      class="carousel__button carousel__button--prev"
    >
      <i class="bx bx-chevron-left carousel__icon"></i>
    </button>
  </div>
</template>

<script>
import CarouselSlide from "./CarouselSlide.vue";

export default {
  name: "v-carousel",
  props: ["slides"],
  components: {
    CarouselSlide,
  },
  data() {
    return {
      visibleSlide: 0,
      direction: "left",
      polling: null,
      pause: false,
    };
  },
  computed: {
    slideLength: {
      get() {
        return this.slides.length;
      },
    },
  },
  created() {
    this.pollingData();
  },
  beforeDestroy() {
    clearInterval(this.polling);
  },
  watch: {
    auto() {
      this.pollingData();
    },
  },
  methods: {
    pollingData() {
      if (this.pause === false && !this.polling) {
        this.polling = setInterval(() => {
          this.next();
        }, 9200);
      } else if (this.pause && !this.polling) {
        clearInterval(this.polling);
      }
    },
    CheckMode() {
      return process.env.NODE_ENV === "production"
        ? "https://maruht.herokuapp.com"
        : "http://localhost:8000";
    },
    next() {
      this.pause = true;
      this.visibleSlide++;
      if (this.visibleSlide >= this.slideLength) {
        this.visibleSlide = 0;
      }
      this.direction = "right";
      this.pause = false;
    },
    prev() {
      this.pause = true;
      this.visibleSlide--;
      if (this.visibleSlide < 0) {
        this.visibleSlide = this.slideLength - 1;
      }
      this.direction = "left";
      this.pause = false;
    },
  },
};
</script>

<style>
.carousel {
  position: relative;
  width: 100%;
  height: 415px;
  background: #000;
  overflow: hidden;
  transition: all 0.5s ease-out;
}
.carousel__button {
  position: absolute;
  width: 50px;
  height: 40px;
  top: calc(50% - 20px);
  background: rgba(0, 0, 0, 0.8);
  border: none;
  border-radius: 3px;
  color: #fff;
  cursor: pointer;
}
.carousel__icon {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
}
.carousel__button--next:hover,
.carousel__button--prev:hover {
  opacity: 0.6;
}
.carousel__button--next {
  right: 0;
}
.carousel__button--prev {
  left: 0;
}
.carousel__box {
  width: 1170px;
  height: 100%;
  margin: 0 auto;
}
.carousel__image {
  width: 100%;
  height: auto;
  object-fit: cover;
}

@media screen and (max-width: 769px) {
  .carousel {
    width: 100%;
    max-height: 133px;
  }

  .carousel__button {
    display: none;
  }

  .carousel__box {
    max-width: 100%;
    height: 100%;
  }

  .carousel__image {
    width: 100%;
    height: 100%;
  }
}
</style>