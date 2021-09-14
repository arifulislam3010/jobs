<template>
  <div>
      <div class="container">
        <div class="row">
          <div class="row mt-4" v-if="type == 2">
            <div v-for="(story,key) in notices.data" :key="key" class="col-md-12 card mb-2">
              <nuxt-link :to="'/page/notice/'+story.slug">
              <div class="row">
                <div class="col-md-2">
                  <div style="padding:10px">
                    <img style="height:120px;width:120px" v-if="story.image" class="img" :src="story.image" />
                    <img style="height:120px;width:120px" v-else class="img" src="../../assets/image/notice.png" />
                  </div>
                </div>
                <div class="col-md-10">
                  <div style="padding:10px">
                    <span style="font-size:18px;font-weight:bold;color:#000;">{{story.headline}}</span><br>
                    <span  v-if="story.content" v-html="story.content.substring(0, 200)+'_ _ _ _'"></span>
                    <span><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;{{story.created_at}}</span>
                  </div>
                </div>
              </div>
              </nuxt-link>
            </div>
            <div class="col-md-12 ">
              <pagination v-if="type == 2" :data="this.notices" @pagination-change-page="getNotices"></pagination>
            </div>
            <div class="col-md-12 card mt-2"></div>

          </div>
          <div class="row mt-4" v-if="type == 6">
            <div v-for="(story,key) in news.data" :key="key" class="col-md-12 card mb-2">
              <nuxt-link :to="'/page/news/'+story.slug">
              <div class="row">
                <div class="col-md-2">
                  <div style="padding:10px">
                    <img style="height:120px;width:120px" v-if="story.image" class="img" :src="story.image" />
                    <img style="height:120px;width:120px" v-else class="img" src="../../assets/image/khabor.png" />
                  </div>
                </div>
                <div class="col-md-10">
                  <div style="padding:10px">
                    <span style="font-size:18px;font-weight:bold;color:#000;">{{story.headline}}</span><br>
                    <span  v-if="story.content" v-html="story.content.substring(0, 200)+'_ _ _ _'"></span>
                    <span><i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;{{story.created_at}}</span>
                  </div>
                </div>
              </div>
              </nuxt-link>
            </div>
            <div class="col-md-12 ">
              <pagination v-if="type == 6" :data="this.notices" @pagination-change-page="getNotices"></pagination>
            </div>
            <div class="col-md-12 card mt-2"></div>

          </div>
          <!-- <table v-if="type == 2" class="table-bordered" style="width:100%; margin-bottom:15px">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">শিরোনাম</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(notice,key) in notices.data" :key="key">
                <td>{{seria[key]}}</td>
                <td>{{notice.headline}}</td>
                <td>
                  <nuxt-link
                    :to="'/page/notice/'+notice.slug"
                    style="color:#fff;background-color:#95b320"
                    class="btn btn-sm btn-info mr-4 mt-3"
                  >বিস্তারিত</nuxt-link>
                </td>
              </tr>
            </tbody>
          </table> -->
          <!-- <table v-if="type == 6" class="table-bordered" style="width:100%; margin-bottom:15px">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">শিরোনাম</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data,key) in news.data" :key="key">
                <td>{{seria[key]}}</td>
                <td>{{data.headline}}</td>
                <td>
                  <nuxt-link
                    :to="'/page/news/'+data.slug"
                    style="color:#fff;background-color:#95b320"
                    class="btn btn-sm btn-info mr-4 mt-3"
                  >বিস্তারিত</nuxt-link>
                </td>
              </tr>
            </tbody>
          </table>
          <pagination v-if="type == 6" :data="this.news" @pagination-change-page="getNews"></pagination> -->
          <div class="row mt-4" v-if="type == 3">
          <div v-for="(story,key) in stories.data" :key="key" class="col-md-12 card mb-2">
            <nuxt-link :to="'/page/story/'+story.slug">
            <div class="row">
              <div class="col-md-2">
                <div style="padding:10px">
                   <img style="height:100px;width:100px" v-if="story.image" class="img" :src="story.image" />
                    <img style="height:100px;width:100px" v-else class="img" src="../../assets/image/home_image_1.png" />
                </div>
              </div>
              <div class="col-md-10">
                <div style="padding:10px">
                  <span style="font-size:18px;font-weight:bold;color:#000;">{{story.headline}}</span><br>
                  <span  v-if="story.content" v-html="story.content.substring(0, 200)+'_ _ _ _'"></span>
                </div>
              </div>
            </div>
            </nuxt-link>
          </div>
          <div class="col-md-12 ">
            <pagination v-if="type == 3" :data="this.stories" @pagination-change-page="getStories"></pagination>
          </div>
          <div class="col-md-12 card mt-2">

          </div>
          <!-- <div 
            v-for="(story,key) in stories.data" :key="key"
            class="col-md-3"
          >
            <div  class="card card-profile" data-image="img-raised">
              <div class="card-header-image">
                <a href="javascript:;">
                  <img style="height:120px;" v-if="story.image" class="img" :src="story.image" />
                  <img
                    style="height:120px;"
                    v-else
                    class="img"
                    src="../../assets/image/home_image_1.png"
                  />
                </a>
              </div>
              <div class="card-body">
                <p style="font-size:18px;font-weight:bold;color:#000">{{story.headline}}</p>
                <p
                  v-if="story.content"
                  v-html="story.content.substring(0, 200)"
                  class="card-description"
                ></p>
              </div>
              <div class="card-footer text-center">
                <nuxt-link
                  v-if="type == 3"
                  :to="'/page/story/'+story.slug"
                  style="color:#fff;background-color:#95b320"
                  class="btn btn-sm btn-info mr-4 mt-3"
                >বিস্তারিত</nuxt-link>
                <nuxt-link
                  v-if="type == 5"
                  :to="'/page/question/'+story.slug"
                  style="color:#fff;background-color:#95b320"
                  class="btn btn-sm btn-info mr-4 mt-3"
                >বিস্তারিত</nuxt-link>
              </div>
            </div>
          </div> -->
          </div>
          <div v-if="type == 5 && stories.data" class="col-md-12">
            <b-card v-if="stories.data.length>key" v-for="(collapse,key) in collapses"
            :key="key" no-body class="mb-1">
              <button style="background-color:#75ab28;color:#fff;font-size:18px;"  @click="collapse.show = !collapse.show" class="btn btn-md btn-outline btn-block ">{{ stories.data[key].headline}}</button>
              <b-collapse v-model="collapse.show" id="collapse-1" class="mt-2">
                  
                     <p style="padding:10px;" class="card-text"  v-html="stories.data[key].content"></p>
                  
               </b-collapse>
            </b-card>
          </div>
          <div class="col-md-12">
            <pagination v-if="type == 5" :data="this.stories" @pagination-change-page="getBlogs"></pagination>
          </div>
        </div>
      </div>
  </div>
