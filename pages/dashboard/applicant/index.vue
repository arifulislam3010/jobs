<template>
  <div>
    <div class="col-md-12">
        <div class="row mb-1">
            <div style="width:15%;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                v-model="country"
                placeholder="জনবল পাঠানো দেশ"
                label="country_name"
                track-by="id"
                :options="countries"
              ></multiselect>
            </div>
            &nbsp;
            <div style="width:15%;">
                <multiselect
                    selectLabel=""
                    deselectLabel=""
                    v-model="job"
                    placeholder="জনবল পাঠানো চাকুরী"
                    label="name"
                    track-by="id"
                    :options="jobs"
                ></multiselect>
            </div>
            <div v-if="$auth.user.type == 1">
              &nbsp;
            </div>
            <select v-if="$auth.user.type == 1" v-model="search.t_by_admin" style="width:20%;border-color:#f0e4e4;border-radius:5px;" class="from-control">
              <option value="">প্রশিক্ষণ আপডেট করিনি/করেছি</option>
              <option value="1">প্রশিক্ষণ আপডেট করেছি </option>
              <option value="2">প্রশিক্ষণ আপডেট করিনি</option>
            </select>
            &nbsp;
            <div style="width:20%">
              <input class="form-control" v-model="search.search" placeholder="নাম" type="text" />
            </div>
            &nbsp;
            <div>
              <button @click="get()" class="btn btn-info">সার্চ</button>
            </div>
            &nbsp;
            <div style="width:15%">
              <button  @click="getPdf()" class="btn btn-success"><i class="fas fa-file-pdf"></i> এক্সপোর্ট</button>
            </div>
            <!-- <download-excel
              :data   = "json_data"
              name = "Applicants"
            >
              <button class="btn btn-success"><i class="fa fa-file-excel-o"></i> এক্সপোর্ট</button>
          </download-excel>
          <button @click="getPdf()">Test</button> -->
          
        </div>
    </div>
      <div style="width:100%">
          <div class="tables-2 mb-5">
            <div class="table-responsive mb-0" v-if="this.lists.data">
              <table class="table table-pricing" v-if="this.lists.data.length>0">
                <tbody>
                  <tr class="bg-primary text-white">
                    <td >
                      <b>নাম</b>
                    </td>
                    <td>
                      <b>ইমেইল/ ফোন</b>
                    </td>
                    <td>
                      <b>ঠিকানা</b>
                    </td>
                    <td>
                      <b>একশন</b>
                    </td>
                  </tr>
                  <tr v-for="(list,keya) in this.lists.data" v-bind:key="keya">
                    <td>{{list.name}}</td>
                    <td >
                      <span v-if="list.email">{{list.email}}</span>
                      <span v-if="list.phone">{{list.phone}}</span>
                    </td>
                    <td >
                      <span v-for="(address,key) in list.address" :key="key">{{address.name}}</span>
                      <span v-if="list.address2">{{list.address2.subdistrict.upazila_name_eng}}, {{list.address2.district.district_name_eng}}</span>
                    </td>
                    <td >
                      <button @click="openModal(list)" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>
                      <button v-if="$auth.user.type == 1" @click="openModalTraining(list,keya)" type="button" class="btn btn-success btn-sm">প্রশিক্ষণ </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="this.lists" @pagination-change-page="get" :limit="5"></pagination>
            </div>
          </div>
        </div>
        <applicantView ref="applicant_view"></applicantView>
        <ApplicantTraining :training_centers="training_centers" ref="applicant_training"></ApplicantTraining>
      </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import Multiselect from 'vue-multiselect'
import applicantView from "~/components/dashboard/applicantView";
import ApplicantTraining from "~/components/dashboard/applicantTraining";
export default {
  name: 'User',
  middleware: 'sup-and-admin',
  layout: 'dashboard',
  components: {pagination,Multiselect,applicantView,ApplicantTraining},
  data() {
    return {
      countries:[],
      jobs:[],
      job:'',
      country:'',
      training_centers:[],
      search: {
        search:'',
        job_id:'',
        country_id:'',
        type: 6,
        t_by_admin:''
      },
      json_data:[]
    }
  },
  computed: mapGetters({
    lists: 'admin/applicant/lists'
  }),
  mounted() {
    this.getCountry()
    this.getJob()
    this.get()
    this.getTraningCenter()
  },
  methods: {
    openModal(list) {
      this.$refs.applicant_view.openModal(list);
    },
    openModalTraining(list,index){
      this.$refs.applicant_training.openModal(list,index);
    },
    getPdf(){
      window.open(process.env.LARAVEL_ENDPOINT+'/api/get-applicant-pdf?page='+this.search.page+'&id='+this.$auth.user.id+'&user='+this.$auth.user.name+'&search='+this.search.search+'&job_id='+this.search.job_id+'&country_id='+this.search.country_id+'&type='+this.search.type+'&t_by_admin='+this.search.t_by_admin)
    },
    test(){
      window.open('http://localhost:8000/api/test-xyz');
      // var FileSaver = require('file-saver');
      
      // this.$axios.get('api/test-xyz',{responseType: 'arraybuffer'}).then(response=>{
      //   var blob = new Blob([response.data], {type: "text/plain;charset=utf-8"});
      //   FileSaver.saveAs(blob, "hello.pdf");
      // })
    },
    async get(page = 1) {
      this.search.page = page
      if(this.country){
        this.search.country_id = this.country.id;
      }
      else{
        this.search.country_id = '';
      }
      if(this.job){
        this.search.job_id = this.job.id;
      }
      else{
        this.search.job_id = '';
      }
      try {
        await this.$store.dispatch('admin/applicant/get', this.search)
      }
      catch (e) {

      }
    },
    async deleteUser(key, id) {
      try {
        await this.$store.dispatch('admin/user/user/delete', { key, id })
      } catch (e) {}
    },
    
    async getJob() {
      await this.$axios
        .get('api/get-desired-job')
        .then(response => {
          this.jobs = response.data
        })
        .catch(error => {})
    },
    async getCountry() {
      await this.$axios
        .get('api/get-country')
        .then(response => {
          this.countries = response.data
        })
        .catch(error => {})
    },
    async getTraningCenter(){
      this.$axios.get('api/get-training-center').then(response => {
        this.training_centers = response.data;
      })
      .catch(error => {
      });
    }
  }
}
</script>

<style  scoped>
.imgButton {
  position: relative;
}
select:focus{
  outline: none;
}
select{
  color: #c1c1c1;
}
</style>
