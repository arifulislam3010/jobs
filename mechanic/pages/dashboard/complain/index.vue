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
                          <b>নাম </b>
                      </td>
                      <td class="text-white">
                          <b>ইমেইল </b>
                      </td>
                      <td class="text-white">
                          <b>ফোন</b>
                      </td>
                      <td class="text-white">
                          <b>বার্তা</b>
                      </td>
                      <td class="text-white">
                          <b>সময়</b>
                      </td>
                    </tr>
                    <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                      <td>{{list.name}}</td>
                      <td>{{list.email}}</td>
                      <td>{{list.phone}}</td>
                      <td @click="openModal(list)" style="cursor:pointer">{{list.messages.substr(0,30)+'...'}} <i class="fa fa-eye"></i></td>
                      <td>{{list.created_at}}</td>
                    </tr>
                  </tbody>
                </table>
                 <pagination  :data="this.lists" @pagination-change-page="get"></pagination>
                 <viewComplainOpinion ref="details" />
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
import viewComplainOpinion from "~/components/dashboard/complainOpinion";
export default {
  name: "JobPost",
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {pagination, viewComplainOpinion},
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
    openModal(list){
      this.$refs.details.openModal(list);
    },
    async get (page = 1) {
      try {
        await this.$store.dispatch('admin/complainOpinion/get',{type:this.type,page})
      } catch (e) {
        
      }
    },
  }
};
</script>
