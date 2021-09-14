<template>
    <div class="card card-notice-board" data-background="full">
      <span class="heading">নোটিশ বোর্ড</span>
      <ul class="notices" v-if="lists.data">
        <li v-for="(list,key) in this.lists.data" v-bind:key="key"><nuxt-link :to="'/page/notice/'+list.slug" ><span>&nbsp;<i class="fas fa-arrow-alt-circle-right"></i>&nbsp;{{list.headline.substring(0,32)+"..."}}</span></nuxt-link></li>
        <nuxt-link to="/page/notices" class="see-more"><span>আরো দেখুন...</span></nuxt-link>
      </ul>
    </div>
</template>
<script>
  import { mapMutations, mapGetters } from 'vuex';
  export default {
    data() {
      return {
        notices: ''
      }
    },
    mounted(){
      this.get();
    },
    computed: mapGetters({
      lists: 'frontent/notices'
    }),
    methods: {
      async get () {
        let search = {type:2,limit:10};
        let page = 1
        try {
          await this.$store.dispatch('frontent/get_notices',{search,page})
        } catch (e) {
          
        }
      },
      // postView(data){
      //   this.$refs.postView.openModal(data);
      // },
      // applyView(id){
      //   this.$refs.applyView.openModal(id);
      // }
    }
  }
</script>
<style scoped>
  /* .card-notice-board { border: 3px solid rgb(117,171,40); border-radius: 20px; height: 90%; }
  .card-notice-board .heading { background-color: rgb(117,171,40); color: #fff; border-radius: 30px; width: max-content; padding: 7px 20px; margin-left: -2px; }
  .card-notice-board .notices { padding: 6px; font-size: 16px; list-style: none; }
  .card-notice-board .notices li a{ margin-bottom: 2px; color:  rgb(7,102,51); }
  .see-more { position: absolute; font-weight:bold; bottom: 10px; right: 20px; text-align: right; font-size: 16px;color:  rgb(7,102,51); } */

  .card-notice-board { border: 1px solid rgb(117,171,40);margin-top:5px; border-radius: 0%; height: 96%;position: relative; z-index: 1;}
  .card-notice-board .heading { background-color: rgb(117,171,40); color: #fff; border-radius: 20px; width: max-content; padding: 5px 25px;margin-top: -18px; margin-left: calc(50% - 55px); }
  .card-notice-board .notices { padding: 6px; font-size: 16px; list-style: none;}
  .card-notice-board .notices li a{ margin-bottom: 2px; color:  rgb(7,102,51); }
  .see-more { position: absolute; font-weight:bold; bottom: 10px; right: 20px; text-align: right; font-size: 16px;color:  rgb(7,102,51); }
  .card-notice-board::after {
    content: '';
    position: absolute;
    top: -8px;
    left: -8px;
    right: -8px;
    bottom: -8px;
    z-index: -1;
    border: 1px solid rgb(117,171,40);
  }
  .card-notice-board .notices li i{
    color: rgb(117,171,40);
    font-size: 20px;
  }
  .card-notice-board .notices li i{
    margin-top: 5px;
  }
  
</style>