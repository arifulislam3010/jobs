<template>
    <div class="wrapper">
       
    <section v-if="list" class="section bg-secondary" style="padding-top: 24rem;">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="javascript:;">
                    <img v-if="list.image" style="height:100px;margin-top: -34px;margin-left: calc(50% - 65px);" :src="list.image" class="rounded-circle">
                    <img v-else style="height:100px;margin-top: -34px;margin-left: calc(50% - 65px);" src="../../../../assets/image/institution/institution.png" class="rounded-circle">
                  </a>
                </div>
              </div>
              <!-- <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading">22</span>
                    <span class="description">Workers</span>
                  </div>
                  <div>
                    <span class="heading">10</span>
                    <span class="description">Country</span>
                  </div>
                  <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                  </div>
                </div>
              </div> -->
            </div>
               
            <div  class="text-center mt-5">
              <span class="font-weight-bold">{{list.name}}</span><br>
            </div>
            <div class="description pl-4">
                <div style="margin-top:20px;" class="row">
                  <div class="col">
                    <h6 class="title text-info">Contact: </h6>
                    <span class="font-weight-light"><i class="fas fa-phone-alt"></i> {{list.mobile_number}}</span><br>
                    <span class="font-weight-light"><i class="far fa-envelope"></i> {{list.email}}</span><br>
                    <span class="font-weight-light" v-if="list.address"><i class="fas fa-map-marker-alt"></i> {{list.address[0].name}}</span><br>
                    <span class="font-weight-light" v-for="(address,key) in list.address" :key="key"  v-if="key!=0">&nbsp;&nbsp;&nbsp;&nbsp;{{address.name}} <br></span>
                    <h6 style="margin-top:10px;" class="title text-info">Website: </h6>
                    <span class="font-weight-light"><i class="fas fa-globe-americas"></i> {{list.website}}</span><br>
                  </div>
                  <div class="col">
                    <h6 class="title text-info">Address: </h6>
                    <span class="font-weight-light" v-if="list.address"><i class="fas fa-map-marker-alt"></i> {{list.address[0].name}}</span><br>
                        <span class="font-weight-light" v-for="(address,key) in list.address" :key="key"  v-if="key!=0">&nbsp;&nbsp;&nbsp;&nbsp;{{address.name}} <br></span>
                  </div>
                </div>
            </div>
            <div class="description pl-4">
                
            </div>
            <div class="description pl-4">
                
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center"> 
                <div class="col-lg-9">
                  <p>{{list.about}}</p>
                </div>
              </div>
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
      list: 'frontent/user'
    }),
    methods: {
      async get () {
        try {
          await this.$store.dispatch('frontent/get_user',this.$route.params.id)
        } catch (e) {
          
        }
      },
    }
  }
</script>