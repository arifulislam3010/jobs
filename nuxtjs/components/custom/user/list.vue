<template>
    <table class="table-bordered" style="width:100%; margin-bottom:15px">
        <thead>
            <tr>
              <th style="font-size:14px !important;" >#</th>
              <!-- <th style="font-size:14px !important;">লোগো</th> -->
              <th style="font-size:14px !important;">নাম</th>
              <th style="font-size:14px !important;">ফোন</th>
              <th style="font-size:14px !important;">ঠিকানা</th>
              <!-- <th style="font-size:14px !important;">বিস্তারিত</th> -->
            </tr>
        </thead>
        <tbody  >
            <tr v-for="(user,key) in users.data" :key="key">
              <th scope="row">{{seria[key]}}</th>
              <!-- <td>
                <img style="height:30px;" v-if="user.image != null " class="img img-raised rounded-circle" :src="user.image">
                <img style="height:30px;" v-if="user.image == null " class="img img-raised rounded-circle" src="../../../assets/image/institution/institution.png">
              </td> -->
              <td>{{user.name}}</td>
              <td>{{user.phone}}</td>
              <td><span v-for="(ad,key) in user.address" :key="key">{{ad.name}}</span></td>
              <!-- <td><nuxt-link style="background-color:#74CE35" :to="'/list/details/'+user.id+'/'+user.name.replace(/\//g, '')"  class="btn btn-sm btn-info mr-4 mt-3">বিস্তারিত</nuxt-link></td> -->
            </tr>
        </tbody>
    </table>
    <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
</template>
<script>
  export default {
    props:['users'],
    components: {
    },
    data() {
      return {
       seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
      }
    },
    mounted(){
      
    },
   
    methods: {
     getResults(){

     }
    }
  }
</script>
<style >
.table-bordered th,td{
  padding:10px;
}

</style>