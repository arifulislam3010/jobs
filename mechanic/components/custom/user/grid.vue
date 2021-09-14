<template>
    <div class="col-lg-3 col-md-3" style="margin-top:10px">
        <div class="card card-profile">
        <div class="card-header bg-info" style="background-image: url('../../../assets/argon/img/ill/inn.svg')">
            <div class="card-avatar">
            <a href="javascript:;">
                <img v-if="user.image != null " class="img img-raised rounded-circle" :src="user.image">
                <img  v-if="user.image == null " class="img img-raised rounded-circle" src="../../../assets/image/institution/institution.png">
            </a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="d-flex justify-content-between">
                <nuxt-link :to="'/list/details/'+user.id+'/'+user.name" class="btn btn-sm btn-info mr-4 mt-3">Details</nuxt-link>
            <a href="javascript:;" class="btn btn-sm btn-default float-right mt-3">Message</a>
            </div>
            <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                <div>
                    <span class="heading">22</span>
                    <span class="description">Workers</span>
                </div>
                <div>
                    <span class="heading">10</span>
                    <span class="description">Country</span>
                </div>
                <!-- <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                </div> -->
                </div>
            </div>
            </div>
            <div class="text-center">
            <h5 class="h4">
                {{user.name}}<span class="font-weight-light">, 31</span>
            </h5>
            <div class="font-weight-300">
                <i class="ni location_pin mr-2"></i>Beijing, China
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
  export default {
    props:['user'],
    components: {
      
    },
    data() {
      return {
       
      }
    },
    mounted(){
      
      
    },
   
    methods: {
     
    }
  }
</script>