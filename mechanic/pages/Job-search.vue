<template>
  <div class="main-body ">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <JobFilter
            :jobType="this.$store.state.jobs.all_job_type"
            :senior="this.$store.state.jobs.senarity_level_data"
            @jobTitle="JobTitle"
            @jobTypeActionEmit="jobTypeEmitAction"
            @seniorLevelEmit="seniorLevelEmitAction"
            @genderEmit="genderEmitAction"
          />
          <div class="row mb-2">
            <!-- <job-filter /> -->
            <!-- <div class="search_select">
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
                  </div> -->
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
            <div v-for="(list, key) in jobList" v-bind:key="key">
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
      search_click: false,
      countries: [],
      agencies: [],
      jobs: [],
      job: [],
      jobTypeSearch: [],
      country: [],
      agency: [],
      seniorLevelSearch: [],
      genderSearch: [],
      modalOpen: false,
      applyModalOpen: false,
      post: '',
      type: '',
      jobList: [],
      search: {},
      titleSearch: '',
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
      ]
    }
  },
  mounted() {
    this.type = 1
    this.get()
    this.getJob()
    this.getCountry()
    this.getAgency()
    this.getJobList()
    // this.searchCustom(\/)
  },
  computed: mapGetters({
    lists: 'frontent/appointments'
  }),
  methods: {
    JobTitle(e) {
      // console.log(e)
      this.titleSearch = e
      this.get()
    },
    jobTypeEmitAction(e) {
      // console.log(e)
      // console.log('hi')
      let value = this.jobTypeSearch.indexOf(e)
      if (value > -1) {
        this.jobTypeSearch.slice(value, 1)
      } else {
        this.jobTypeSearch.push(e)
      }
      this.get()
      // console.log(this.jobTypeSearch)
    },
    seniorLevelEmitAction(e) {
      let value = this.seniorLevelSearch.indexOf(e)
      if (value > -1) {
        this.seniorLevelSearch.slice(value, 1)
      }else{
        this.seniorLevelSearch.push(e)
      }
      this.get()
    },
    genderEmitAction(e) {
      let value = this.genderSearch.indexOf(e)
      if (value > -1) {
        this.genderSearch.slice(value, 1)
      }else{
        this.genderSearch.push(e)
      }
      this.get()
    },
    get2(page = 1) {
      this.get(0, page)
    },
    async get(search_click = 0, page = 1) {
      if (search_click == 1) {
        this.search_click = true
      } else {
        this.search_click = false
      }
      let search = { type: this.type, limit: 10, page: 1 }
      this.search.type = this.type
      this.search.limit = 10
      this.search.page = page
      this.search.country = this.country
      this.search.agency = this.agency
      this.search.job = this.job
      this.search.title = this.titleSearch
      this.search.jobType = this.jobTypeSearch
      this.search.senior = this.seniorLevelSearch
      this.search.gender = this.genderSearch

      // try {
      //   console.log('search')
      // await this.$store.dispatch('frontent/get_appointments', this.search)
      // // .then(response => {
      // this.jobList = this.$store.state.appointments
      //   this.jobList = response.data
      // })
      // .catch(error => {})
      await this.$axios
        .post('api/custom/search', this.search)
        .then(response => {
          this.jobList = response.data
        })
        .catch(error => {})
      // } catch (e) {}
    },
    go(slug) {
      this.$router.push('/notice-of-appointment/' + slug)
    },
    async getJob() {
      await this.$axios
        .get('api/get-desired-job-tree')
        .then(response => {
          console.log(response.data)
          this.jobs = [
            { id: 99999, label: 'সকল চাকুরী', children: response.data }
          ]
        })
        .catch(error => {})
    },
    async getCountry() {
      await this.$axios
        .get('api/get-country-tree')
        .then(response => {
          this.countries = [
            { id: 99999, label: 'সকল দেশ', children: response.data }
          ]
        })
        .catch(error => {})
    },
    async getAgency() {
      await this.$axios
        .get('api/get-agency-tree')
        .then(response => {
          this.agencies = [
            { id: 99999, label: 'সকল এজেন্সি', children: response.data }
          ]
        })
        .catch(error => {})
    },
    async getJobList() {
      await this.$axios
        .get('api/post/list/1')
        .then(response => {
          this.jobList = response.data
          // this.agencies = [
          //   { id: 99999, label: 'সকল এজেন্সি', children: response.data }
          // ]
        })
        .catch(error => {})
    }
    // async searchCustom() {
    //   await this.$axios
    //     .get('api/post/search?title=d')
    //     .then(response => {
    //       console.log(response.data)
    //       // this.jobList = response.data
    //       // this.agencies = [
    //       //   { id: 99999, label: 'সকল এজেন্সি', children: response.data }
    //       // ]
    //     })
    //     .catch(error => {})
    // }
  },
  created() {
    this.$store.dispatch('jobs/all_job_type')
    this.$store.dispatch('jobs/senarity_level')
  }
}
</script>

<style lang="scss" scoped>
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
