<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 ">
            <div class="row mb-1">
                <div style="width:73%">
                </div>
                <div style="width:20%">
                  <input
                    class="form-control"
                    v-model="search.search"
                    placeholder="নাম"
                    type="text"
                  />
                </div>
                &nbsp;
                <div style="width:5%">
                  <button
                      @click="get()"
                      type="button"
                      class="btn btn-primary"
                    >খুঁজুন</button>
                </div>
              </div>
              <div class="table-responsive mb-0"  v-if="this.lists.data">
                <table class="table table-pricing" v-if="this.lists.data.length>0">
                  
                  <tbody>
                    <tr class="bg-primary text-white">
                      <td>
                        <b>নাম</b>
                      </td>
                      <td>
                        <b>পদবি</b>
                      </td>
                      <td>
                          <b>ইমেইল</b>
                      </td>
                      <td>
                          <b>ফোন</b>
                      </td>
                      <td>
                          <b>কর্মস্থল</b>
                      </td>
                      <td>
                        স্ট্যাটাস
                      </td>
                      <td>
                          <b>একশন</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in lists.data" v-bind:key="key">
                      <td>{{list.name}}</td>
                      <td><span v-if="list.personal">{{list.personal.name}}</span></td>
                      <td>{{list.email}}</td>
                      <td>{{list.phone}}</td>
                      <td >
                          <span v-if="list.address2">
                            <span v-if="list.address2.subdistrict">{{list.address2.subdistrict.upazila_name_eng}},</span>
                            <span v-if="list.address2.district">{{list.address2.district.district_name_eng}},</span>
                            <span v-if="list.address2.division">{{list.address2.division.division_name_eng}}</span>
                          </span>
                      </td>
                      <td>
                        <span style="color:#2dce89" v-if="list.permissions == 1">অনুমোদিত</span>
                        <span style="color:red" v-else>অনুমোদিত নয়</span>
                      </td>
                      <td >
                        <button v-if="list.permissions == 1" style="padding: 2px 7px; font-size: 13px;" @click="statusUpdate(list.id,key,0)" type="button" class="btn btn-warning">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <button v-else style="padding: 2px 7px; font-size: 13px;" @click="statusUpdate(list.id,key,1)" type="button" class="btn btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        </button> 
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteUser(key,list.id)" type="button" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination :data="this.lists" @pagination-change-page="get" :limit="5"></pagination>
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
import pagination from 'laravel-vue-pagination'
export default {
  name: "User",
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {create,pagination},
  data() {
    return {
      modalOpen:false,
      search: {
        migrate: '',
        migrate_date: '',
        division_id: '',
        district_id: '',
        upozila_id: '',
        search: '',
        type: 9,
        limit: 10,
        page: ''
      }
    }
  },
  computed: mapGetters({
    lists: 'admin/user/user/lists'
  }),
  mounted(){
      this.get();
  },
  methods: {
    async statusUpdate(id,index,status){
        var data = {
          id,index,status
        }
        await this.$store.dispatch('admin/user/user/statusUpdate', data)
    },
    go(slug){
      if(slug){
        this.$router.push('/agency/'+slug)
      }
    },
    async get(page = 1) {
      this.search.page = page
      try {
        await this.$store.dispatch('admin/user/user/get', this.search)
      } catch (e) {}
    },
    async getAgency () {
      try {
        await this.$store.dispatch('admin/user/user/getAgency')
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
