<template>
  <div >
    <div class="team-5">
      <div class="container">
        <div class="px-4">
            <!-- <div class="row justify-content-center" v-if="this.$route.params.type=='blogs' || this.$route.params.type=='stories'">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="javascript:;">
                    <img v-if="list.image" style="height:100px;margin-top: -34px;margin-left: calc(50% - 65px);" :src="list.image" class="rounded-circle">
                    <img v-else style="height:100px;margin-top: -34px;margin-left: calc(50% - 65px);" src="../../../assets/image/institution/institution.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>-->
            <!-- <div  class="row justify-content-center">
                <img v-if="list.image"  style="width: 100%;" :src="list.image">
            </div>-->
            <div class="mt-3 mb-5">
              <p style="color:black;font-size:20px;font-weight:bold">{{list.headline}}</p>
              <iframe
                v-if="list.image && extention=='.pdf' "
                :src="list.image"
                width="100%"
                height="500px"
              ></iframe>
              <img v-if="list.image && extention!='.pdf'" style="width: 100%;height:300px;margin-bottom:15px;" :src="list.image" />
              <p v-html="list.content"></p>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
export default {
  components: {},
  data() {
    return {
      message: 'Hello'
    }
  },
  mounted() {
    this.get()
  },
  computed: {
    ...mapGetters({
      list: 'frontent/post'
    }),
    extention: function() {
      // this.list.push(rsp.body)
      if (this.list.image) {
        return this.list.image.match(/.jpg|.pdf|.png/gi).toString()
      } else return false
    }
  },
  methods: {
    async get() {
      try {
        await this.$store.dispatch('frontent/get_post', this.$route.params.slug)
      } catch (e) {}
    },
    checkString() {
      return true
    }
  }
}
</script>