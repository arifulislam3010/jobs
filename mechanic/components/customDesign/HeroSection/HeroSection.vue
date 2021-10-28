<template>
  <div class="herosection-wrapper">
    <div class="container">
      <div class="hero-section-content-wrapper">
        <div class="hero-section-title-wrapper">
          <h2>One Search, Millions of Jobs</h2>
        </div>
        <div class="hero-search-jobs-wrapper">
          <form>
            <div class="job-title">
              <input type="text" placeholder="Job Title,Skills or Company" v-model="list.job" />
              <div class="bag-image-wrapper">
                <img
                  alt="form icon"
                  src="~/assets/image/hero/bag.png"
                  class="img-fluid"
                />
              </div>
            </div>
            <div class="location input-group position-relative">
              <input type="text" placeholder="Location or City"  v-model="list.city" />
              <div class="bag-image-wrapper">
                <img
                  alt="form icon"
                  src="~/assets/image/hero/location.png"
                  class="img-fluid"
                />
              </div>
            </div>
            <div class="job-title-submit-button">
              <button type="button" v-show="isMobile" @click="search()">Search</button>
              <button type="button" v-show="!isMobile" @click="search()">Search Jobs</button>
            </div>
          </form>
        </div>
        <div class="create-cv-section">
          <p>
            <nuxt-link to="#">upload </nuxt-link> <span> or </span
            ><nuxt-link to="#"> create resume </nuxt-link> easily apply to jobs.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { isMobile } from 'mobile-device-detect';
export default {
   data() {
    return {
      isMobile:isMobile,
      list: {job:'',city:''},
    }
  },
  methods: {
    search(){
      this.$router.push('/job-search?job='+this.list.job+'&city='+this.list.city);
    }
  },
}
</script>

<style lang="scss">
.hero-section-content-wrapper{
  position: relative;
}
.herosection-wrapper {
  min-height: 420px;
  display: block;
  background-image: url('~assets/image/hero/bg.png');
  align-items: center;
  .hero-search-jobs-wrapper {
    background: #ffffff;
    border: 1px solid #d8d8d8;
    box-sizing: border-box;
    border-radius: 8px;
    width: 100%;
    padding: 2px;
    height: 50px;
    position: absolute;
    form {
      width: 100%;
      position: relative;
      display: block;
      height: 100%;
      .job-title{
        width: 40%;
        display: block;
        position: relative;
        float: left;
        padding: 5px;
        height: 100%;
        input {
          border: 1px solid #d8d8d8;
          box-sizing: border-box;
          border-radius: 8px;
          padding-left: 20px;
          height: 100%;
          color: rgba(55, 58, 72, 0.6);
          margin-right: 10px;
          width: 100%;
          &:focus {
            outline: 0;
          }
        }
        .bag-image-wrapper {
          position: absolute;
          top: 26%;
          left: 2.6%;
        }
      }
      .location{
        width: 40%;
        display: block;
        position: relative;
        float: left;
        padding: 5px;
        height: 100%;
        input {
          border: 1px solid #d8d8d8;
          box-sizing: border-box;
          border-radius: 8px !important;
          padding-left: 20px;
          height: 100%;
          color: rgba(55, 58, 72, 0.6);
          margin-right: 10px;
          width: 100%;
          &:focus {
            outline: 0;
          }
        }
        .bag-image-wrapper {
          position: absolute;
          top: 26%;
          left: 4%;
        }
      }
      .job-title-submit-button{
        width: 20%;
        display: block;
        position: relative;
        float: left;
        padding: 5px;
        height: 100%;
        button {
          background: #0ba88c;
          border-radius: 8px;
          border: none;
          // padding: 1.95em 0 1.95em 0;
          color: #fff;
          width: 100%;
          height: 100%;
        }
      }
    }
  }
}


.hero-section-title-wrapper {
  h2 {
    font-weight: 600;
    font-size: 48px;
  }
}

.create-cv-section {
  margin-top: 1rem;
}

.create-cv-section {
  p {
    font-weight: 600;
    a {
      color: #02ab8d;
    }
  }
}

</style>
