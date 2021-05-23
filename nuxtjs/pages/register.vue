<template>
  <div class="container card">
    <div class="row">
      <div class="col-sm-6">
        <button
          type="button"
          @click="applicant"
          :class="{ active: isApplicant }"
          class="btn btn-outline-success btn-lg btn-block"
        >প্রার্থী</button>
      </div>
      <div class="col-sm-6">
        <button
          type="button"
          @click="agency"
          :class="{ active: isAgency }"
          class="btn btn-outline-success btn-lg btn-block"
        >এজেন্সী</button>
      </div>
    </div>
    <applicant v-if="isApplicant" :training_centers="training_centers" :divisions="divisions" :countries="countries" :desired_jobs="desired_jobs" :districts="districts"></applicant>
    <agency  v-if="isAgency" :training_centers="training_centers" :divisions="divisions" :countries="countries" :desired_jobs="desired_jobs" :districts="districts"></agency>
  </div>
</template>

<script>
import applicant from '~/components/custom/registration/applicant.vue'
import agency from '~/components/custom/registration/agency.vue'
export default {
  layout: 'default',
  components: {
    applicant,
    agency
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
    this.getDistrict()
    this.getDistrictByID(1)
    this.getDivision()
    this.getSubdistrict(1)
    this.getUnion(1)
    this.getTraningCenter(1)
    this.getDesiredJob(1)
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
        .get('api/get-country')
        .then(response => {
          this.countries = response.data
        })
        .catch(error => {})
    },
    async getDistrict() {
      this.$axios
        .get('api/get-district')
        .then(response => {
          this.districts = response.data
        })
        .catch(error => {})
    },
    async getDistrictByID(div_id = 1) {
      this.$axios
        .get('api/get-district/' + div_id)
        .then(response => {
          this.districts2 = response.data
        })
        .catch(error => {})
    },
    async getDivision() {
      this.$axios
        .get('api/get-division')
        .then(response => {
          this.divisions = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict(dis_id = 1) {
      this.$axios
        .get('api/get-subdistrict/' + dis_id)
        .then(response => {
          this.subdistricts = response.data
        })
        .catch(error => {})
    },
    async getUnion(subdis_id = 1) {
      this.$axios
        .get('api/get-union/' + subdis_id)
        .then(response => {
          this.unions = response.data
        })
        .catch(error => {})
    },
    async getTraningCenter() {
      this.$axios
        .get('api/get-training-center')
        .then(response => {
          this.training_centers = response.data
        })
        .catch(error => {})
    },
    async getDesiredJob() {
      this.$axios
        .get('api/get-desired-job')
        .then(response => {
          this.desired_jobs = response.data
        })
        .catch(error => {})
    }
  }
}
</script>