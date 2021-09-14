<template>
    <div style="width:100%;">
      <div  @click="go(list.slug)" v-for="(list,key) in users.data" v-bind:key="key" class="card" style="width:100%;margin-bottom:10px;cursor:pointer;">
        <div class="card-body">
          <span v-if="$route.params.title == 'recruiting-agency'" style="font-weight:bold;font-size:20px;margin-bottom:2px;" class="card-title">{{list.name}}</span>
          <star-rating v-if="$route.params.title == 'recruiting-agency'" :star-size="size" :increment="increment" :show-rating="false" :read-only="true" :rating="list.rating"></star-rating>
          <p v-if="$route.params.title == 'recruiting-agency'"></p>
          <h5 v-if="$route.params.title != 'recruiting-agency'">{{list.name}}</h5>
          <span v-if="list.phone"><i class="fa fa-phone" aria-hidden="true"></i> {{list.phone}} <br></span>
          <span v-if="list.contact_number && !list.phone"><i class="fa fa-phone" aria-hidden="true"></i> {{list.contact_number}} <br></span>
          <span v-if="list.email"><i class="far fa-envelope"></i> {{list.email}} <br></span>
          
          <span><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;<span v-for="(ad,key) in list.address" :key="key">{{ad.name}}</span></span>
          <span class="pull-right" v-if="list.training_type_name"><b>ধরন: </b> {{list.training_type_name}} <br></span>
        </div>
      </div>
        <!-- <table class="table-bordered" style="width:100%; margin-bottom:15px">
          <thead>
              <tr>
                <th style="font-size:14px !important;" >#</th>
                <th style="font-size:14px !important;">নাম</th>
                <th style="font-size:14px !important;">ফোন</th>
                <th style="font-size:14px !important;">ঠিকানা</th>
                <th v-if="$route.params.title == 'recruiting-agency'" style="font-size:14px !important;">বিস্তারিত</th>
              </tr>
          </thead>
          <tbody  >
              <tr v-for="(user,key) in users.data" :key="key">
                <th scope="row">{{seria[key]}}</th>
                <td>
                  {{user.name}}
                  <star-rating v-if="$route.params.title == 'recruiting-agency'" :star-size="size" :increment="increment" :show-rating="false" :read-only="true" :rating="user.rating"></star-rating>
                </td>
                <td v-if="user.phone">{{user.phone}}</td>
                <td v-else>{{user.contact_number}}</td>
                <td><span v-for="(ad,key) in user.address" :key="key">{{ad.name}}</span></td>
                <td  v-if="$route.params.title == 'recruiting-agency'" ><nuxt-link v-if="user.slug" style="background-color:#74CE35;border-color:#74CE35" :to="'/agency/'+user.slug"  class="btn btn-sm btn-info mr-4 mt-3">বিস্তারিত</nuxt-link></td>
              </tr>
          </tbody>
      </table> -->
    </div>
    <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
</template>
<script>
  export default {
    props:['users'],
    components: {
    },
    data() {
      return {
       seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫'],
       size:15,
       increment:0.25,
      }
    },
    mounted(){
      
    },
   
    methods: {
     go(slug){
       if(this.$route.params.title == 'recruiting-agency'){
         this.$router.push('/agency/'+slug)
       }
     }
    }
  }
</script>
<style >
.table-bordered th,td{
  padding:10px;
}

</style>