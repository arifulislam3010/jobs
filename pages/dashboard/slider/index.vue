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
                    <tr class="bg-primary text-white">
                      <td class="">
                        <b>টাইটেল</b>
                      </td>
                      <td>
                          <b></b>
                      </td>
                      <td>
                          <b></b>
                      </td>
                      <td>
                          <b></b>
                      </td>
                      <td>
                          <b>অ্যাকশন</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>
                       {{list.title}}
                      </td>
                      <td class=""></td>
                      <td class=""></td>
                      <td class="">
                      </td>
                      <td class="">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteData(list.id,key)" type="button" class="btn btn-warning">
                        <i class="fa fa-trash"></i></button>
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button> -->
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-warning">
                        <i class="fa fa-trash"></i>
                        </button> -->
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
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/Content/slider";
export default {
  name: "slider",
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
    }
  },
  computed: mapGetters({
    lists: 'admin/slider/lists'
  }),
  mounted(){
      this.get();
  },
  methods: {
    async get () {
       let search = {content_category:1,limit:4,page:1};
      try {
        await this.$store.dispatch('admin/slider/get',search)
      } catch (e) {
        
      }
    },
    openModal(data='',key='') {
      this.$refs.user_create.openModal(data,key);
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
