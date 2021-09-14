<template>
  <div class="main-body ">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <!-- <JobFilter /> -->
           <div class="row mb-2">
                  <div class="search_select">
                    <treeselect :default-expand-level="1"  name="country" v-validate="'required'" placeholder="দেশ"  v-model="country" :multiple="true" :options="countries" />
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect :default-expand-level="1" name="job" v-validate="'required'" placeholder="চাকুরী"  v-model="job" :multiple="true" :options="jobs" />
                  </div>
                  &nbsp;
                  <div class="search_select">
                      <treeselect :default-expand-level="1" name="agency" v-validate="'required'" placeholder="এজেন্সি"  v-model="agency" :multiple="true" :options="agencies" />
                  </div>
                  &nbsp;
                   &nbsp;
                  <div class="search_select">
                    <button 
                      @click="get(1,1)"
                      class="btn btn-outline-secondary"
                    >খুঁজুন</button>
                  </div>
              </div>
        </div>
        <div class="col-md-8 col-lg-8">
          <div
            class="job-card-component-heading d-flex justify-content-between mb-3"
          >
            <div class="job-card-component-heading-content">
              <!-- <h6><span>Job for : </span> Product Designer</h6> -->
            </div>
            <div class="job-card-component-heading-content">
              <h6>48 jobs <span>are available</span></h6>
            </div>
          </div>
          <div class="job-card-wrapper mb-5">
            <div v-for="(list,key) in lists.data" v-bind:key="key">
              <JobCard :post="list" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import JobCard from '~/components/customDesign/JobDetails/JobCard.vue'
import JobFilter from '~/components/customDesign/JobFilter/JobFilter.vue'
export default {
  components: {
    JobCard,
    JobFilter
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

<style lang="scss">
.job-card-wrapper {
  background: #fdfdfd;
  border: 1px solid #bdbdbd;
  box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
}
.main-body {
  margin-top: 100px;
}
.job-card-component-heading-content {
  h6 {
    font-weight: 500;
    font-size: 14px;
    color: #1d3146;
    span {
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      color: rgba(29, 49, 70, 0.6);
    }
  }
}
.job-filter-form {
  select {
    color: #1d3146;
    margin-bottom: 1rem;
  }
}
</style>
