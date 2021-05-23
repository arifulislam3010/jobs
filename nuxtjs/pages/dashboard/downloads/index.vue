<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button  style="float: right;margin: 3px;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add"></i>  Add
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
                      <td></td>
                      <td class="text-white pull-right">
                          <b>&nbsp;&nbsp;একশন</b>
                      </td>
                      
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>
                       {{list.title}}
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="pull-right">
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button> -->
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="sliderView(list)" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteData(list.id,key)" type="button" class="btn btn-warning">
                        <i class="fa fa-trash"></i>
                        </button>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    <create v-show="modalOpen" ref="user_create"></create>
    <sliderView v-show="slider_view" ref="user_slider_view"></sliderView>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/Content/slider";
import sliderView from "~/components/dashboard/Content/sliderView";
export default {
  name: "downloads",
  middleware: 'auth',
  layout: 'dashboard',
  components: {create,sliderView},
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
      this.get_a();
      this.get_r();
      
  },
  methods: {
    async get_r () {
      try {
        await this.$store.dispatch('admin/user/role/get')
      } catch (e) {
        
      }
    },
    async get () {
         let search = {content_category:2,limit:4,page:1};
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
      console.log(data)
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
