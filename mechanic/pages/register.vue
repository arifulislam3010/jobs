<template>
  <div class="container">
    <br>
    <br>
    <!-- 
    <div class="row">
      <div class="col-sm-6">
        <button
          style="font-size:18px;"
          type="button"
          @click="applicant"
          :class="{ active: isApplicant }"
          class="btn btn-outline-success btn-md btn-block"
        >আগ্রহী প্রার্থী</button>
      </div>
      <div class="col-sm-6">
        <button
          style="font-size:18px;"
          type="button"
          @click="agency"
          :class="{ active: isAgency }"
          class="btn btn-outline-success btn-md btn-block"
        >এজেন্সী</button>
      </div>
    </div> -->
    <!-- <applicant v-if="isApplicant" :countries="countries" :desired_jobs="desired_jobs" ></applicant> -->
    <!-- <agency  v-if="isAgency" :countries="countries" :desired_jobs="desired_jobs" ></agency> -->
    <!-- <Test :countries="countries" :desired_jobs="desired_jobs" /> -->
    <ApplicantNew  v-if="isApplicant" @switchReg="agency" :countries="countries" :desired_jobs="desired_jobs" />
    <AgencyNew  v-if="isAgency" @switchReg="applicant" :countries="countries" :desired_jobs="desired_jobs" />
    <!-- <div style="width:100%;text-align:center;">
      <p><nuxt-link to="/admin/registration"> এডমিন রেজিস্ট্রেশন</nuxt-link></p>
    </div> -->
    <br>
    <br>
    <br>
  </div>
</template>

<script>
import applicant from '~/components/custom/registration/applicant.vue'
import agency from '~/components/custom/registration/agency.vue'
import AgencyNew from '~/components/custom/registration/agencyNew.vue'
import ApplicantNew from '~/components/custom/registration/applicantNew.vue'
export default {
  layout: 'default',
  components: {
    applicant,
    agency,
    AgencyNew,
    ApplicantNew
  },
  data() {
    return {
      isApplicant: true,
      isAgency: false,
      countries: [],
      districts: [],
      districts2: [],
      divisions: [],
      subdistricts: [],
      unions: [],
      training_centers: [],
      desired_jobs: []
    }
  },
  mounted() {
    this.getCountry()
    this.getDesiredJob()
  },
  methods: {
    applicant() {
      this.isApplicant = true
      this.isAgency = false
    },
    agency() {
      this.isApplicant = false
      this.isAgency = true
    },
    async getCountry() {
      this.$axios
        .get('api/get-country-tree')
        .then(response => {
          this.countries = response.data
        })
        .catch(error => {})
    },
    async getDesiredJob() {
      this.$axios
        .get('api/get-desired-job-tree')
        .then(response => {
          this.desired_jobs = response.data
        })
        .catch(error => {})
    }
  }
}
</script>