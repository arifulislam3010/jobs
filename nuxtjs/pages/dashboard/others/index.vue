<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
                <button  style="float: right;margin: 3px; margin-right: 0;" @click="openModal()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                   <i class="ni ni-fat-add mr-1"></i>Add
                </button>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                          <b>Name</b>
                      </td>
                      <td class="text-white">
                          <b>Created at</b>
                      </td>
                      <td class="text-white">
                          <b>Updated at</b>
                      </td>
                      <td class="text-white">
                          <b>Actions</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists" v-bind:key="key">
                      <td>{{list.headline}}</td>
                      <td>{{list.created_at}}</td>
                      <td>{{list.updated_at}}</td>
                      <td class="text-center">
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="openModal(list,key)" type="button" class="btn btn-primary mr-0">
                        <i class="fa fa-pencil-square-o"></i>
                        </button>
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="" type="button" class="btn btn-info mr-0">
                        <i class="fa fa-eye"></i>
                        </button> -->
                        <!-- <button  style="padding: 2px 7px; font-size: 13px;" @click="remove(list.id,key)" type="button" class="btn btn-warning mr-0">
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
      <create v-show="modalOpen" ref="create" :type="postType"></create>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from "~/components/dashboard/post";
export default {
  name: "JobPost",
  middleware: 'auth',
  layout: 'dashboard',
  components: {create},
  data() {
    return {
      modalOpen:false,
      postType: 4,
    }
  },
  computed: mapGetters({
    lists: 'admin/post/lists'
  }),
  mounted(){
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
