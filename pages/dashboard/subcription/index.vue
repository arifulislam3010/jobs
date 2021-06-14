<template>
  <div class="row">
    <div class="col-md-3">
        <div class="card col-md-12">
            <div style="width:100%;margin-top:10px;">
                <div class="pull-left">
                    <p>এজেন্সি</p>
                </div>
                <div class="pull-right">
                    <button v-if="agency_open" @click="openCloseAgency" class="btn btn-sm btn-info"><i class="fa fa-minus"></i></button>
                    <button v-else @click="openCloseAgency" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div v-if="agency_open" style="width:100%">
              <treeselect  name="agency" v-validate="'required'" placeholder="এজেন্সি"  v-model="agency" :multiple="true" :options="agencies" />
              <div class="mt-2" style="width:100%;">
                <button class="btn btn-info btn-sm pull-right" @click="subscribe('agency')">সাবস্ক্রাইব</button>
              </div>
            </div>
            <div style="width:100%">
                <table class="table mt-2">
                    <tr v-for="(list,key) in sub_agencies.data" :key="key">
                      <td>{{list.agency_name}}</td>
                      <td>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteSub(key,list.id,'agency')" type="button" class="btn btn-warning">
                              <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card col-md-12">
            <div style="width:100%;margin-top:10px;">
                <div class="pull-left">
                    <p>দেশ </p>
                </div>
                <div class="pull-right">
                    <button v-if="country_open" @click="openCloseCountry" class="btn btn-sm btn-info"><i class="fa fa-minus"></i></button>
                    <button v-else @click="openCloseCountry" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div v-if="country_open" style="width:100%">
              <treeselect  name="country"  placeholder="দেশ"  v-model="country" :multiple="true" :options="countries" />
              <div class="mt-2" style="width:100%;">
                <button class="btn btn-info btn-sm pull-right" @click="subscribe('country')">সাবস্ক্রাইব</button>
              </div>
            </div>
            <div style="width:100%">
                <table class="table mt-2">
                    <tr v-for="(list,key) in sub_countries.data" :key="key">
                      <td>{{list.country_name}}</td>
                      <td>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteSub(key,list.id,'country')" type="button" class="btn btn-warning">
                              <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card col-md-12">
            <div style="width:100%;margin-top:10px;">
                <div class="pull-left">
                    <p>চাকরি</p>
                </div>
                <div class="pull-right">
                    <button v-if="job_open" @click="openCloseJob" class="btn btn-sm btn-info"><i class="fa fa-minus"></i></button>
                    <button v-else @click="openCloseJob" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div v-if="job_open" style="width:100%">
              <treeselect  name="job"  placeholder="চাকরি"  v-model="job" :multiple="true" :options="jobs" />
              <div class="mt-2" style="width:100%;">
                <button class="btn btn-info btn-sm pull-right" @click="subscribe('job')">সাবস্ক্রাইব</button>
              </div>
            </div>
            <div style="width:100%">
                <table class="table mt-2">
                    <tr v-for="(list,key) in sub_jobs.data" :key="key">
                      <td>{{list.job_name}}</td>
                      <td>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteSub(key,list.id,'job')" type="button" class="btn btn-warning">
                              <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card col-md-12">
            <div style="width:100%;margin-top:10px;">
                <div class="pull-left">
                    <p>ভাষা</p>
                </div>
                <div class="pull-right">
                    <button v-if="language_open" @click="openCloseLanguage" class="btn btn-sm btn-info"><i class="fa fa-minus"></i></button>
                    <button v-else @click="openCloseLanguage" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div v-if="language_open" style="width:100%">
              <treeselect  name="language"  placeholder="ভাষা"  v-model="language" :multiple="true" :options="languages" />
              <div class="mt-2" style="width:100%;">
                <button class="btn btn-info btn-sm pull-right" @click="subscribe('language')">সাবস্ক্রাইব</button>
              </div>
            </div>
            <div style="width:100%">
                <table class="table mt-2">
                    <tr v-for="(list,key) in sub_languages.data" :key="key">
                      <td>{{list.language_name}}</td>
                      <td>
                        <button  style="padding: 2px 7px; font-size: 13px;" @click="deleteSub(key,list.id,'language')" type="button" class="btn btn-warning">
                              <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import * as VeeValidate from 'vee-validate'