</template>
<script >
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
export default {
  // props:['users'],
  components: {
    pagination
  },
  data() {
    return {
      type: 0,
      seria: [
        '১',
        '২',
        '৩',
        '৪',
        '৫',
        '৬',
        '৭',
        '৮',
        '৯',
        '১০',
        '১১',
        '১২',
        '১৩',
        '১৪',
        ' ১৫'
      ],
      collapses: [ 
        { show: true },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
        { show: false },
      ]
    }
  },
  mounted() {
    if (this.$route.params.title == 'notices') {
      this.type = 2
      this.getNotices()
    } else if (this.$route.params.title == 'stories') {
      this.type = 3
      this.getStories()
    } else if (this.$route.params.title == 'questions') {
      this.type = 5
      this.getBlogs()
    } else if (this.$route.params.title == 'news') {
      this.type = 6
      this.getNews()
    }
  },
  computed: mapGetters({
    notices: 'frontent/notices',
    news: 'frontent/news',
    stories: 'frontent/stories'
  }),
  methods: {
    async getNotices(page = 1) {
      let search = { type: 2, limit: 4 }
      try {
        await this.$store.dispatch('frontent/get_notices', { search, page })
      } catch (e) {}
    },
    async getStories(page = 1) {
      let search = { type: 3, limit: 4 }
      try {
        await this.$store.dispatch('frontent/get_stories', { search, page })
      } catch (e) {}
    },
    async getBlogs(page = 1) {
      let search = { type: 5, limit: 4 }
      try {
        await this.$store.dispatch('frontent/get_stories', { search, page })
      } catch (e) {}
    },
    async getNews(page = 1) {
      let search = { type: 6, limit: 4 }
      try {
        await this.$store.dispatch('frontent/get_news', { search, page })
      } catch (e) {}
    }
  }
}
</script>
<style>
.page-item.active .page-link {
    background-color: #75ab28;
    border-color: #75ab28;
}
</style>