<template>
  <div>
    <div class="trapezoid">
      <p class="slider_title">
        <span style="margin-left: 20px; font-size: 25px;">আপনার</span>
        <span style="margin-left: 20px; font-size: 33px;">বিদেশ</span>
        <span style="margin-left: 20px; font-size: 37px;">গমন</span>
        <span style="margin-left: 20px; font-size: 25px;">এখন আরও</span>
        <span style="margin-left: 20px; font-size: 25px;">নিরাপদ</span>
      </p>
      <!-- <p style="font-size:16px;" class="slider-search">অনুসন্ধান </p> -->
     
      
      <SearchButton></SearchButton>
    </div>
    <div class="slider-div">
      <b-carousel v-if="lists"
        id="carousel-1"
        v-model="slide"
        :interval="4000"
        controls
        indicators
        background="#ababab"
        img-width="1024"
        img-height="300"
        style="text-shadow: 1px 1px 2px #333;"
        @sliding-start="onSlideStart"
        @sliding-end="onSlideEnd"
      >
        <!-- Text slides with image -->
        <!-- <b-carousel-slide v-for="(list,key) in this.lists" v-bind:key="key"
          caption="First slide"
          text="Nulla vitae elit libero, a pharetra augue mollis interdum."
          img-src:list.file_name
        ></b-carousel-slide> -->

        <!-- Slides with custom text -->
        <!-- <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
          <h1>Hello world!</h1>
        </b-carousel-slide> -->

        <!-- Slides with image only -->
        <!-- <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=58"></b-carousel-slide> -->

        <!-- Slides with img slot -->
        <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
        <b-carousel-slide v-for="(list,key) in this.lists" v-bind:key="key">
          <template v-slot:img>
            <img
              class="d-block img-fluid w-100"
              width="1024"
              height="480"
              :src="list.file_name"
              alt="image slot"
            >
            <!-- <div class="trapezoid ">
        <p class="slider_title">আপনাদের বিদেশ গমন এখন আরো নিরাপদ </p>
        <p class="=">অনুসন্ধান </p>
        <SearchButton></SearchButton>
      </div> -->
          </template>
        </b-carousel-slide>

        <!-- Slide with blank fluid image to maintain slide aspect ratio -->
        <!-- <b-carousel-slide caption="Blank Image" img-blank img-alt="Blank image">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eros felis, tincidunt
            a tincidunt eget, convallis vel est. Ut pellentesque ut lacus vel interdum.
          </p>
        </b-carousel-slide> -->
      </b-carousel>
    </div>

    <!-- <p class="mt-4">
      Slide #: {{ slide }}<br>
      Sliding: {{ sliding }}
    </p> -->
  </div>
</template>
 
<script>
import { mapMutations, mapGetters } from 'vuex'
import SearchButton from "~/components/custom/share/SearchButton.vue";
  export default {
    components: {
      SearchButton,
    },
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    mounted(){
      this.get();
      
    },
    computed: mapGetters({
      lists: 'frontent/sliders'
    }),
    methods: {
      async get () {
        let search = {category:1,limit:4};
        try {
          await this.$store.dispatch('frontent/get_sliders',search)
        } catch (e) {
          
        }
      },
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      }
    }
  }
</script>
<style scoped>
.slider_title{
  color: #fff;
  font-weight: bold;
  font-size: 25px;
  margin-top: 250px;
  margin-right: 25px;
  text-align: left;
  margin-left: -55px;
  line-height: 30px;
  font-family: 'Hind Siliguri', sans-serif;
}
.slider_title span { display: block; }
.slider-search {
  color: #fff;
  margin-bottom: 0;
  margin-left: -80px;
  margin-top: 22px;
}
main {
    overflow: auto !important;
}
.carousel-inner{
  height: 350px;
}
.carousel-inner>.img-fluid{
  height: 100% !important;
  object-fit: cover !important;
  width: 100% !important;
}
.carousel-item img{
  height: 435px;
  object-fit: center !important;
}
.trapezoid {
    border-bottom: 538px solid rgba(0, 99, 50, 0.88);
    border-left: 171px solid transparent;
    border-right: 0px solid transparent;
    height: 0;
    width: 380px;
    right: 16px;
    position: absolute;
    z-index: 95;
    top: -214px;
}
@media (max-width: 767px){
    .trapezoid{
        border-bottom: 494px solid rgba(0, 99, 50, 0.88);
        border-left: 171px solid transparent;
        border-right: 0px solid transparent;
        height: 0;
        width: 350px;
        right: 16px;
        position: absolute;
        z-index: 95;
        top: -214px;
    }
    .slider_title{
      font-size: 25px;
      margin-top: 236px;
      margin-right: 25px;
      text-align: left;
      margin-left: -55px;
    }
    .slider-search {
      margin-top: 15px;
      margin-left: -100px;
    }
}
.slider-div { height: 280px; overflow: hidden; }
</style>