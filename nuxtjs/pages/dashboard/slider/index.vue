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
                        <b>User Name</b>
                      </td>
                      <td>
                          <b>Created By</b>
                      </td>
                      <td>
                          <b>Updated By</b>
                      </td>
                      <td>
                          <b>Action</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>
                       {{list.title}}
                      </td>
                      <td class="text-center">
                        
                      </td>
                      <td class="text-center">
                      </td>
                      <td class="text-center">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-warning">
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
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/Content/slider";
export default {
  name: "slider",
  middleware: 'auth',
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
       let search = {content_category:1,limit:4,page:1};
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
    }
  }
};
</script>
