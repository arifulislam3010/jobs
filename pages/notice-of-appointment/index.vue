<template>
    <div>
        <div v-if="lists.data" class="team-5">
          <div v-if="lists.data.length>0" class="container">
            <div class="col-md-12">
              <div class="row mb-2">
                  <div class="search_select">
                    <treeselect :default-expand-level="1"  name="country" v-validate="'required'" placeholder="জনবল পাঠানো দেশ"  v-model="country" :multiple="true" :options="countries" />
                    <!-- <multiselect
                      v-model="country"
                      placeholder="জনবল পাঠানো দেশ"
                      label="country_name"
                      track-by="id"
                      :options="countries"
                    ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect :default-expand-level="1" name="job" v-validate="'required'" placeholder="জনবল পাঠানো চাকুরী"  v-model="job" :multiple="true" :options="jobs" />
                      <!-- <multiselect
                          v-model="job"
                          placeholder="জনবল পাঠানো চাকুরী"
                          label="name"
                          track-by="id"
                          :options="jobs"
                      ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect :default-expand-level="1" name="agency" v-validate="'required'" placeholder="সরকার অনুমোদিত এজেন্সি"  v-model="agency" :multiple="true" :options="agencies" />
                      <!-- <multiselect
                          v-model="agency"
                          placeholder="সরকার অনুমোদিত এজেন্সি"
                          label="name"
                          track-by="id"
                          :options="agencies"
                      ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                    <button 
                      @click="get(1,1)"
                      class="btn btn-outline-secondary"
                    >খুঁজুন</button>
                  </div>
              </div>
            </div>
            <div  @click="go(list.slug)" v-for="(list,key) in lists.data" v-bind:key="key" class="card" style="width:100%;margin-bottom:10px;">
              <div style="min-height:220px;" class="card-body">
                <h5 class="card-title"><a href="#">{{list.headline}}</a></h5>
                <span style="font-size:18px;">{{list.author}}</span><br><br>
                <span v-if="list.job"><i class="fa fa-tasks" aria-hidden="true"></i> {{list.job.name}} <br></span>
                <span v-if="list.country"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;{{list.country.country_name}} <br></span>
                <span v-if="list.language"><i class="fa fa-language" aria-hidden="true"></i> {{list.language.name}} <br></span>
                <i class="fa fa-briefcase" aria-hidden="true"></i>  <span v-if="list.experience">কমপক্ষে {{list.experience}} বছর</span><span v-else>অভিজ্ঞতা প্রয়োজন নেই</span><span class="pull-right show-off"><i class="fas fa-calendar-alt"></i> আবেদনের শেষ সময় {{list.expired_at}}</span>
                <span class="show-on"><i class="fas fa-calendar-alt"></i> আবেদনের শেষ সময় {{list.expired_at}}</span>
              </div>
            </div>
            <div  style="width:100%;" class="mt-1">
                <pagination :data="this.lists" @pagination-change-page="get2" :limit="1"></pagination>
            </div>
            <div style="width:100%;height:100px;">

            </div>
          
         <!-- <table class="table-bordered" style="width:100%; margin-bottom:15px">
            <thead>
              <tr>
                <th style="font-size:14px !important;">শিরোনাম</th>
                <th style="font-size:14px !important;">আবেদন শুরুর সময়</th>
                <th style="font-size:14px !important;">আবেদনের শেষ সময়</th>
              </tr>
            </thead>
            <tbody v-if="lists">
              <tr style="cursor:pointer;hover:background-color:#888;" @click="go(list.slug)" v-for="(list,key) in this.lists.data" v-bind:key="key">
                <td>{{list.headline.substr(0,30)}}</td>
                <td>{{list.published_at}}</td>
                <td>{{list.expired_at}}</td>
              </tr>
            </tbody>
          </table> -->
        </div>
        <div v-if="lists.data.length == 0 && search_click" class="container">
          <div class="col-md-12">
              <div class="row mb-2">
                  <div class="search_select">
                    <treeselect  name="country" v-validate="'required'" placeholder="জনবল পাঠানো দেশ"  v-model="country" :multiple="true" :options="countries" />
                    <!-- <multiselect
                      v-model="country"
                      placeholder="জনবল পাঠানো দেশ"
                      label="country_name"
                      track-by="id"
                      :options="countries"
                    ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect  name="job" v-validate="'required'" placeholder="জনবল পাঠানো চাকুরী"  v-model="job" :multiple="true" :options="jobs" />
                      <!-- <multiselect
                          v-model="job"
                          placeholder="জনবল পাঠানো চাকুরী"
                          label="name"
                          track-by="id"
                          :options="jobs"
                      ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect  name="agency" v-validate="'required'" placeholder="সরকার অনুমোদিত এজেন্সি"  v-model="agency" :multiple="true" :options="agencies" />
                      <!-- <multiselect
                          v-model="agency"
                          placeholder="সরকার অনুমোদিত এজেন্সি"
                          label="name"
                          track-by="id"
                          :options="agencies"
                      ></multiselect> -->
                  </div>
                  &nbsp;
                  <div class="search_select">
                    <button 
                      @click="get(1,1)"
                      class="btn btn-outline-secondary"
                    >খুঁজুন</button>
                  </div>
              </div>
            </div>
            
        </div>
      </div>
      <div v-if="lists.data">
        <div class="mb-20" v-if="lists.data.length <= 0">
            <p v-if="search_click" style="margin:20px auto;font-size:30px;color:red;text-align:center">কোনো নিয়োগ বিজ্ঞপ্তি খুজে পাওয়া যায় নি</p>
            <p v-else style="margin:20px auto;font-size:30px;color:#888;text-align:center">কোন তথ্য পাওয়া যায় নি</p>
            <div style="height:210px;clear:both" class="col-md-12"></div>
        </div>
      </div>
      <!-- <postView v-show="modalOpen" ref="postView"></postView>
      <applyView v-show="applyModalOpen" ref="applyView"></applyView> -->
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import Multiselect from 'vue-multiselect'

