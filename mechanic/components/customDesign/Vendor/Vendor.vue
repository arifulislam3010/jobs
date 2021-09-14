<template>
  <div class="vendor-wrapper">
    <div class="vendor-heading text-center">
      <h2>Our beloved <span> Vendors </span></h2>
    </div>
    <div class="slider-wrapper">
      <VueSlickCarousel v-bind="slickOptions">
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
        <div class="single-vendor-item">
          <img
            alt="vendor logo"
            src="~/assets/image/vendor/logo.png"
            class="img-fluid"
          />
        </div>
      </VueSlickCarousel>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel },
  data() {
    return {
      slickOptions: {
        dots: false,
        arrow: false,
        speed: 500,
        slidesToShow: 20,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 1000,
        infinity: true,
        initalSlide: 1
      }
    }
  }
}
</script>

<style lang="scss">
.vendor-heading h2 {
  font-size: 30px;
}

.vendor-heading {
  h2 {
    font-size: 30px;
    span {
      font-weight: bold;
      color: #0ba88c;
    }
  }
}
.vendor-wrapper {
  width: 100%;
  height: 100%;
  overflow: hidden;
}
</style>
