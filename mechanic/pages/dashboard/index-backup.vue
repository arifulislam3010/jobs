<template>
    <div class="profile-page">
        <section style="padding-top:0px;" class="section section-skew">
            <div v-if="this.$auth.user.type == 6" class="row">
                <div @click="getApplicantResult(1,111)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-blue order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট আবেদন<span  class="f-right"><i  class="fa fa-credit-card f-left"></i></span></p>
                        <span class="f-left">{{total_application}}</span>
                    </div>
                </div>
                <div @click="getApplicantResult(2,2)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-green order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট সংক্ষিপ্ত তালিকাভুক্ত<span  class="f-right"><i  class="fa fa-user"></i></span></p>
                        <span class="f-left">{{sorted_application}}</span>
                    </div>
                </div>
                
                <div @click="getApplicantResult(3,3)" class="col-md-4 col-xl-3">
                    <div class="card thum-card bg-c-pink order-card">
                        <p style="font-size:15px;" class="m-b-0"> মোট নির্বাচিত তালিকাভুক্ত<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{selected_application}}</span>
                    </div>
                </div>
                <div @click="getApplicantResult(2,2)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-yellow order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট পেন্ডিং তালিকাভুক্ত<span  class="f-right"><i  class="fa fa-user"></i></span></p>
                        <span class="f-left">{{pending_application}}</span>
                    </div>
                </div>
                <div @click="getfavouriteList()" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-purple order-card">
                        <p style="font-size:15px;" class="m-b-0">পছন্দের নিয়োগ বিজ্ঞপ্তি<span  class="f-right"><i  class="fa fa-user"></i></span></p>
                        <span class="f-left">{{favourite}}</span>
                    </div>
                </div>
                
                <div v-if="applica_result_type" class="col-md-12 col-xl-12">
                    <div>
                        <!-- <span style="font-size:20px;">সর্বশেষ বিজ্ঞপ্তি: </span> -->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <td v-if="applica_result_type == 1" colspan="3"><span style="font-size:20px;">আবেদন তালিকা</span></td>
                              <td v-if="applica_result_type == 2" colspan="3" ><span style="font-size:20px;">সংক্ষিপ্ত তালিকা</span></td>
                              <td v-if="applica_result_type == 3" colspan="3" ><span style="font-size:20px;">নির্বাচিত তালিকা</span></td>
                          </tr>
                          <tr>
                            <th>ক্রম </th>
                            <th>পদবি</th>
                            <th>এজেন্সি</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(post,index) in lists2.data" :key="index">
                            <td>{{ serial[index] }}</td>
                            <td ><span style="cursor:pointer" @click="goPost(post.post_slug)">{{post.post}}</span></td>
                            <td ><span style="cursor:pointer" @click="goAgency(post.agency_slug)">{{post.agency}}</span></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
                <div v-if="applica_result_type" style="width:100%">
                    <!-- <button @click="openModal()">Test</button> -->
                    <pagination :data="lists2" @pagination-change-page="getApplicantResult2"></pagination>
                </div>
                <div v-if="favourite_lists" class="col-md-12 col-xl-12">
                    <div>
                        <!-- <span style="font-size:20px;">সর্বশেষ বিজ্ঞপ্তি: </span> -->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <td  colspan="3"><span style="font-size:20px;">পছন্দের নিয়োগ বিজ্ঞপ্তি তালিকা</span></td>
                          </tr>
                          <tr>
                            <th>ক্রম </th>
                            <th>পদবি</th>
                            <th>এজেন্সি</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(post,index) in favourite_lists" :key="index">
                            <td>{{ serial[index] }}</td>
                            <td ><span style="cursor:pointer" @click="goPost(post.post_slug)">{{post.post}}</span></td>
                            <td ><span style="cursor:pointer" @click="goAgency(post.agency_slug)">{{post.agency}}</span></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            <div v-if="this.$auth.user.role_id == 3 || this.$auth.user.role_id == 2" class="row">
                <div class="col-md- col-xl-3">
                    <nuxt-link to="/dashboard/jobposts">
                    <div class="card bg-c-blue order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট বিজ্ঞপ্তি<span  class="f-right"><i  class="fa fa-credit-card f-left"></i></span></p>
                        <span class="f-left">{{ agency_info.total_post }}</span>
                    </div>
                    </nuxt-link>
                </div>
                <div class="col-md-4 col-xl-3">
                    <nuxt-link to="#">
                    <div  class="card bg-c-green order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট আগ্রহী প্রার্থী<span  class="f-right"><i  class="fa fa-user"></i></span></p>
                        <span class="f-left">{{ agency_info.total_applicant }}</span>
                    </div>
                    </nuxt-link>
                </div>
                <div class="col-md-4 col-xl-3">
                    <nuxt-link to="#">
                    <div  class="card bg-c-yellow order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট মাইগ্রেট প্রার্থী<span  class="f-right"><i class="fas fa-clipboard-list"></i></span></p>
                        <span class="f-left">{{ agency_info.migrate_applicant }}</span>
                    </div>
                    </nuxt-link>
                </div>
                <div class="col-md-4 col-xl-3">
                    <nuxt-link to="#">
                    <div v-if="this.$auth.user.role_id == 2" class="card bg-c-pink order-card">
                        <p style="font-size:15px;" class="m-b-0"> মোট এডমিন<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{ agency_info.total_admin }}</span>
                    </div>
                    </nuxt-link>
                </div>
                <!-- <div v-if="this.$auth.user.role_id == 3 "class="col-md-4 col-xl-3">
                    <nuxt-link to="/dashboard/admin">
                    <div class="card bg-c-pink order-card">
                        <p style="font-size:15px;" class="m-b-0"> মোট এডমিন<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{ agency_info.total_admin }}</span>
                    </div>
                    </nuxt-link>
                </div> -->
                <div class="col-md-12 col-xl-12">
                    <div>
                        <!-- <span style="font-size:20px;">সর্বশেষ বিজ্ঞপ্তি: </span> -->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <td colspan="4"><span style="font-size:20px;">সর্বশেষ বিজ্ঞপ্তি: </span></td>
                          </tr>
                          <tr>
                            <th>ক্রম </th>
                            <th>পদবি</th>
                            <th>নির্মিত</th>
                            <th>মোট আগ্রহী প্রার্থী</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(post,index) in agency_info.posts" :key="index">
                            <td>{{ serial[index] }}</td>
                            <td>{{post.headline}}</td>
                            <td>{{post.created_by}}</td>
                            <td>00</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            <div v-if="this.$auth.user.role_id == 1" class="row">
                <div class="col-md-4 col-xl-3">
                    <div @click="report(3,null)" class="card bg-c-blue order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট এজেন্সি<span  class="f-right"><i  class="fa fa-credit-card f-left"></i></span></p>
                        <span class="f-left">{{ lists.agency }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div@click="report(6,null)" class="card bg-c-green order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট প্রার্থী<span  class="f-right"><i  class="fa fa-user"></i></span></p>
                        <span class="f-left">{{ lists.applicant }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div  class="card bg-c-yellow order-card">
                        <p style="font-size:15px;" class="m-b-0">অভিবাসী আবেদনকারী<span  class="f-right"><i class="fas fa-clipboard-list"></i></span></p>
                        <span class="f-left">{{ lists.migrant }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div @click="report(4,null)" class="card bg-c-pink order-card">
                        <p style="font-size:15px;" class="m-b-0"> প্রশিক্ষণ ইনস্টিটিউট<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{ lists.training }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div style="border: solid 1px #d6d6c2;padding:5px;color:#d6d6c2">
                        <span>সমস্ত পরিসংখ্যান</span>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div class="row" style="border: solid 1px #d6d6c2;margin:0px;background-color:#d6d6c2;padding-top:15px;">
                        <div class="col-md-4 col-xl-4">
                            <div>
                                <VueCtkDateTimePicker v-model="applicantInfoMainDate" label="তারিখ নির্বাচন করুন" formatted='ll' format="YYYY-MM-DD" range></VueCtkDateTimePicker>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="form-group">
                                <multiselect
                                    @input="getDistrictByID2()"
                                    v-model="division_id"
                                    placeholder="বিভাগ নির্বাচন করুন"
                                    label="division_name_bng"
                                    track-by="id"
                                    :options="divisions"
                                  ></multiselect>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="form-group">
                                <multiselect
                                    v-model="district_id"
                                    placeholder="জেলা নির্বাচন করুন"
                                    label="district_name_bng"
                                    track-by="id"
                                    :options="total2.districts2"
                                  ></multiselect>
                            </div>
                        </div>
                        
                        <div style="margin-bottom:10px;" class="col-md-12 col-xl-12">
                            <button style="padding-left:37px;" type="button" class="btn btn-secondary f-right" @click="submitData">খোঁজ করুন</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div style="border: solid 1px #d6d6c2;color:#d6d6c2;overflow: hidden !important">
                        <div  class="row">
                            <div style="border: solid 1px #d6d6c2;color:#d6d6c2"  class="col-md-4 col-xl-4" v-if="all_statistics.total_data">
                                <div @click="report(6,null)" style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">আগ্রহী প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.interested}}</span>
                                    </div>
                                </div>
                                <div @click="report(6,1)" style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">দক্ষ প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.skilled}}</span>
                                    </div>
                                </div>
                                <div @click="report(6,0)" style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">অদক্ষ প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.unskilled}}</span>
                                    </div>
                                </div>
                                <div @click="report(6,11)" style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;margin-bottom: 15px;">
                                        <span style="font-size:15px;" class="m-b-0">অভিবাসী প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.migrant}}</span>
                                    </div>
                                </div>
                            </div>
                            <div style="border: solid 1px #d6d6c2;color:#d6d6c2" class="col-md-4 col-xl-4">
                                <GChart 
                                    type="ColumnChart"
                                    :data="all_statistics.total_column_chart"
                                    :options="chartOptions"
                                />
                            </div>
                            <div style="border: solid 1px #d6d6c2;5px;color:#d6d6c2" class="col-md-4 col-xl-4">
                                <div style="margin-top:80px;margin-left:40px;">
                                    <GChart
                                    type="PieChart"
                                    :data="all_statistics.total_pie_chart"
                                    :options="pieOptions"
                                />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div >
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>নাম</th>
                                <th>মোট আগ্রহী প্রার্থী</th>
                                <th>দক্ষ প্রার্থী</th>
                                <th>অদক্ষ প্রার্থী</th>
                                <th>মোট অভিবাসী</th>
                            </tr>
                            </thead>
                            <tbody v-if="all_statistics.total_data_list">
                            <tr v-for="(list,index) in all_statistics.total_data_list" :key="index">
                                <td>{{ index+1 }}</td>
                                <td>{{ list.name }}</td>
                                <td>{{ list.interested }}</td>
                                <td>{{ list.skilled }}</td>
                                <td>{{ list.unskilled }}</td>
                                <td>{{ list.migrant }}</td>
                            </tr>
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
// import HotelDatePicker from 'vue-hotel-datepicker'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
import { GChart } from 'vue-google-charts';
import Multiselect from 'vue-multiselect';
export default {
  middleware: 'auth',
  layout: 'dashboard',
  components: {
    pagination,
    // HotelDatePicker,
    VueCtkDateTimePicker,
    GChart,
    Multiselect
  },
  data(){
      return {
          favourite_lists:'',
          status:'',
          applica_result_type:0,
          total_application:0,
          pending_application:0,
          sorted_application:0,
          selected_application:0,
          favourite:0,
          serial:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫'],
          yourValue:'',
            // columnChartData: [
            //     ['Element', 'Density', { role: 'style' }],
            //     ['Interest Applicant', 230, '#b87333'],            // RGB value
            //     ['Skilled', 90, 'silver'],            // English color name
            //     ['Unskilled', 110, 'green'],
            //     ['Migrants', 30, 'gold']
            // ],
            columnChartData: [
                ['Applicant', 'Interest Applicant', 'Skilled', 'Unskilled', 'Migrants'],
                ['Applicant', 230, 100, 123, 165]
            ],
        pieChartData: [
          ['Gender', 'Participants'],
          ['Male',     350],
          ['Female',    140],
          ['Others',  10]
        ],
        chartOptions: {
            legend: { position: 'top', alignment: 'start' },
            height: "350"
        },
        pieOptions:{
          title: 'Daily Activities',
          pieHole: 0.4,
          chartArea:{width:350,height:350},
          legend:{}
        },
        divisions:[],
        division_id: '',
        district_id: '',
        total2:{
            districts2: [],
            subdistricts2:[],
            unions2:[],
        },
        applicantInfoMainDate:'',
        role_id:'',
        status:''
      }
  },
  computed:{
    ...mapGetters({
        lists2: 'admin/appliedApplicant/lists',
        agency_info: 'admin/dashboard/agency_info',
        applicant_info: 'admin/dashboard/applicant_info',
        lists: 'admin/dashboard/lists',
        all_statistics: 'admin/dashboard/all_statistics'
    })
  },
//   computed: mapGetters({
//     agency_info: 'admin/dashboard/agency_info',
//     applicant_info: 'admin/dashboard/applicant_info',
//     lists: 'admin/dashboard/lists',
//     all_statistics: 'admin/dashboard/all_statistics'
//   }),
  mounted(){
    if(this.$auth.user.role_id == 1){
        this.get();
        this.getAllStatistics();
        this.getDivision();
    }
    else if(this.$auth.user.role_id == 3 || this.$auth.user.role_id == 2){
        this.getAgencyInfo()
    }
    else if(this.$auth.user.type == 6){
        this.summaryApplicant()
    }
  },
  methods:{
    getfavouriteList(){
        this.applica_result_type = 0;
        this.$axios.get('api/get/favourite-list').then(response=>{
            this.favourite_lists = response.data;
        })
    },
    goPost(slug){
        this.$router.push('/notice-of-appointment/'+slug)
    },
    goAgency(slug){
        this.$router.push('/agency/'+slug)
    },
    summaryApplicant(){
        this.$axios.get('api/get/summary-applicant').then(response=>{
            this.total_application = response.data.total
            this.pending_application = response.data.pending
            this.sorted_application = response.data.sorted
            this.selected_application = response.data.selected 
            this.favourite = response.data.favourite 
        })
    },
    getApplicantResult(type,status){
        this.applica_result_type = type
        this.status = status
        this.getApplicantResult2(1)
    },
    async getApplicantResult2(page=1){
      var data = {
        page:page,
        status:this.status,
      }
      await this.$store.dispatch('admin/appliedApplicant/get',data)
    },
     async getAgencyInfo(){
        try {
            await this.$store.dispatch('admin/dashboard/agencyInfo')
        } catch (e) {
            
        }
    },
    async getApplicantInfo(){
        try {
            await this.$store.dispatch('admin/dashboard/applicantInfo')
        } catch (e) {
            
        }
    },
    report(role_id='',status=''){
        // this.$router.push({path: this.$route.path, query: { foo: 'bar' }})
        if(!this.applicantInfoMainDate){
           this.applicantInfoMainDate = {start:'',end:''}
       }
       if(!this.division_id){
           this.division_id = {id:''}
       }
       if(!this.district_id){
           this.district_id = {id:''}
       }
       
        this.role_id = role_id;
        this.status = status;
        var query = {applicantInfoMainDate:this.applicantInfoMainDate,division:this.division_id,district:this.district_id,role_id:this.role_id,status:this.status}
        console.log(query)
        this.$router.push({path: 'dashboard/report', query: query})
    },
    async get () {
      try {
        await this.$store.dispatch('admin/dashboard/get')
      } catch (e) {
        
      }
    },
    async getAllStatistics () {
      try {
        await this.$store.dispatch('admin/dashboard/getAllStatistics',{applicantInfoMainDate:this.applicantInfoMainDate,division_id:this.division_id.id,district_id:this.district_id.id})
      } catch (e) {
        
      }
    },
    async getDistrictByID2() {
        if(this.division_id){
            this.$axios
            .get('api/get-district/' + this.division_id.id)
            .then(response => {
            this.total2.districts2 = response.data
            })
            .catch(error => {})
        }else{
            this.total2.districts2 = [];
        }
    },
    async getDivision(){
        this.$axios.get('api/get-division').then(response => {
              this.divisions = response.data;
        })
        .catch(error => {

        });
    },
    submitData(){
        this.getAllStatistics();
    }
  }
};
</script>
<style>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: #009900;
}

.bg-c-green {
    background: #fcba03;
}

.bg-c-yellow {
    background: #ac7339;
}

.bg-c-pink {
    background: #8d1ed6;
}

.bg-c-purple {
    background: #0ccea4;
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    padding: 10px;
}
.thum-card{
    cursor: pointer;
}
.thum-card:hover{
    transform: scale(1.1);
}
.card2 {
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    padding: 10px;
    margin-top: 13px;
    margin-bottom: 0px;
}

.order-card i {
    font-size: 16px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
.table tr>th {
    font-size: 15px;
}
</style>

