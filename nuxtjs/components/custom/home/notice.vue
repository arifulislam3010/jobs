<template>
    <div class="card card-notice-board" data-background="full">
      <span class="heading">নোটিশ বোর্ড</span>
      <ul class="notices" v-if="lists.data">
        <li v-for="(list,key) in this.lists.data" v-bind:key="key"><nuxt-link :to="'/page/notice/'+list.slug" ><span>{{list.headline.substring(0,25)+".."}}</span></nuxt-link></li>
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
        let search = {type:2,limit:4};
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
.card-notice-board { border: 3px solid rgb(117,171,40); border-radius: 20px; height: 90%; }
  .card-notice-board .heading { background-color: rgb(117,171,40); color: #fff; border-radius: 30px; width: max-content; padding: 7px 20px; margin-left: -2px; }
  .card-notice-board .notices { padding: 10px; font-size: 13px; list-style: inside; }
  .card-notice-board .notices li { margin-bottom: 2px; color: #000; }
  .see-more { position: absolute; bottom: 10px; right: 20px; text-align: right; font-size: 12px; }
</style>