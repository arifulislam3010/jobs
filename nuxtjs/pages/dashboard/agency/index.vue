<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 ">
            <div>
                <!-- <button  style="float: right;margin: 3px;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add"></i>  Add
                </button> -->
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                        <b>User Name</b>
                      </td>
                      <td>
                          <b>Email/phone</b>
                      </td>
                      <td>
                          <b>Address</b>
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
                        {{list.email}} <br>
                        {{list.phone}}
                      </td>
                      <td class="text-center">
                          <ul style="list-style:none">
                              <li v-for="(address,key) in list.address" :key="key">{{address.name}}</li>
                          </ul>
                      </td>
                      <td class="text-center">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(Object.assign({},list),key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteUser(key,list.id)" type="button" class="btn btn-warning">
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
import create from "~/components/dashboard/user/create";
export default {
  name: "User",
  middleware: 'auth',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
    }
  },
  computed: mapGetters({
    lists: 'admin/user/user/lists'
  }),
  mounted(){
      this.getAgency();
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
      try {
        await this.$store.dispatch('admin/user/user/get')
      } catch (e) {
        
      }
    },
    async getAgency () {
      try {
        await this.$store.dispatch('admin/user/user/getAgency')
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
    async deleteUser(key,id){
      try {
        await this.$store.dispatch('admin/user/user/delete',{key,id})
      } catch (e) {
        
      }
    }
  }
};
</script>
