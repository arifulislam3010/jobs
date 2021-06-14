<template>
    <div>
        <div class="col-md-12">
          <div class="row mb-4">
              <div style="width:20%;">
                  <multiselect
                    selectLabel=''
                    deselectLabel=''
                    v-model="job"
                    placeholder="জনবল পাঠানো চাকুরী"
                    label="name"
                    track-by="id"
                    :options="jobs"
                  ></multiselect>
              </div>
              &nbsp;
              <div style="width:20%;">
                  <multiselect
                    selectLabel=''
                    deselectLabel=''
                    v-model="country"
                    placeholder="জনবল পাঠানো দেশ"
                    label="country_name"
                    track-by="id"
                    :options="countries"
                  ></multiselect>
              </div>
              &nbsp;
              <div style="width:10%">
                <button
                  @click="jobPost()"
                  class="btn btn-info"
                >সার্চ</button>
              </div>
          </div>
      </div>
        <div class="row">
            <div v-for="(list,key) in lists.data" :key="key" class="col-md-3" >
                <div @click="go(list.id)" class="card list" style="width: 100%;">
                    <img v-if="list.image" class="card-img-top" :src="list.image" height="100px" alt="Card image cap">
                    <img v-else class="card-img-top" src="~/assets/image/hire.jpg" height="100px" alt="Card image cap">
                    <div class="card-body">
                        <span class="card-text"><b>{{list.headline}}</b></span><br>
                        <span class="card-text"><b>মোট আবেদনকারী: </b>{{list.total}}</span><br>
                        <span class="card-text"><b>মোট সেবা নিয়েছে: </b>{{list.total_serve}}</span><br>
                        <span class="card-text"><b>দেশ: </b>{{list.country.country_name}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <pagination :data="lists" @pagination-change-page="jobPost"></pagination>
            </div>
        </div>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import Multiselect from 'vue-multiselect'
export default {
  name: "job_id",
  middleware: 'sup-agency-admin',
  layout: 'dashboard',
  components:{
    Multiselect,
    pagination
  },
  data() {
    return {
      lists:{},
      jobs:[],
      job:'',
      countries:[],
      country:''
    }
  },
  mounted(){
    this.jobPost();
    this.getJob();
    this.getCountry();
  },
  methods: {
    async getCountry() {
      await this.$axios
        .get('api/get-country')
        .then(response => {
          this.countries = response.data
        })
        .catch(error => {})
    },
    async getJob() {
      await this.$axios
        .get('api/get-desired-job')
        .then(response => {
          this.jobs = response.data
        })
        .catch(error => {})
    },
    go(id){
        this.$router.push('/dashboard/job-applicant/'+id);
    },
    async jobPost(page=1){
      let job_id = '';
      let country_id = '';

      if(this.job){
        job_id = this.job.id;
      }
      else{
        job_id = '';
      }

      if(this.country){
        country_id = this.country.id;
      }
      else{
        country_id = '';
      }
      await this.$axios.get('api/get-job-post?job_id='+job_id+'&country_id='+country_id+'&page='+page).then(response=>{
          this.lists = response.data
      });
    }
  }
};
</script>
<style  scoped>
.card{
    cursor:pointer;
    transition: 1s;
}
.list:hover{
  transform: scale(1.1);
}
</style>
