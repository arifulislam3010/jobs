<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button v-if="$auth.user.id == 1"  style="float: right;margin: 3px;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add"></i>  যোগ করুন
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  
                  <tbody>
                    <tr class="bg-primary text-white text-center">
                      <td class="">
                        <b>নাম</b>
                      </td>
                      <td>
                          <b>মোবাইল/ফোন</b>
                      </td>
                      <td>
                          <b>ঠিকানা</b>
                      </td>
                      <td v-if="$auth.user.id == 1">
                          <b>একশন</b>
                      </td>
                    </tr>
                    <tr class="text-center" v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>{{list.name}} </td>
                      <td>
                        <span v-if="list.phone">{{list.phone}}</span>
                        <span v-else>{{list.email}}</span>
                      </td>
                      <td>
                        <span v-for="(address,key2) in list.address" :key="key2">{{address.name}}</span>
                      </td>
                      <td v-if="$auth.user.id == 1" class="text-center">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteUser(key,list.id)" type="button" class="btn btn-warning">
                        <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination :data="lists" @pagination-change-page="get" :limit="5"></pagination>
              </div>
            </div>
          </div>
        </div>
    </div>
    <create  ref="user_create"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/user/govt_organization";
import pagination from 'laravel-vue-pagination';
export default {
  name: "finantial-organization",
  middleware: 'sup-and-admin',
  layout: 'dashboard',
  components: {
    create,
    pagination
  },
  data() {
    return {
      modalOpen:false,
    }
  },
  computed: mapGetters({
    lists: 'admin/user/user/lists'
  }),
  mounted(){
      this.get();
  },
  methods: {
    async get (page=1) {
      var data = {role_id:5,page}
        await this.$store.dispatch('admin/user/user/get2',data)
    },
    openModal(data='',key='') {
      // console.log(data)
        // alert(data.id)
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