// import users from "~/components/custom/user/list.vue";
// import postView from "~/components/custom/post/postView.vue";
// import applyView from "~/components/custom/post/applyView.vue";
  export default {
    components: {
      // users,postView,applyView
      pagination,
      Multiselect
    },
    data() {
      return {
        search_click:false,
        countries:[],
        agencies:[],
        jobs:[],
        job:[],
        country:[],
        agency:[],
        modalOpen:false,
        applyModalOpen: false,
        post: '',
        type: '',
        search:{},
        seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
      }
    },
    mounted(){
      this.type = 1;
      this.get();
      this.getJob();
      this.getCountry();
      this.getAgency();
    },
    computed: mapGetters({
      lists: 'frontent/appointments'
    }),
    methods: {
      get2(page=1){
        this.get(0,page)
      },
      async get (search_click=0,page=1) {
          if(search_click == 1){
            this.search_click = true
          }
          else{
            this.search_click = false
          }
          let search = {type:this.type,limit:10,page:1};
          this.search.type = this.type
          this.search.limit = 10
          this.search.page = page
          this.search.country = this.country
          this.search.agency = this.agency
          this.search.job = this.job

        try {
          await this.$store.dispatch('frontent/get_appointments',this.search)
        } catch (e) {
          
        }
      },
      go(slug){
        this.$router.push('/notice-of-appointment/'+slug);
      },
      async getJob() {
        await this.$axios
          .get('api/get-desired-job-tree')
          .then(response => {
            this.jobs = [{id: 99999,label: 'সকল চাকুরী',children:response.data}];
          })
          .catch(error => {})
      },
      async getCountry() {
        await this.$axios
          .get('api/get-country-tree')
          .then(response => {
            this.countries = [{id: 99999,label: 'সকল দেশ',children:response.data}];
          })
          .catch(error => {})
      },
      async getAgency() {
        await this.$axios
          .get('api/get-agency-tree')
          .then(response => {
            this.agencies = [{id: 99999,label: 'সকল এজেন্সি',children:response.data}];
          })
          .catch(error => {})
      },
    }
  }
</script>

<style scoped>
.card{
  cursor: pointer;
  box-shadow: 0 0px 0px rgba(50,50,93,.1), 0 0px 0px rgba(0,0,0,.07); border: 1px solid rgba(50,50,93,.1);
  transition: 0.4s;
}
.card:hover{
  /* box-shadow: 5px 10px #888888; */
  box-shadow: 0 10px 15px rgba(50,50,93,.1), 0 5px 10px rgba(0,0,0,.07);
  /* display: none; */
}
.search_select{
  width: 20%;
}
.show-on{
  display: none;
}
@media only screen and (max-width: 600px) {
  .search_select{
    width: 95%;
    margin-bottom: 5px;
    margin-top: 5px;
    float: right;
  }
  .search_select>>>button{
    float: right;
    margin-bottom: 10px;
  }
  .show-off{
    display: none;
  }
  .show-on{
    display: block;
  }
}
</style>
<style>
.page-item.active .page-link {
    background-color: #75ab28;
    border-color: #75ab28;
}
</style>