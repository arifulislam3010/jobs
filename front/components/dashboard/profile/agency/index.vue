<template>
    <div>
        <b-tabs content-class="mt-3">
            <b-tab title="মৌলিক তথ্য" ><personal :treeData="treeData" :desired_jobs="desired_jobs"></personal></b-tab>
            <b-tab title="গ্যালারি"><gallery></gallery></b-tab>
            <b-tab title="স্লাইডার"><slider></slider></b-tab>
            <!-- <b-tab title="শিক্ষাগত যোগ্যতা" ><education @clicked="onClickChild"></education></b-tab>
            <b-tab title="ভাষা"><language @clicked="onClickChild"></language></b-tab>
            <b-tab title="অভিজ্ঞতা"><experience @clicked="onClickChild" ></experience></b-tab>
            <b-tab title="প্রশিক্ষণ" ><training @clicked="onClickChild" :training_centers="training_centers"></training></b-tab> -->
        </b-tabs>
    </div>
</template>
<script>
import personal from "~/components/dashboard/profile/agency/personal"
import gallery from "~/components/dashboard/profile/agency/gallery"
import slider from "~/components/dashboard/profile/agency/slider"
export default {
  layout:'dashboard',
  components: {
    personal,
    gallery,
    slider
  },
  data(){
    return{
      desired_jobs:[],
      treeData:[]
    }
  },
  mounted(){
    this.getCountry();
    this.getDesiredJob();
  },
  methods:{
    onClickChild (value) {
      this.value2 = value
    },
    
    async getCountry(){
        this.$axios.get('api/get-country-tree').then(response => {
              this.treeData = response.data;
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