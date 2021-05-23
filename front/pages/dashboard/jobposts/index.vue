<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button v-if="$auth.user.role_id == 3"  style="float: right;margin: 3px; margin-right: 0;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add mr-1"></i>যোগ করুন
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                          <b>পদবী</b>
                      </td>
                      <td class="text-white" >
                          <b>নির্মিত </b>
                      </td>
                      
                      <td class="text-white">
                          <b>পাবলিশ </b>
                      </td>
                      <td class="text-white" >
                          <b>ডেডলাইন</b>
                      </td>
                      <td class="text-white" >
                          <b>এজেন্সির নাম</b>
                      </td>
                     
                      <td v-if="$auth.user.role_id == 3" class="text-white">
                          <b>একশন</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists" v-bind:key="key">
                      <td >{{list.headline}}</td>
                      <td >{{list.created_at}}</td>
                      <td><span v-if="list.published_at">{{list.published_at}}</span><span v-else>Drafted</span></td>
                      <td>{{list.expired_at}}</td>
                      <td>{{list.author}}</td>
                      <td v-if="$auth.user.role_id == 3" >
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary mr-0">
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
  middleware: 'sup-agency-admin',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
      postType: 0,
    }
  },
  computed: mapGetters({
    lists: 'admin/post/lists'
  }),
  mounted(){
    this.postType = 1;
    this.get();
  },
  methods: {
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
