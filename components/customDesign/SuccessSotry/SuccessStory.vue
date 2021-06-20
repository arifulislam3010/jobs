<template>
  <div class="success-story-wrapper">
    <div class="container">
      <div class="text-center success-story-title">
        <h2>Succeess Stories</h2>
      </div>
      <VueSlickCarousel v-bind="slickOptions">
        <div class="single-success-stories-content-wrapper position-relative">
          <div class="success-author-wrapper d-flex align-items-center">
            <div class="success-story-author-image-wrapper mr-3 ">
              <img
                alt="image"
                src="~/assets/image/successStory/author.png"
                class="img-fluid"
              />
            </div>
            <div class="success-story-author-name ">
              <p>Mahin Khan</p>
            </div>
          </div>
          <div class="success-stories-author-comments">
            <p>
              I am so much happy beacuse i get job from mechanic.com. Then Dummy
              text will be here. I am so much happy beacuse i get job from
              mechanic.com. Then Dummy text will be here.
            </p>
          </div>
          <div class="success-stories-quote-icon position-absolute">
            <img
              alt="image"
              src="~/assets/image/successStory/quote.png"
              class="img-fluid"
            />
          </div>
        </div>
        <div class="single-success-stories-content-wrapper position-relative">
          <div class="success-author-wrapper d-flex align-items-center">
            <div class="success-story-author-image-wrapper mr-3 ">
              <img
                alt="image"
                src="~/assets/image/successStory/author.png"
                class="img-fluid"
              />
            </div>
            <div class="success-story-author-name ">
              <p>Mahin Khan</p>
            </div>
          </div>
          <div class="success-stories-author-comments">
            <p>
              I am so much happy beacuse i get job from mechanic.com. Then Dummy
              text will be here. I am so much happy beacuse i get job from
              mechanic.com. Then Dummy text will be here.
            </p>
          </div>
          <div class="success-stories-quote-icon position-absolute">
            <img
              alt="image"
              src="~/assets/image/successStory/quote.png"
              class="img-fluid"
            />
          </div>
        </div>
        <div class="single-success-stories-content-wrapper position-relative">
          <div class="success-author-wrapper d-flex align-items-center">
            <div class="success-story-author-image-wrapper mr-3 ">
              <img
                alt="image"
                src="~/assets/image/successStory/author.png"
                class="img-fluid"
              />
            </div>
            <div class="success-story-author-name ">
              <p>Mahin Khan</p>
            </div>
          </div>
          <div class="success-stories-author-comments">
            <p>
              I am so much happy beacuse i get job from mechanic.com. Then Dummy
              text will be here. I am so much happy beacuse i get job from
              mechanic.com. Then Dummy text will be here.
            </p>
          </div>
          <div class="success-stories-quote-icon position-absolute">
            <img
              alt="image"
              src="~/assets/image/successStory/quote.png"
              class="img-fluid"
            />
          </div>
        </div>
        <div class="single-success-stories-content-wrapper position-relative">
          <div class="success-author-wrapper d-flex align-items-center">
            <div class="success-story-author-image-wrapper mr-3 ">
              <img
                alt="image"
                src="~/assets/image/successStory/author.png"
                class="img-fluid"
              />
            </div>
            <div class="success-story-author-name ">
              <p>Mahin Khan</p>
            </div>
          </div>
          <div class="success-stories-author-comments">
            <p>
              I am so much happy beacuse i get job from mechanic.com. Then Dummy
              text will be here. I am so much happy beacuse i get job from
              mechanic.com. Then Dummy text will be here.
            </p>
          </div>
          <div class="success-stories-quote-icon position-absolute">
            <img
              alt="image"
              src="~/assets/image/successStory/quote.png"
              class="img-fluid"
            />
          </div>
        </div>
      </VueSlickCarousel>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel },
  data() {
    return {
      slickOptions: {
        dots: true,
        arrows: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 5000
      }
    }
  }
}
</script>

<style lang="scss">
.single-success-stories-content-wrapper {
  background: #f9f9f9;
  border-radius: 8px;
  padding: 15px 15px 30px 15px;
  height: 200px;
  transition: 0.3s;
  .success-stories-author-comments {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
    p {
      font-weight: 500;
      font-size: 14px;
      line-height: 18px;
      color: rgba(29, 49, 70, 0.8);
      margin: 0;
    }
  }
  .success-stories-quote-icon {
    height: 54px;
    width: 54px;
    top: 20px;
    right: 34px;
  }
  .success-author-wrapper {
    margin-bottom: 2rem;
  }
  &:hover {
    background: #f9f9f9;
    border: 1px solid #1d3146;
    box-shadow: -10px 40px 60px 20px rgba(0, 0, 0, 0.06);
    border-radius: 8px;
  }
}
.success-story-author-image-wrapper {
  height: 48px;
  width: 48px;
  border-radius: 50%;
}
.success-story-author-name {
  p {
    font-weight: 600;
    font-size: 16px;
    line-height: 24px;
    color: #3d3e39;
    margin: 0px;
  }
}
.success-stories-quote-icon {
  height: 54px;
  width: 54px;
  top: 20px;
  right: 34px;
}
.text-center.success-story-title h2 {
  font-weight: 600;
  font-size: 40px;
  color: #1d3146;
}
</style>
