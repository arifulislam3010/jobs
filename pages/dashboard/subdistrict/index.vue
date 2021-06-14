<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button  style="float: right;margin: 3px;" @click="openAddModal()" type="button" class="btn btn-primary" >
                   <i class="ni ni-fat-add"></i>  যোগ করুন
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  
                  <tbody>
                    <tr class="bg-primary text-white text-center">
                      <td class="">
                        <b>উপজেলা</b>
                      </td>
                      <td class="">
                        <b>জেলা</b>
                      </td>
                      <td >
                          <b>একশন</b>
                      </td>
                    </tr>
                    <tr class="text-center" v-for="(list,index) in lists.data" :key="index">
                      <td>{{list.name}} </td>
                      <td>{{list.parent_name}} </td>
                      <td class="text-center">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openEditModal(list,index)" type="button" class="btn btn-primary">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal()" type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteUser(index,list.id)" type="button" class="btn btn-warning">
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
    <create  ref="create"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/others/post";
import pagination from 'laravel-vue-pagination';
import { type } from 'os';
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
      data : {
        name : '',
        parent_id : ''
      }
    }
  },
  computed: mapGetters({
    lists: 'admin/others/subdistricts'
  }),
  mounted(){
      this.get();
      this.getDistrict();
  },
  methods: {
    async get (page=1) {
      var data = {type:'subdistricts',limit:10,page}
        await this.$store.dispatch('admin/others/get',data)
    },
    async getDistrict (page=1) {
      var data = {type:'districts',limit:100,page}
        await this.$store.dispatch('admin/others/get',data)
    },
    // openModal(data='',key='') {
    //   this.$refs.user_create.openModal(data,key);
    // },
    openAddModal(){
      var type = 'subdistricts';
      var header = 'subdistricts';
      this.$refs.create.openModal(this.data,'',type,header);
    },
    openEditModal(data,key){
      var type = 'subdistricts';
      var header = 'subdistricts';
      this.$refs.create.openModal(data,key+1,type,header);
    },
    async deleteUser(key,id){
      try {
        var data = {
          index:key,
          id:id,
          type:'subdistricts'
        }
        await this.$store.dispatch('admin/others/delete',data)
      } catch (e) {
        
      }
    }
  }
};
</script>

