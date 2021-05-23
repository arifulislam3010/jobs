<template>
    <div class="wrapper"> 
    <section v-if="list" class="section bg-secondary" style="padding-top: 24rem;">
      <div class="container">
        <div class="card card-profile shadow mt--300">
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
            </div>  -->
            <!-- <div  class="row justify-content-center">
                <img v-if="list.image"  style="width: 100%;" :src="list.image">
            </div>  -->
            <div  class="mt-5">
               <p style="color:black;font-size:20px;">{{list.headline}}</p>
               <img v-if="list.image"  style="width: 100%;" :src="list.image">
               <p v-html="list.content"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
  export default {
    components: {
    },
    data() {
      return {
       
      }
    },
    mounted(){
      this.get();
      
    },
    computed: mapGetters({
      list: 'frontent/post'
    }),
    methods: {
      async get () {
        try {
          await this.$store.dispatch('frontent/get_post',this.$route.params.slug)
        } catch (e) {
          
        }
      },
    }
  }
</script>