import { mapMutations, mapGetters } from 'vuex'
Vue.use(VeeValidate)
export default {
  middleware:'auth-applicant',
  name: 'subcription',
  layout: 'dashboard',
  data() {
    return {
      agency_open:false,
      country_open:false,
      job_open:false,
      language_open:false,
      agency:[],
      country:[],
      job:[],
      language:[],
      loader:false,
      list: {
        old: '',
        new: '',
        re_new: ''
      }
    }
  },
  computed:{
   ...mapGetters({
      agencies: 'admin/subscribe/agencies',
      sub_agencies: 'admin/subscribe/sub_agencies',
      countries: 'admin/subscribe/countries',
      sub_countries: 'admin/subscribe/sub_countries',
      jobs: 'admin/subscribe/jobs',
      sub_jobs: 'admin/subscribe/sub_jobs',
      languages: 'admin/subscribe/languages',
      sub_languages: 'admin/subscribe/sub_languages',
    })
  },
  mounted() {
    this.getAgency();
    this.getCountry();
    this.getJob();
    this.getLanguage();
  },
  methods: {
    async getAgency(page=1){
      await this.$store.dispatch('admin/subscribe/getAgency',page)
    },
    async getCountry(page=1){
      await this.$store.dispatch('admin/subscribe/getCountry',page)
    },
    async getJob(page=1){
      await this.$store.dispatch('admin/subscribe/getJob',page)
    },
    async getLanguage(page=1){
      await this.$store.dispatch('admin/subscribe/getLanguage',page)
    },
    async deleteSub(key,id,type){
      var data = {
        type:type,
        id:id,
        index:key
      }
      await this.$store.dispatch('admin/subscribe/deleteSub',data)
    },
    async subscribe(type){
      var data = {}
      if(type == 'agency'){
        data = {
          type: type,
          agency:this.agency
        }
      }
      else if(type == 'country'){
        data = {
          type: type,
          country:this.country
        }
      }
      else if(type == 'language'){
        data = {
          type: type,
          language:this.language
        }
      }
      else if(type == 'job'){
        data = {
          type: type,
          job:this.job
        }
      }
      
      await this.$store.dispatch('admin/subscribe/subscribe',data).then(response =>{
        if(type == 'agency'){
          this.agency = []
        }
        else if(type == 'country'){
          this.country = []
        }
        else if(type == 'language'){
          this.language = []
        }
        else if(type == 'job'){
          this.job = []
        }
      })
    },
    openCloseAgency(){
        this.agency_open = !this.agency_open
    },
    openCloseCountry(){
      this.country_open = !this.country_open
    },
    openCloseLanguage(){
        this.language_open = !this.language_open
    },
    openCloseJob(){
      this.job_open = !this.job_open
    },
    valiadte() {
      var self = this
      this.$validator.validateAll().then(result => {
        if (result) {
          self.change()
        }
      })
    },
    change() {
      try {
        this.loader = true;
        var data = this.list
        this.$axios
          .post('/api/contact/password-change', data)
          .then(response => {
            this.loader = false;
            this.$notify.success({
              title: 'পাসওয়ার্ড ',
              message: 'পাসওয়ার্ড চেঞ্জ করতে সক্ষম হয়েছেন'
            })
          })
          .catch(error => {
             this.loader = false;
            this.$notify.error({
              title: 'পাসওয়ার্ড ',
              message: 'পুরনো পাসওয়ার্ড সঠিক নয়'
            })
          })
      } catch (error) {
         this.loader = false;
        this.$notify.error({
          title: 'পাসওয়ার্ড ',
          message: 'পুরনো পাসওয়ার্ড সঠিক নয়'
        })
      }
    }
  }
}
</script>
