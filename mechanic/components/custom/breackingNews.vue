<template>
    <div class="breaking-news" v-if="lists.data">
        <div v-if="!isMobile" class="title"><nuxt-link to="/page/news" class="see-more"><span >সর্বশেষ খবর</span></nuxt-link></div>
        <div v-if="!isMobile" style="padding-bottom:4px" class="news">
          <marquee width="100%" direction="left">
            <span v-for="(list,key) in this.lists.data" v-bind:key="key" style="padding-right: 5px;font-size:14px;white-space: nowrap ; white-space: pre"><nuxt-link :to="'/page/news/'+list.slug"  style="color: rgb(7,102,51)">&nbsp;&nbsp;<i class="fas fa-angle-double-right"></i> {{list.headline}}</nuxt-link></span>
          </marquee>
        </div>
        <div v-if="isMobile" class="title-mobile"><nuxt-link to="/page/news" class="see-more"><span >&nbsp;সর্বশেষ খবরঃ</span></nuxt-link></div>
        <div v-if="isMobile" class="news-mobile">
          <transition v-if="lists.data" name="home" mode="out-in">
            <span  v-if="news[0] && lists.data[0]" key="0"><nuxt-link :to="'/page/news/'+lists.data[0].slug"  style="color: rgb(7,102,51)">{{lists.data[0].headline}}</nuxt-link></span>
            <span  v-if="news[1] && lists.data[1]" key="1"><nuxt-link :to="'/page/news/'+lists.data[1].slug"  style="color: rgb(7,102,51)">{{lists.data[1].headline}}</nuxt-link></span>
            <span  v-if="news[2] && lists.data[2]" key="2"><nuxt-link :to="'/page/news/'+lists.data[2].slug"  style="color: rgb(7,102,51)">{{lists.data[2].headline}}</nuxt-link></span>
            <span  v-if="news[3] && lists.data[3]" key="3"><nuxt-link :to="'/page/news/'+lists.data[3].slug"  style="color: rgb(7,102,51)">{{lists.data[3].headline}}</nuxt-link></span>
          </transition>
      </div>
    </div>
</template>

<script>
  import { mapMutations, mapGetters } from 'vuex';
  import { isMobile } from 'mobile-device-detect';
  export default {
    transition: {
      name: 'home',
      mode: 'out-in'
    },
    data() {
      return {
        notices: '',
        news: [
          true,
          false,
          false,
          false,
        ],
        isMobile: isMobile,
      }
    },
    mounted(){
      this.get();
    },
    computed: mapGetters({
      lists: 'frontent/news'
    }),
    methods: {
      updateTicker: function() {
        var removed = this.news.pop();
        this.news.unshift(removed);
      },
      async get () {
        let search = {type:6,limit:4};
        let page = 1
        try {
          await this.$store.dispatch('frontent/get_news',{search,page}).then(response=>{
            setInterval(this.updateTicker, 4000);
          })
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
  padding-top: 8px;
  padding-bottom: 9px;
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
.title-mobile{
  margin-top: 20px;
  width: 100%;
  font-weight: bold;
  font-size: 20px;
}
.news-mobile{
  padding-left: 5px;;
}
</style>
<style>
.home-enter-active, .home-leave-active { transition: opacity .8s; }
.home-enter, .home-leave-active { opacity: 0; }
</style>
