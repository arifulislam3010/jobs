<template>
    <div>
        <b-tabs content-class="mt-3">
            <b-tab title="Personal" ><personal :districts="districts" :desired_jobs="desired_jobs"  :countries="countries"></personal></b-tab>
            <b-tab title="Address"><address2 :divisions="divisions"></address2></b-tab>
            <b-tab title="Nominee"><nominee></nominee></b-tab>
            <b-tab title="Education"><education></education></b-tab>
            <b-tab title="Language"><language></language></b-tab>
            <b-tab title="Experience"><experience></experience></b-tab>
            <b-tab title="Training" ><training :training_centers="training_centers"></training></b-tab>
        </b-tabs>
    </div>
</template>
<script>
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
import address2 from "~/components/dashboard/profile/large/address"
import education from "~/components/dashboard/profile/large/education"
import experience from "~/components/dashboard/profile/large/experience"
import language from "~/components/dashboard/profile/large/language"
import nominee from "~/components/dashboard/profile/large/nominee"
import personal from "~/components/dashboard/profile/large/personal"
import training from "~/components/dashboard/profile/large/training"

export default {
  components: {
    address2,
    education,
    experience,
    language,
    nominee,
    personal,
    training
  },
  data(){
    return{
      countries:[],
      districts:[],
      districts2:[],
      divisions:[],
      subdistricts:[],
      unions:[],
      training_centers:[],
      desired_jobs:[],
    }
  },
  mounted(){
    this.getCountry();
    this.getDistrict();
    this.getDistrictByID(1);
    this.getDivision();
    this.getSubdistrict(1);
    this.getUnion(1);
    this.getTraningCenter(1);
    this.getDesiredJob(1);
  },
  methods:{
    async getCountry(){
        this.$axios.get('api/get-country').then(response => {
              this.countries = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrict(){
        this.$axios.get('api/get-district').then(response => {
              this.districts = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrictByID(div_id=1){
        this.$axios.get('api/get-district/'+div_id).then(response => {
              this.districts2 = response.data;
    })
    .catch(error => {

      });
    },
    async getDivision(){
        this.$axios.get('api/get-division').then(response => {
              this.divisions = response.data;
    })
    .catch(error => {

      });
    },
    async getSubdistrict(dis_id=1){
        this.$axios.get('api/get-subdistrict/'+dis_id).then(response => {
              this.subdistricts = response.data;
    })
    .catch(error => {

      });
    },
    async getUnion(subdis_id=1){
        this.$axios.get('api/get-union/'+subdis_id).then(response => {
              this.unions = response.data;
    })
    .catch(error => {

      });
    },
    async getTraningCenter(){
        this.$axios.get('api/get-training-center').then(response => {
              this.training_centers = response.data;
    })
    .catch(error => {

      });
    },
    async getDesiredJob(){
        this.$axios.get('api/get-desired-job').then(response => {
              this.desired_jobs = response.data;
    })
    .catch(error => {

      });
    }
  }
};
</script>