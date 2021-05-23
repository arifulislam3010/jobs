<template>
    <div class="container">
      <div class="row">
          <div v-for="(list,key) in lists.data" :key="key" @click="openDetails(list,lists,key)" class="col-md-4 mt-4">
              <div v-if="list.shoulder" class="card card-hover">
                <div style="width:100%;padding:8px 8px 0px 8px">
                  <div style="width:100%;height:180px;">
                      <div style="width:100%;height:40px;background-color:#ebedf1;text-align:center">
                          <h4>{{list.shoulder}}</h4>
                      </div>
                      <div style="width:100%;height:140px;">
                          <img v-if="list.image" style="height:100%;width:100%;" :src="list.image" alt="">
                      </div>
                  </div>
                  <div style="text-align:center;width:100%;height:40px;margin-top:2px;">
                      <h5>{{list.headline}}</h5>
                  </div>
                </div>
              </div>
              <div v-else class="card card-hover">
                  <div style="width:100%;padding:8px 8px 0px 8px">
                    <div style="width:100%;height:180px;">
                      <img v-if="list.image" style="height:100%;width:100%;" :src="list.image" alt="">
                    </div>
                    <div style="text-align:center;width:100%;height:40px;margin-top:2px;">
                        <h5>{{list.headline}}</h5>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <div  style="width:100%;" class="mt-4">
        <pagination :data="this.lists" @pagination-change-page="get" :limit="1"></pagination>
      </div>
      <Preparation ref="pre" />
    </div> 
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import Preparation from "~/components/dashboard/preparation.vue";
  export default {
    components: {
      Preparation,
      pagination
    },
    data() {
      return {
        type:0,
        name:'',
        lists:{}
      }
    },
    mounted(){
      this.get();
    },
    methods: {
      openDetails(list,lists,index){
         this.$refs.pre.openModal(list,lists,index)
      },
      async get (page = 1) {
          let data = {
              type:13,
              limit:15
          }
        try {
          await this.$axios.post('api/frontend/posts?page='+page,data).then(response =>{
            this.lists = response.data
          })
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

@media only screen and (max-width: 600px) {
  .search-info{
    margin-left:10%;
    margin-bottom:10px;
  }
}

.card-hover{
  cursor: pointer;
  box-shadow: 0 5px 15px rgba(50,50,93,.1), 0 5px 10px rgba(0,0,0,.07);
  -webkit-transition: -webkit-transform .8s ease-in-out;
  transition: transform .8s ease-in-out;
}
.card-hover:hover{
  box-shadow: 0 15px 35px rgba(50,50,93,.1), 0 5px 15px rgba(0,0,0,.07);
  -webkit-transform: rotate(8deg);
  transform: rotate(8deg);
}
</style>