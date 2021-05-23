<template>
  <div class="container content-1">
    <div class="row">
      <div class="col-12">
        <div style="margin-top: 25px;">
          <div class="row justify-content-start">
            <div class="col-lg-3 col-md-6 mt-1">
              <div v-show="isMobile" style="width:100%;height:20px;"></div>
              <notice v-show="isMobile"></notice>
            </div>
            <div v-show="isMobile"  style="width:100%;height:60px;clear:both;"></div>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-9">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="card card-profile" data-background="full">
                        <nuxt-link to="/procedure">
                          <img
                            class="img img-raised rounded"
                            src="../../../assets/image/home_image_1.png"
                          />
                        </nuxt-link>
                        <div class="card-body">
                          <nuxt-link to="/procedure">
                            <p
                              class="lead mt-0 mb-1"
                              style="color: #fff;font-size:16px;"
                            >অভিবাসন প্রক্রিয়া</p>
                          </nuxt-link>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="card card-profile" data-background="full">
                        <nuxt-link to="/list/recruiting-agency">
                          <img
                            class="img img-raised rounded"
                            src="../../../assets/image/home_image_2.png"
                          />
                        </nuxt-link>
                        <div class="card-body">
                          <nuxt-link to="/list/recruiting-agency">
                            <p
                              class="lead mt-0 mb-1"
                              style="color:#fff;font-size:16px;"
                            >অভিবাসন সংশ্লিষ্ট প্রতিষ্ঠান সমূহ</p>
                          </nuxt-link>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="card card-profile" data-background="full">
                        <nuxt-link to="/list/training-centers">
                          <img
                            class="img img-raised rounded"
                            src="../../../assets/image/home_image_3.png"
                          />
                        </nuxt-link>
                        <div class="card-body">
                          <nuxt-link to="/register">
                            <p
                              class="lead mt-0 mb-1"
                              style="color:#fff;font-size:16px;"
                            >অভিবাসন আগ্রহী ব্যক্তি ও প্রতিষ্ঠান নিবন্ধন</p>
                          </nuxt-link>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3">
                      <nuxt-link
                        to="/preparation"
                        style="font-size:16px"
                        class="btn heading_button"
                        type="button"
                      >
                        &nbsp;
                        <img src="../../../assets/image/home_i_1.png" /> বিদেশ যাত্রার প্রস্তুতি
                      </nuxt-link>
                      <div v-if="isMobile" style="height:20px;width:100%;"></div>
                    </div>
                    <div class="col-lg-3">
                      <nuxt-link
                        to="/to-do"
                        style="font-size:16px"
                        class="btn heading_button"
                        type="button"
                      >
                        &nbsp;
                        <img src="../../../assets/image/home_i_1.png" /> প্রবাসে করণীয়
                      </nuxt-link>
                      <div v-if="isMobile" style="height:20px;width:100%;"></div>
                    </div>
                    <div class="col-lg-3">
                      <nuxt-link
                        to="/send-money"
                        style="font-size:16px"
                        class="btn heading_button"
                        type="button"
                      >
                        &nbsp;
                        <img src="../../../assets/image/home_i_1.png" /> বৈধ ভাবে টাকা পাঠানো
                      </nuxt-link>
                      <div v-if="isMobile" style="height:20px;width:100%;"></div>
                    </div>
                    <div class="col-lg-3">
                      <nuxt-link
                        to="/complain"
                        style="font-size:16px"
                        class="btn heading_button"
                        type="button"
                      >
                        &nbsp;
                        <img src="../../../assets/image/home_i_1.png" /> অভিযোগ
                      </nuxt-link>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <notice v-show="!isMobile"></notice>
                </div>
              </div>
            </div>
            <!-- <div class="col-lg-12">
              <div class="row row-grid mb-3">
                <div class="col-lg-3 col-md-6 mt-1">
                  <nuxt-link
                    to="/বিদেশ-যাত্রার-প্রস্তুতি"
                    style="font-size:16px"
                    class="btn heading_button"
                    type="button"
                  >
                    &nbsp;
                    <img src="../../../assets/image/home_i_1.png" /> বিদেশ যাত্রার প্রস্তুতি
                  </nuxt-link>
                </div>
                <div class="col-lg-3 col-md-6 mt-1">
                  <nuxt-link
                    to="/প্রবাসে-করণীয়"
                    style="font-size:16px"
                    class="btn heading_button"
                    type="button"
                  >
                    &nbsp;
                    <img src="../../../assets/image/home_i_1.png" /> প্রবাসে করণীয়
                  </nuxt-link>
                </div>
                <div class="col-lg-3 col-md-6 mt-1">
                  <nuxt-link
                    to="/বৈধ-ভাবে-টাকা-পাঠানো"
                    style="font-size:16px"
                    class="btn heading_button"
                    type="button"
                  >
                    &nbsp;
                    <img src="../../../assets/image/home_i_1.png" /> বৈধ ভাবে টাকা পাঠানো
                  </nuxt-link>
                </div>
                <div class="col-lg-3 col-md-6 mt-1">
                  <nuxt-link
                    to="/complain"
                    style="font-size:16px"
                    class="btn heading_button"
                    type="button"
                  >
                    &nbsp;
                    <img src="../../../assets/image/home_i_1.png" /> অভিযোগ
                  </nuxt-link>
                </div>
              </div>
            </div> -->
          </div>
          <!-- <div class="row" style="margin-top:15px;">
            <div class="col-lg-3 col-md-5 mx-auto">
              <div class="card card-profile" data-background="full">
                <nuxt-link to="/অভিবাসন-প্রক্রিয়া">
                  <img class="img img-raised rounded" src="../../../assets/image/home_image_1.png" />
                </nuxt-link>
                <div class="card-body">
                  <nuxt-link to="/অভিবাসন-প্রক্রিয়া">
                    <p class="lead mt-0 mb-1" style="color: #fff;font-size:16px;">অভিবাসন প্রক্রিয়া</p>
                  </nuxt-link>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 mx-auto">
              <div class="card card-profile" data-background="full">
                <nuxt-link to="/list/recruiting-agency">
                  <img class="img img-raised rounded" src="../../../assets/image/home_image_2.png" />
                </nuxt-link>
                <div class="card-body">
                  <nuxt-link to="/list/recruiting-agency">
                    <p
                      class="lead mt-0 mb-1"
                      style="color:#fff;font-size:16px;"
                    >অভিবাসন সংশ্লিষ্ট প্রতিষ্ঠান সমূহ</p>
                  </nuxt-link>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 mx-auto">
              <div class="card card-profile" data-background="full">
                <nuxt-link to="/list/training-centers">
                  <img class="img img-raised rounded" src="../../../assets/image/home_image_3.png" />
                </nuxt-link>
                <div class="card-body">
                  <nuxt-link to="/register">
                    <p
                      class="lead mt-0 mb-1"
                      style="color:#fff;font-size:16px;"
                    >অভিবাসন আগ্রহী ব্যক্তি ও প্রতিষ্ঠান নিবন্ধন</p>
                  </nuxt-link>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 mx-auto">
              <notice v-show="!isMobile"></notice>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { isMobile } from 'mobile-device-detect'
