<template>
  <div v-if="lists.data">
    <div class="col-md-12 row main_container" v-show="!isMobile">
      <div class="col-md-3 col-sm-12 right">
        <img class="img img-raised rounded" src="../../../assets/icon/successfullstory.png" />
      </div>
      <div class="col-md-9 col-sm-12 row left">
        <div class="col-md-12 col-sm-12 row">
          <div class="col-md-1 col-sm-1">
            <img
              @click="left"
              class="img img-raised rounded left_icon"
              src="../../../assets/icon/left.png"
            />
          </div>
          <div class="col-md-3 col-sm-3">
            <img
              v-if="list.image"
              style="width:220px;"
              class="img img-raised rounded profile"
              :src="list.image"
            />
            <img
              v-else
              class="img img-raised rounded profile"
              src="../../../assets/image/successfull_story.png"
            />
          </div>
          <div class="col-md-7 col-sm-7">
            <div style="margin-left: 10px;">
              <h3 class="mt-4" style="color: rgb(149,27,129)">{{list.headline}}</h3>
              <p
                class="on-mobile"
                style="font-size: 13px;height: 152px;overflow: hidden;margin-bottom: -44px;"
                v-html="list.content"
              ></p>
              <br />
              <br />
              <br />
              <nuxt-link to="/page/stories" class="see-more">
                <span>আরো দেখুন...</span>
              </nuxt-link>
            </div>
          </div>
          <div class="col-md-1 col-sm-1">
            <img
              @click="right"
              class="img img-raised rounded right_icon"
              src="../../../assets/icon/right.png"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { isMobile } from 'mobile-device-detect'
import { mapMutations, mapGetters } from 'vuex'
export default {
  name: 'Content2',
  data() {
    return {
      isMobile: isMobile,
      list: {},
      total_data: 0,
      i: 0
    }
  },
  mounted() {
    this.get()
  },
  computed: mapGetters({
    lists: 'frontent/stories'
  }),
  methods: {
    async get() {
      let page = 1
      let search = { type: 3, limit: 4 }
      try {
        await this.$store
          .dispatch('frontent/get_stories', { search, page })
          .then(() => {
            this.list = this.lists.data[0]
            this.total_data = this.lists.data.length
          })
      } catch (e) {}
    },
    right() {
      if (this.i < this.total_data) {
        this.list = this.lists.data[this.i++]
      }
    },
    left() {
      if (this.i >= 1) {
        this.list = this.lists.data[this.i--]
      }
    }
  }
}
</script>
<style scoped>
.main_container_mobile {
  position: relative;
  background: #f4f5f7;
  z-index: 115;
  /* overflow: auto; */
  margin-bottom: 55px;
}
.main_container_mobile .left_icon {
  height: 60px;
  float: left;
}
.main_container_mobile .right_icon {
  height: 60px;
  float: right;
}

.main_container {
  position: relative;
  background: #f4f5f7;
  z-index: 115;
  /* overflow: auto; */
  margin-bottom: 55px;
  height: 292px;
}
.right > img {
  height: 325px;
  position: absolute;
  top: -11px;
}
.left .profile {
  height: 281px;
  border: 16px solid #fff;
  border-radius: 29;
  position: absolute;
  top: 35px;
}
.left .right_icon {
  height: 60px;
  margin-top: 114px;
  cursor: pointer;
}
.left .left_icon {
  height: 60px;
  margin-top: 114px;
  cursor: pointer;
}
@media (max-width: 425px) {
  .on-mobile {
    display: none;
  }
}
</style>
