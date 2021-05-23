<template>
    <div class="breaking-news" v-if="lists.data">
        <div class="title"><nuxt-link to="/page/news" class="see-more"><span>সর্বশেষ খবর</span></nuxt-link></div>
        <div class="news">
          <marquee width="100%" direction="left">
            <ul class="notices" v-if="lists.data" style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;">
                <li v-for="(list,key) in this.lists.data" v-bind:key="key" style="float: left;padding-right: 5px;"><nuxt-link :to="'/page/news/'+list.slug"  style=""><i class="fas fa-chevron-right"></i> {{list.headline.substring(0,40)+".."}}</nuxt-link></li>
            </ul>
          </marquee>
        </div>
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
      lists: 'frontent/news'
    }),
    methods: {
      async get () {
        let search = {type:6,limit:4};
        let page = 1
        try {
          await this.$store.dispatch('frontent/get_news',{search,page})
        } catch (e) {
          
        }
      },
    }
  }
</script>
<style scoped>
.breaking-news { width: 100%;}
.title { background-color: rgb(117,171,40); padding: 10px; color: #fff; font-size: 12px; display: inline-block; width:7%; float: left;}
.title:after { position: absolute; z-index: 0; content: ""; left: 7%; top: 287px; height: 38px; width: 15px; background-color: inherit; -webkit-transform: skewX(-17deg); -moz-transform: skewX(-17deg); -ms-transform: skewX(-17deg); transform: skewX(-17deg); }
.news { background-color: rgb(205,224,214); padding: 7.5px;
    padding-left: 14px;
    color: #000;
    font-size: 12px;
    margin-left: -5px;
    display: inline-block;
    width: 62%;
    /* border-right: 171px solid transparent; */
    overflow: hidden;
    float: left;}
.news:after { position: absolute; z-index: 0; content: ""; left: 67%; top: 287px; height: 38px; width: 25px; background-color: inherit; -webkit-transform: skewX(-17deg); -moz-transform: skewX(-17deg); -ms-transform: skewX(-17deg); transform: skewX(-17deg); }
.title>a{
    color: #fff;
}
.news>ul>li>a{
    color: #000;
}
.breaking-news { margin-top: 7px; }
@media (max-width: 767px){
    .breaking-news { margin-top: 0px; }
    .title:after { top: 280px; }
    .news { border-right: 0px solid transparent; }
}
@media (max-width: 464px){
    .breaking-news { margin-top: 0px; }
    .title { width: 20%; }
    .title:after { left: 20%; }
    .news { width: 80%; }
    .news:after { top:280px }
}
</style>