import { mapMutations, mapGetters } from 'vuex'
import notice from '~/components/custom/home/notice.vue'
export default {
  name: 'HelloWorld',
  components: {
    notice
  },
  data() {
    return {
      isMobile: isMobile,
      immigration_offices: 0
    }
  },
  mounted() {
    // this.getImmigrationOffices()
  },
  methods: {
    async getImmigrationOffices() {
      let data = {
        role: 2
      }
      var self = this
      await this.$axios
        .post('api/frontend/total/users', data)
        .then(response => {
          self.immigration_offices = response.data
        })
    }
  }
}
</script>
<style scoped>
.heading_button {
  background: #ececec;
  color: #000;
  width: 100%;
  padding: 10px 0px 10px 0px;
  border: 1px solid #cccccc;
}
.heading_button > i {
  color: #04b34a;
}
.card-profile {
  border: 0px solid rgb(7, 102, 51);
}
.card-profile > .card-body {
  position: absolute !important;
  bottom: 0px !important;
  background: rgb(7, 102, 51) !important;
  width: 100% !important;
  margin: 0px !important;
  z-index: 1 !important;
  border-radius: 3px !important;
  color: #fff !important;
  height: 80px;
  padding-top: 18px;
  text-align: center;
  opacity: 0.9;
}
.lead {
  font-size: 15px;
}
.card-profile > .card-body-2 {
  position: absolute;
  float: right;
  background: rgb(7, 102, 51);
  right: 0px;
  padding: 3px;
  border-radius: 0px 0px 0px 25px;
  width: 76px;
  color: #fff;
  text-align: center;
  opacity: 0.9;
}
@media (min-width: 1200px) {
  .container {
    max-width: 1220px;
  }
}
@media (max-width: 767px) {
  .heading_button {
    text-align: left;
    padding-left: 25px;
  }
}
</style>