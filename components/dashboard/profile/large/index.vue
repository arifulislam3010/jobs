<template>
    <div id="myDIV">
        <!-- <b-progress height=".75rem">
          <b-progress-bar  variant="success" :value="value2" :label="`${value2}%`"></b-progress-bar>
        </b-progress> -->
        <b-tabs content-class="mt-3">
            <b-tab title="ব্যক্তিগত তথ্য" ><personal @clicked="onClickChild" :treeData="treeData" :districts="districts" :desired_jobs="desired_jobs"  :countries="countries"></personal></b-tab>
            <b-tab title="ঠিকানা"><address2 @clicked="onClickChild" :divisions="divisions"></address2></b-tab>
            <b-tab title="নমিনী"><nominee @clicked="onClickChild"></nominee></b-tab>
            <b-tab title="শিক্ষাগত যোগ্যতা" ><education @clicked="onClickChild"></education></b-tab>
            <b-tab title="ভাষা"><language @clicked="onClickChild"></language></b-tab>
            <b-tab title="অভিজ্ঞতা"><experience @clicked="onClickChild" ></experience></b-tab>
            <b-tab title="প্রশিক্ষণ" ><training @clicked="onClickChild" :training_centers="training_centers"></training></b-tab>
        </b-tabs>
    </div>
</template>
<script>

import address2 from "~/components/dashboard/profile/large/address"
import education from "~/components/dashboard/profile/large/education"
import experience from "~/components/dashboard/profile/large/experience"
import language from "~/components/dashboard/profile/large/language"
import nominee from "~/components/dashboard/profile/large/nominee"
import personal from "~/components/dashboard/profile/large/personal"
import training from "~/components/dashboard/profile/large/training"
// import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
export default {
  layout:'dashboard',
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
      value2:0,
      max:100,
      countries:[],
      districts:[],
      districts2:[],
      divisions:[],
      subdistricts:[],
      unions:[],
      training_centers:[],
      desired_jobs:[],
      treeData:[]
    }
  },
  mounted(){
    window.scrollTo({
      top: 130,
      left: 0,
      behavior: 'smooth'
    });

    this.getCountry();
    this.getCountry2();
    this.getDistrict();
    // this.getDistrictByID(1);
    this.getDivision();
    // this.getSubdistrict(1);
    // this.getUnion(1);
    this.getTraningCenter();
    this.getDesiredJob();
  },
  methods:{
    onClickChild (value) {
      this.value2 = value
      this.$store.commit('admin/progress/addProgress',value);
    },
    async getCountry(){
        this.$axios.get('api/get-country').then(response => {
              this.countries = response.data;
    })
    .catch(error => {

      });
    },
    async getCountry2(){
        this.$axios.get('api/get-country-tree').then(response => {
              this.treeData = response.data;
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
    async getDistrictByID(div_id){
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
    async getSubdistrict(dis_id){
        this.$axios.get('api/get-subdistrict/'+dis_id).then(response => {
              this.subdistricts = response.data;
    })
    .catch(error => {

      });
    },
    async getUnion(subdis_id){
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
        this.$axios.get('api/get-desired-job-tree').then(response => {
              this.desired_jobs = response.data;
    })
    .catch(error => {

      });
    }
  }
};
</script>