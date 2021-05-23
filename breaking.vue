<template>
    <div class="breaking-news" v-if="lists.data">
        <div class="title"><nuxt-link to="/page/news" class="see-more"><span >সর্বশেষ খবর</span></nuxt-link></div>
        <div class="news">
          <marquee width="100%" direction="left">
            <span v-for="(list,key) in this.lists.data" v-bind:key="key" style="padding-right: 5px;font-size:14px;white-space: nowrap ; white-space: pre"><nuxt-link :to="'/page/news/'+list.slug"  style="color: rgb(7,102,51)">&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i> {{list.headline}}</nuxt-link></span>
            <!-- <ul class="notices" v-if="lists.data" style="list-style-type: none;margin: 0;padding: 0;overflow: hidden;">
                <li v-for="(list,key) in this.lists.data" v-bind:key="key" style="float: left;padding-right: 5px;font-size:14px;"><nuxt-link :to="'/page/news/'+list.slug"  style="color: rgb(7,102,51)">&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i> {{list.headline}}</nuxt-link></li>
            </ul> -->
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
.title { background-color: rgb(117,171,40); padding: 7px; color: #fff; font-size: 16px; display: inline-block; width:7%; float: left;z-index: 2;position: absolute;}
.title:after { position: absolute; z-index: 0; content: ""; left: 92%; top: 0px; height: 38px; width: 15px; background-color: inherit; -webkit-transform: skewX(-17deg); -moz-transform: skewX(-17deg); -ms-transform: skewX(-17deg); transform: skewX(-17deg); }
.news { 
  clear: both; 
  background-color: rgb(205,224,214); 
  padding-top: 6px;
  padding-bottom: 5.3px;
  width: 100%;

  /* position: absolute;  */
  /* z-index: 1; */
}
.news:after { position: absolute; z-index: 2; content: ""; left: 74%; top: 287px; height: 38px; width: 100%; background-color: #fff; -webkit-transform: skewX(-17deg); -moz-transform: skewX(-17deg); -ms-transform: skewX(-17deg); transform: skewX(-17deg); }
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