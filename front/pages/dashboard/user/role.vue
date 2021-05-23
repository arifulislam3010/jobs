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
                        <b>Role Title</b>
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
                    <tr v-for="(list,key) in this.lists" v-bind:key="key">
                      <td>
                       {{list.name}}
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
    <create v-show="modalOpen" ref="role_create"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/user/role/create";
export default {
  name: "Role",
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
    }
  },
  computed: mapGetters({
    lists: 'admin/user/role/lists'
  }),
  mounted(){
      this.get();
      
  },
  methods: {
    async get () {
      try {
        await this.$store.dispatch('admin/user/role/get')
      } catch (e) {
        
      }
    },
    openModal(data='',key='') {
      this.$refs.role_create.openModal(data,key);
    }
  }
};
</script>
