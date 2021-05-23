<template>
    <div>
        <div class="team-5">
            <div class="container">
                <div  class="row">
                    <table v-if="type == 2" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(notice,key) in notices.data" :key="key">
                                <td>{{key+1}}</td>
                                <td>{{notice.headline}}</td>
                                <td><nuxt-link :to="'/page/notice/'+notice.slug"  class="btn btn-sm btn-info mr-4 mt-3">Details</nuxt-link></td>
                            </tr>
                        </tbody>
                    </table>
                    <table v-if="type == 6" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data,key) in news.data" :key="key">
                                <td>{{key+1}}</td>
                                <td>{{data.headline}}</td>
                                <td><nuxt-link :to="'/page/news/'+data.slug"  class="btn btn-sm btn-info mr-4 mt-3">Details</nuxt-link></td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination v-if="type == 6" :data="this.news" @pagination-change-page="getNews"></pagination>
                    <div style="margin-top:50px" v-if="type == 3 || type == 5" v-for="(story,key) in stories.data" :key="key" class="col-md-3">
                        <div class="card card-profile" data-image="img-raised">
                            <div class="card-header-image">
                                <a href="javascript:;">
                                    <img style="height:120px;" v-if="story.image" class="img"   :src="story.image" >
                                    <img style="height:120px;" v-else class="img" src="../../assets/image/home_image_1.png" >
                                </a>
                                
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-info text-center">{{story.headline}}</h6>
                                <p v-html="story.content.substring(0, 200)" class="card-description">
                                
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <nuxt-link v-if="type == 3" :to="'/page/story/'+story.slug"  class="btn btn-sm btn-info mr-4 mt-3">Details</nuxt-link>
                                <nuxt-link v-if="type == 5" :to="'/page/question/'+story.slug"  class="btn btn-sm btn-info mr-4 mt-3">Details</nuxt-link>
                            </div>
                        </div>
                    </div>
                    <pagination v-if="type == 3" :data="this.stories" @pagination-change-page="getStories"></pagination>
                    <pagination v-if="type == 5" :data="this.stories" @pagination-change-page="getBlogs"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
  import { mapMutations, mapGetters } from 'vuex';
  import pagination from 'laravel-vue-pagination';
  export default {
   // props:['users'],
    components: {
        pagination
    },
    data() {
      return {
          type:0
      }
    },
    mounted(){
      if(this.$route.params.title == 'notices'){
          this.type = 2;
          this.getNotices();
      }
      else if(this.$route.params.title == 'stories'){
          this.type = 3;
          this.getStories();
      }
      else if(this.$route.params.title == 'questions'){
          this.type = 5;
          this.getBlogs();
      }
      else if(this.$route.params.title == 'news'){
          this.type = 6;
          this.getNews();
      }
    },
    computed: mapGetters({
      notices: 'frontent/notices',
      news: 'frontent/news',
      stories: 'frontent/stories'
    }),
    methods: {
      async getNotices (page = 1) {
        let search = {type:2,limit:4};
        try {
          await this.$store.dispatch('frontent/get_notices',{search,page})
        } catch (e) {
          
        }
      },
      async getStories (page = 1) {
        let search = {type:3,limit:4};
        try {
          await this.$store.dispatch('frontent/get_stories',{search,page})
        } catch (e) {
          
        }
      },
      async getBlogs (page = 1) {
        let search = {type:5,limit:4};
        try {
          await this.$store.dispatch('frontent/get_stories',{search,page})
        } catch (e) {
          
        }
      },
      async getNews (page = 1) {
        let search = {type:6,limit:4};
        try {
          await this.$store.dispatch('frontent/get_news',{search,page})
        } catch (e) {
          
        }
      }
    }
  }
</script>