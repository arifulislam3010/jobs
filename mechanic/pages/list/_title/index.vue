<template>
    <div>
        <div v-if="lists.data" class="team-5">
        <div v-if="lists.data.length>0" class="container">
          <div style="clear:both" class="row ">
            <div v-if="$route.params.title == 'training-centers'" class="col-md-4" style="clear:both;padding:0;margin:0;">
              <div  class="form-group ">
                <div class="input-group">
                    <select  v-model="training_type" name="training_type" class="form-control">
                      <option value="">ট্রেনিং এর ধরন </option>
                      <option v-for="(t_type,key) in types" :key="key" :value="t_type.id">{{t_type.name}}</option>
                    </select>
                </div>
              </div>
            </div>
            <div v-if="$route.params.title == 'training-centers'" class="col-md-4" style="clear:both;padding:0;margin:0;">
              <div  class="form-group ">
                <div class="input-group">
                    &nbsp;<input @keyup.enter="trigger" v-model="address" type="text" class="form-control" placeholder="ঠিকানা" >
                </div>
              </div>
            </div>
            <div class="col-md-4" style="clear:both;padding:0;margin:0;">
              <div  class="form-group ">
                <div class="input-group">
                    &nbsp;<input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
                    <div class="input-group-append">
                      <button @click="getData(1)" class="btn btn-outline-secondary" type="button">খুঁজুন</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- <div  class="form-group col-md-4 clear">
              <input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
            </div> -->
            <!-- <div  class="input-group  col-md-4 clear">
              <input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
              <div class="input-group-append">
                <button @click="getData(1)" class="btn btn-outline-secondary" type="button">খুঁজুন</button>
              </div>
            </div> -->
          </div>
            
          <div v-if="lists.data" class="row">
            <!-- <users v-for="(list,key) in this.lists" v-bind:key="key" :user="list"></users> -->
            
            <users  :users="this.lists"></users>
            <pagination :data="this.lists" @pagination-change-page="get" :limit="1"></pagination>
          </div>
          <div style="height:50px;width:100%"></div>
        </div>
        <div v-if="lists.data" class="container">
            <div v-if="lists.data.length<=0 && search_click">
                <div style="clear:both" class="row ">
                  <div v-if="$route.params.title == 'training-centers'" class="col-md-4" style="clear:both;padding:0;margin:0;">
                    <div  class="form-group ">
                      <div class="input-group">
                          <select  v-model="training_type" name="training_type" class="form-control">
                            <option value="">ট্রেনিং এর ধরন </option>
                            <option v-for="(t_type,key) in types" :key="key" :value="t_type.id">{{t_type.name}}</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div v-if="$route.params.title == 'training-centers'" class="col-md-4" style="clear:both;padding:0;margin:0;">
                    <div  class="form-group ">
                      <div class="input-group">
                          &nbsp;<input @keyup.enter="trigger" v-model="address" type="text" class="form-control" placeholder="ঠিকানা" >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4" style="clear:both;padding:0;margin:0;">
                    <div  class="form-group ">
                      <div class="input-group">
                          &nbsp;<input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
                          <div class="input-group-append">
                            <button @click="getData(1)" class="btn btn-outline-secondary" type="button">খুঁজুন</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div  class="form-group col-md-4 clear">
                    <input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
                  </div> -->
                  <!-- <div  class="input-group  col-md-4 clear">
                    <input @keyup.enter="trigger" v-model="name" type="text" class="form-control" placeholder="নাম" >
                    <div class="input-group-append">
                      <button @click="getData(1)" class="btn btn-outline-secondary" type="button">খুঁজুন</button>
                    </div>
                  </div> -->
                </div>
            </div>
            <div class="col-md-12 mt-2" v-if="lists.data.length<=0">
              <p v-if="search_click && $route.params.title == 'recruiting-agency'" style="margin:20px auto;font-size:30px;color:red;text-align:center">কোনো এজেন্সী খুজে পাওয়া যায় নি</p>
              <p v-else style="margin:20px auto;font-size:30px;color:#888;text-align:center">কোন তথ্য পাওয়া যায় নি</p>
            </div>
        </div>
        <input  @click="getData(1)" ref="sendReply" type="hidden">
      </div>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import users from "~/components/custom/user/list.vue";
  export default {
    components: {
      users,
      pagination
    },
    data() {
      return {
        type:0,
        name:'',
        search_click:false,
        types:[],
        training_type:'',
        address:''
      }
    },
    mounted(){
      if(this.$route.params.title == 'recruiting-agency'){
          this.type = 3;
      }
      if(this.$route.params.title == 'training-centers'){
          this.type = 4;
          this.getType();
      }
      if(this.$route.params.title == 'financial-organization'){
          this.type = 5;
      }
      if(this.$route.params.title == 'important-embassy'){
          this.type = 7;
      }
      this.get();
    },
    computed: mapGetters({
      lists: 'frontent/users'
    }),
    methods: {
      async getType(){
        await this.$axios.get('api/get-training-center-type').then(response=>{
          this.types = response.data;
        })
      },
      trigger () {
          this.$refs.sendReply.click()
      },
      async getData(search_click){
        if(search_click == 1){
            this.search_click = true
          }
          else{
            this.search_click = false
          }
          this.get();
      },
      async get (page = 1) {
        // this.$nuxt.$loading.start();
          let data = {
              role:this.type,
              name:this.name,
              training_type:this.training_type,
              address:this.address
          }
        try {
          await this.$store.dispatch('frontent/get_users',{data,page})
        } catch (e) {
          
        }
      },
    }
  }
</script>
<style>
.page-item.active .page-link {
    background-color: #75ab28;
    border-color: #75ab28;
}
.search-info{
  margin-left:60%;
  margin-bottom:10px;
}
.clear{
  clear: both;
}
@media only screen and (max-width: 600px) {
  .search-info{
    margin-left:10%;
    margin-bottom:10px;
  }
}
</style>