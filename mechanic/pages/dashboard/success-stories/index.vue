<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button v-if="$auth.user.type == 6" style="float: right;margin: 3px; margin-right: 0;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add mr-1"></i>যোগ করুন
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                          <b>শিরোনাম </b>
                      </td>
                      <td v-if="$auth.user.type == 1" class="text-white">
                          <b>লেখক </b>
                      </td>
                      <td  v-if="$auth.user.type == 1" class="text-white">
                          <b>স্ট্যাটাস </b>
                      </td>
                       <td class="text-white">
                          <b>নির্মিত </b>
                      </td>
                      <td class="text-white">
                          <b>অ্যাকশন</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists" v-bind:key="key">
                      <td>{{list.headline}}</td>
                      <td  v-if="$auth.user.type == 1">{{list.author}}</td>
                      <td  v-if="$auth.user.type == 1">
                        <span style="color:#2dce89" v-if="list.status == 1">অনুমোদিত</span>
                        <span style="color:red" v-else>অনুমোদিত নয়</span>
                      </td>
                      <td>{{list.created_at}}</td>
                      <td >
                        <button v-if="list.status == 1 && $auth.user.type == 1" style="padding: 2px 7px; font-size: 13px;" @click="statusUpdate(list.id,key,0)" type="button" class="btn btn-warning">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <button v-if="list.status == 0 && $auth.user.type == 1" style="padding: 2px 7px; font-size: 13px;" @click="statusUpdate(list.id,key,1)" type="button" class="btn btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        </button> 

                        <button v-if="$auth.user.type == 6"  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary mr-0">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="" type="button" class="btn btn-info mr-0">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="remove(list.id,key)" type="button" class="btn btn-warning mr-0">
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
      <create v-show="modalOpen" ref="create" :type="postType"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/post";
export default {
  name: "JobPost",
  middleware: 'admin-applicant',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
      postType: 3,
    }
  },
  computed: mapGetters({
    lists: 'admin/post/lists'
  }),
  mounted(){
    this.get();
  },
  methods: {
    async statusUpdate(id,index,status){
      try {
        await this.$store.dispatch('admin/post/statusUpdate',{index,id,status})
      } catch (e) {
        
      }
    },
    async get () {
      try {
        await this.$store.dispatch('admin/post/get',{type:this.postType})
      } catch (e) {
        
      }
    },
    openModal(data='',key='') {
      this.$refs.create.openModal(data,key);
    },
    async remove(id,key){
      await this.$store.dispatch('admin/post/remove',{key:key,id:id}).then(response => {
        this.list = response.data;
      })
      .catch(error => {
        
      })
    }
  }
};
</script>
