<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button  style="float: right;margin: 3px;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add"></i> যোগ করুন
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                        <b>নাম</b>
                      </td>
                      <td></td>
                      <td></td>
                      <td class="text-white">নির্মিত</td>
                      <td class="text-white">
                          <b>&nbsp;&nbsp;একশন</b>
                      </td>
                      
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>
                       {{list.title}}
                      </td>
                      <td></td>
                      <td></td>
                      <td>{{list.created_at}}</td>
                      <td class="">
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button> -->
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="sliderView(list)" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteData(list.id,key)" type="button" class="btn btn-warning">
                        <i class="fa fa-trash"></i>
                        </button>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              <div  style="width:100%;" class="mt-2">
                <pagination :data="this.lists" @pagination-change-page="get" :limit="1"></pagination>
            </div>
            </div>
          </div>
        </div>
    </div>
    <create v-show="modalOpen" ref="user_create"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/Content/slider";
import pagination from 'laravel-vue-pagination'
export default {
  name: "downloads",
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {create,pagination},
  data() {
    return {
      modalOpen:false,
      slider_view:false,
    }
  },
  computed: mapGetters({
    lists: 'admin/slider/lists'
  }),
  mounted(){
      this.get();
      // this.get_a();
      // this.get_r();
      
  },
  methods: {
    async get_r () {
      try {
        await this.$store.dispatch('admin/user/role/get')
      } catch (e) {
        
      }
    },
    async get (page=1) {
         let search = {content_category:2,page};
      try {
        await this.$store.dispatch('admin/slider/get',search)
      } catch (e) {
        
      }
    },
    async get_a () {
      try {
        await this.$store.dispatch('admin/Basic/get_a')
      } catch (e) {
        
      }
    },
    openModal(data='',key='') {
      this.$refs.user_create.openModal(data,key);
    },
    sliderView(data){
      this.$refs.user_slider_view.openSliderViewModal(data);
    },
    async deleteData(id,key){
      var data = {id:id,key:key}
      try {
        await this.$store.dispatch('admin/slider/removeContent',data)
      } catch (e) {
        
      }
      
    }
  }
};
</script>
