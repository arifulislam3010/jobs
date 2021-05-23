<template>
    <div>
       <div class="tables-2 mb-5">
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
               
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  <tbody>
                    <tr class="bg-primary">
                      <td class="text-white">
                          <b>Name</b>
                      </td>
                      <td class="text-white">
                          <b>Email</b>
                      </td>
                      <td class="text-white">
                          <b>Phone</b>
                      </td>
                      <td class="text-white">
                          <b>Message</b>
                      </td>
                      <td class="text-white">
                          <b>Created at</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>{{list.name}}</td>
                      <td>{{list.email}}</td>
                      <td>{{list.phone}}</td>
                      <td>{{list.message}}</td>
                      <td>{{list.created_at}}</td>
                    </tr>
                  </tbody>
                </table>
                 <pagination  :data="this.lists" @pagination-change-page="get"></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination';

export default {
  name: "JobPost",
  middleware: 'auth',
  layout: 'dashboard',
  components: {pagination},
  data() {
    return {
      modalOpen:false,
      type: 1,
    }
  },
  computed: mapGetters({
    lists: 'admin/complainOpinion/lists'
  }),
  mounted(){
    this.get();
  },
  methods: {
    async get (page = 1) {
      try {
        await this.$store.dispatch('admin/complainOpinion/get',{type:this.type,page})
      } catch (e) {
        
      }
    },
  }
};
</script>
