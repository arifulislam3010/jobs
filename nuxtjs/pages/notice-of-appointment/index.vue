<template>
    <div>
        <div class="team-5">
        <div class="container table-responsive">
         <table class="table-bordered" style="width:100%; margin-bottom:15px">
            <thead>
              <tr>
                <th style="font-size:14px !important;">শিরোনাম</th>
                <th style="font-size:14px !important;" >উপাধি</th>
                <th style="font-size:14px !important;">সময়সীমা</th>
                <th style="font-size:14px !important;"></th>
              </tr>
            </thead>
            <tbody v-if="lists">
              <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                <td>{{list.headline.substr(0,20)}}</td>
                <td>{{list.designation}}</td>
                <td>{{list.expired_at}}</td>
                <td>
                  <button style="background-color:#74CE35" type="button" class="btn btn-sm btn-primary mr-0" @click="postView(list)">View</button>
                  <!-- <button type="button" v-if="type==1" class="btn btn-sm btn-primary mr-0" @click="applyView(list.id)">Apply</button> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <postView v-show="modalOpen" ref="postView"></postView>
      <applyView v-show="applyModalOpen" ref="applyView"></applyView>
    </div>
</template>
<script>
// Vue.component('pagination', require('laravel-vue-pagination'));
import { mapMutations, mapGetters } from 'vuex';
import users from "~/components/custom/user/list.vue";
import postView from "~/components/custom/post/postView.vue";
import applyView from "~/components/custom/post/applyView.vue";
  export default {
    components: {
      users,postView,applyView
    },
    data() {
      return {
        modalOpen:false,
        applyModalOpen: false,
        post: '',
        type: '',
        seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
      }
    },
    mounted(){
      this.type = 1;
      this.get();
    },
    computed: mapGetters({
      lists: 'frontent/appointments'
    }),
    methods: {
      async get () {
          let search = {type:this.type,limit:10,page:1};
        try {
          await this.$store.dispatch('frontent/get_appointments',search)
        } catch (e) {
          
        }
      },
      postView(data){
        this.$refs.postView.openModal(data);
      },
      applyView(id){
        this.$refs.applyView.openModal(id);
      }
    }
  }
</script>

<style >
.table-bordered th,td{
  padding:10px;
}

</style>