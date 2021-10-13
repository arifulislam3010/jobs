<template>
    <div class="profile-page">
        <section style="padding-top:0px;" class="section section-skew">
            <div v-if="this.$auth.user.type == 6" class="row">
                <div @click="getApplicantResult(1,111)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-blue order-card">
                        
                        <span class="f-left">{{getBanglavalue(total_application)}}</span>
                        <p style="font-size:15px;" class="m-b-0">Total Application</p>
                    </div>
                </div>
                <div @click="getApplicantResult(2,2)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-green order-card">
                       
                        <span class="f-left">{{getBanglavalue(sorted_application)}}</span>
                         <p style="font-size:15px;" class="m-b-0">Sorted Spplication</p>
                    </div>
                </div>
                
                <div @click="getApplicantResult(3,3)" class="col-md-4 col-xl-3">
                    <div class="card thum-card bg-c-bb order-card">
                       
                        <span class="f-left">{{getBanglavalue(selected_application)}}</span>
                         <p style="font-size:15px;" class="m-b-0"> Selected application </p>
                    </div>
                </div>
                <div @click="getApplicantResult(2,2)" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-red order-card">
                       
                        <span class="f-left">{{getBanglavalue(pending_application)}}</span>
                         <p style="font-size:15px;" class="m-b-0">Pending Application </p>
                    </div>
                </div>
                <div @click="getfavouriteList()" class="col-md-4 col-xl-3">
                    <div  class="card thum-card bg-c-purple order-card">
                        
                        <span class="f-left">{{getBanglavalue(favourite)}}</span>
                        <p style="font-size:15px;" class="m-b-0">Favourite </p>
                    </div>
                </div>
                
                <div v-if="applica_result_type" class="col-md-12 col-xl-12">
                    <div>
                        <!-- <span style="font-size:20px;">সর্বশেষ বিজ্ঞপ্তি: </span> -->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <td v-if="applica_result_type == 1" colspan="3"><span style="font-size:20px;">Applications</span></td>
                              <td v-if="applica_result_type == 2" colspan="3" ><span style="font-size:20px;">Sorted List</span></td>
                              <td v-if="applica_result_type == 3" colspan="3" ><span style="font-size:20px;">Selected List</span></td>
                          </tr>
                          <tr>
                            <th>No </th>
                            <th>Designation</th>
                            <th>Company</th>
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
                              <td  colspan="3"><span style="font-size:20px;">Faverit Job posts</span></td>
                          </tr>
                          <tr>
                            <th>No </th>
                            <th>Designation</th>
                            <th>Company</th>
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
            <div v-if="this.$auth.user.type == 3" class="row">
                <div class="col-md- col-xl-3">
                    <nuxt-link to="/dashboard/jobposts">
                    <div class="card bg-c-blue order-card">
                        
                        <span class="f-left">{{ getBanglavalue(total_post) }}</span>
                        <p style="font-size:15px;" class="m-b-0">Job Posts</p>
                    </div>
                    </nuxt-link>
                </div>
                <div class="col-md-4 col-xl-3">
                    <nuxt-link to="/dashboard/job-applicant">
                    <div  class="card bg-c-red order-card">
                       
                        <span class="f-left">{{ getBanglavalue(total_applied_applicant) }}</span>
                         <p style="font-size:15px;" class="m-b-0">Applicant</p>
                    </div>
                    </nuxt-link>
                </div>
                <div class="col-md-4 col-xl-3">
                    <a href="#test">
                        <div  class="card bg-c-bb order-card">
                            
                            <span class="f-left">{{ getBanglavalue(total_migrated) }}</span>
                            <p style="font-size:15px;" class="m-b-0">Selected Applicant</p>
                        </div>
                    </a>
                </div>
                <div id="test"  class="col-md-12 col-xl-12">
                    <table class="table table-bordered">
                        <thead>
                          <tr style="background:#fff;">
                              <td  colspan="4">
                                  <div class="col-md-12">
                                    <div class="row">
                                        <div style="width:35%;">
                                            <span style="font-size:20px;">Selected Applicant: {{migration_count}}</span>
                                        </div>
                                        <!-- <div style="width:20%;">
                                            <multiselect
                                            v-model="country"
                                            placeholder="জনবল পাঠানো দেশ"
                                            label="country_name"
                                            track-by="id"
                                            :options="countries"
                                            ></multiselect>
                                        </div> -->
                                        &nbsp;
                                        <!-- <div style="width:10%;color:#fff;">
                                            <button 
                                            @click="getMigrateApplicant()"
                                            class="btn btn-secondary"
                                            >খুঁজুন</button>
                                        </div> -->
                                        &nbsp;
                                        <div style="width:10%">
                                            <button  @click="getPdf()" class="btn btn-success"><i class="fas fa-file-pdf"></i>Export</button>
                                        </div>
                                    </div>
                                </div>
                              </td>
                          </tr>
                          <tr>
                            <th>No </th>
                            <th>Applicant</th>
                            <th>Designation</th>
                            <th>Company</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(post,index) in migrate_applicants.data" :key="index">
                            <td>{{ serial[index] }}</td>
                            <td ><span>{{post.applicant_name}}</span></td>
                            <td ><span style="cursor:pointer" @click="goPost(post.post_slug)">{{post.post_name}}</span></td>
                            <td ><span style="cursor:pointer" @click="goAgency(post.agency_slug)">{{post.agency_name}}</span></td>
                          </tr>
                        </tbody>
                      </table>
                      <pagination :data="migrate_applicants" @pagination-change-page="getMigrateApplicant"></pagination>
                </div>
            </div>
            <div v-if="$auth.user.role_id == 1|| $auth.user.role_id == 9" class="row">
                <div class="col-md-4 col-xl-3">
                    <div @click="goTo('agency')" class="card bg-c-blue order-card">
                       
                        <span class="f-left">{{getBanglavalue(total_agency)}} </span>
                         <p style="font-size:15px;" class="m-b-0">Total Company</p>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div @click="goTo('applicant')" class="card bg-c-green order-card">
                        
                        <span class="f-left">{{ getBanglavalue(total_applicant) }}</span>
                        <p style="font-size:15px;" class="m-b-0">Total Applicant</p>
                    </div>
                </div>
                <div v-if="$auth.user.role_id == 1" class="col-md-4 col-xl-3">
                    <div @click="goTo('training-center')" class="card bg-c-yellow order-card">
                       
                        <span class="f-left">{{ getBanglavalue(total_training_center) }}</span>
                         <p style="font-size:15px;" class="m-b-0">Training Center</p>
                    </div>
                </div>
                <!-- <div v-if="$auth.user.role_id == 1" class="col-md-4 col-xl-3">
                    <div @click="goTo('important-embassy')" class="card bg-c-pink order-card">
                        <p style="font-size:15px;" class="m-b-0"> গুরুত্বপূর্ণ এম্বাসি<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{ getBanglavalue(total_embassy) }}</span>
                    </div>
                </div> -->
                <!-- <div v-if="$auth.user.role_id == 1" class="col-md-4 col-xl-3">
                    <div @click="goTo('financial-organization')" class="card bg-c-bb order-card">
                        <p style="font-size:15px;" class="m-b-0">আর্থিক সংস্থা<span  class="f-right"><i class="far fa-building"></i></span></p>
                        <span class="f-left">{{ getBanglavalue(total_financial_organization) }}</span>
                    </div>
                </div> -->
                <div v-if="$auth.user.role_id == 1" class="col-md-4 col-xl-3">
                    <div @click="goTo('jobposts')" class="card bg-c-red order-card">
                        
                        <span class="f-left">{{ getBanglavalue(total_post) }}</span>
                        <p style="font-size:15px;" class="m-b-0">Job Posts</p>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-xl-3">
                    <a href="#test">
                        <div  class="card bg-c-purple order-card">
                            <p style="font-size:15px;" class="m-b-0">মাইগ্রেট প্রার্থী<span  class="f-right"><i class="far fa-building"></i></span></p>
                            <span class="f-left">{{ getBanglavalue(total_migrated) }}</span>
                        </div>
                    </a>
                </div> -->

                <div v-if="$auth.user.role_id == 1" class="col-md-12 col-xl-12">
                    <div style="border: solid 1px #d6d6c2;padding:5px;color:#d6d6c2">
                        <span>All Statistics</span>
                    </div>
                </div>
                <div  v-if="$auth.user.role_id == 1" class="col-md-12 col-xl-12">
                    <div class="row" style="border: solid 1px #d6d6c2;margin:0px;background-color:#d6d6c2;padding-top:15px;padding-right:10px;">
                        <div class="col-md-3 col-xl-3">
                            <div>
                                <VueCtkDateTimePicker  formatted='ll' format="YYYY-MM-DD"  v-model="mydate" :range="true" :label="'Select time range'" /> 
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-3">
                            <multiselect
                                selectLabel=""
                                deselectLabel=""
                                name = "division"
                                @input="getDistrict()"
                                v-model="division"
                                placeholder="Division"
                                label="division_name_eng"
                                track-by="id"
                                :options="divisions"
                            ></multiselect>
                        </div>
                        <div class="col-md-3 col-xl-3">
                            <multiselect
                                selectLabel=""
                                deselectLabel=""
                                name = "district"
                                @input="getSubdistrict()"
                                v-model="district"
                                placeholder="District"
                                label="district_name_eng"
                                track-by="id"
                                :options="districts"
                            ></multiselect>
                        </div>
                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <multiselect
                                    selectLabel=""
                                    deselectLabel=""
                                    name = "subdistrict"
                                    style="margin-left:15px;"
                                    v-model="subdistrict"
                                    placeholder="Subdistrict"
                                    label="upazila_name_eng"
                                    track-by="id"
                                    :options="subdistricts"
                                ></multiselect>
                            </div>
                        </div>
                        <div class="col-md-10 col-xl-10">
                            <!-- <button @click="getStatistics()">Test</button> -->
                            <!-- <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                <option>Applicant wise report</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="col-md-2 col-xl-2 mb-2" style="padding-right:0px;">
                            <button @click="getSearchData()" style="padding-left:37px;padding-right:37px;" type="button" class="btn btn-secondary f-right">Submit</button>
                        </div>
                    </div>
                </div>
                <div  v-if="$auth.user.role_id == 1" class="col-md-12 col-xl-12">
                    <div style="border: solid 1px #d6d6c2;color:#d6d6c2;overflow: hidden !important">
                        <div  class="row">
                            <div style="border: solid 1px #d6d6c2;color:#d6d6c2"  class="col-md-4 col-xl-4">
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">Total Interested Applicant</span><br>
                                        <span class="f-left">{{getBanglavalue(demoData.intersested)}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">Total Skilled Applicant</span><br>
                                        <span class="f-left">{{getBanglavalue(demoData.skilled)}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">Total Unskilled Applicant</span><br>
                                        <span class="f-left">{{getBanglavalue(demoData.unskilled)}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;margin-bottom: 15px;">
                                        <span style="font-size:15px;" class="m-b-0">Total Selected Applicant</span><br>
                                        <span class="f-left">{{getBanglavalue(demoData.imigrate)}}</span>
                                    </div>
                                </div>
                            </div>
                            <div style="border: solid 1px #d6d6c2;color:#d6d6c2" class="col-md-4 col-xl-4">
                                <GChart 
                                    type="ColumnChart"
                                    :data="columnChartData"
                                    :options="chartOptions"
                                />
                            </div>
                            <div style="border: solid 1px #d6d6c2;5px;color:#d6d6c2" class="col-md-4 col-xl-4">
                                <div style="margin-top:80px;margin-left:40px;">
                                    <GChart
                                    type="PieChart"
                                    :data="pieChartData"
                                    :options="pieOptions"
                                />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div  v-if="$auth.user.role_id == 1" class="col-md-12 col-xl-12">
                    <div style="border: solid 1px #d6d6c2;padding:5px;color:#d6d6c2">
                        <span>উপজেলা ভিত্তিক পরিসংখ্যান</span>
                    </div>
                </div>
                <div  v-if="$auth.user.role_id == 1" class="col-md-12 col-xl-12">
                    <div class="row" style="border: solid 1px #d6d6c2;margin:0px;padding-top:15px;">
                        <div class="col-md-12 col-xl-12">
                           <table class="table table-bordered">
                        <thead>
                          <tr  style="background-color:#d6d6c2">
                            <th>উপজেলার নাম </th>
                            <th>মোট আগ্রহী আবেদনকারী</th>
                            <th>মোট দক্ষ আবেদনকারী</th>
                            <th>মোট অদক্ষ আবেদনকারী</th>
                            <th>মোট অভিবাসী</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(subdistrict,key) in upazila_data" :key="key">
                           <td>{{subdistrict.upazila_name_eng}}</td>
                           <td>{{getBanglavalue(subdistrict.applied_applicant)}}</td>
                           <td>{{getBanglavalue(subdistrict.skilled_applicant)}}</td>
                           <td>{{getBanglavalue(subdistrict.unskilled_applicant)}}</td>
                           <td>{{getBanglavalue(subdistrict.migrate_applicant)}}</td>
                          </tr>
                        </tbody>
                      </table> 
                        </div>
                    </div>
                </div> -->
                <!-- <button @click="summaryAdmin()">Test</button> -->
                <div id="test"  class="col-md-12 col-xl-12">
                    <table class="table table-bordered">
                        <thead>
                          <tr style="background:#fff;">
                              <td  colspan="4">
                                  <div class="col-md-12">
                                    <div class="row">
                                        <div style="width:35%;">
                                            <span style="font-size:20px;">Selected Applicant: {{getBanglavalue(migration_count)}}</span>
                                        </div>
                                        <!-- <div style="width:20%;">
                                            <multiselect
                                            selectLabel=""
                                            deselectLabel=""
                                            v-model="country"
                                            placeholder="জনবল পাঠানো দেশ"
                                            label="country_name"
                                            track-by="id"
                                            :options="countries"
                                            ></multiselect>
                                        </div> -->
                                        &nbsp;
                                        <div v-if="this.$auth.user.type == 1" style="width:20%;">
                                            <multiselect
                                                selectLabel=""
                                                deselectLabel=""
                                                v-model="agency"
                                                placeholder="Company"
                                                label="name"
                                                track-by="id"
                                                :options="agencies"
                                            ></multiselect>
                                        </div>
                                        &nbsp;
                                        <div style="width:10%;color:#fff;">
                                            <button 
                                            @click="getMigrateApplicant()"
                                            class="btn btn-secondary"
                                            >Search</button>
                                        </div>
                                        &nbsp;
                                        <div style="width:10%">
                                            <button  @click="getPdf()" class="btn btn-success"><i class="fas fa-file-pdf"></i>Export</button>
                                        </div>
                                    </div>
                                </div>
                              </td>
                          </tr>
                          <tr>
                            <th>No </th>
                            <th>Applicant</th>
                            <th>Designation</th>
                            <th>Company</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(post,index) in migrate_applicants.data" :key="index">
                            <td>{{ serial[index] }}</td>
                            <td ><span>{{post.applicant_name}}</span></td>
                            <td ><span style="cursor:pointer" @click="goPost(post.post_slug)">{{post.post_name}}</span></td>
                            <td ><span style="cursor:pointer" @click="goAgency(post.agency_slug)">{{post.agency_name}}</span></td>
                          </tr>
                        </tbody>
                      </table>
                      <pagination :data="migrate_applicants" @pagination-change-page="getMigrateApplicant"></pagination>
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
        mydate:'',
        columnChartData: [
            ['Element', 'Density', { role: 'style' }],
            ['আগ্রহী আবেদনকারী',0, '#b87333'],     
            ['দক্ষ',0, 'silver'],   
            ['অদক্ষ',0, 'green'],
            ['অভিবাসী',0, 'gold']
        ],
        pieChartData: [
          ['Gender', 'Participants'],
          ['পুরুষ',  0],
          ['মহিলা',  0],
          ['অন্যান্য',  0]
        ],
        chartOptions: {
            chart: {
            title: 'Immigration Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017'
            },
            height: "350"
        },
        pieOptions:{
          title: 'Immigration Activities',
          pieHole: 0.4,
          chartArea:{width:350,height:350},
          legend:{}
        },
        demoData:{
            intersested:0,
            skilled:0,
            unskilled:0,
            imigrate:0,
        },
        upazila_data:[],
        favourite_lists:'',
        status:'',
        total_applied_applicant:0,
        applica_result_type:0,
        total_application:0,
        pending_application:0,
        sorted_application:0,
        selected_application:0,
        favourite:0,
        serial:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫'],
        total_post:0,
        total_applicant:0,
        total_agency:0,
        total_training_center:0,
        total_financial_organization:0,
        total_embassy:0,
        total_migrated:0,
        migration_count:0,
        agencies:[],
        countries:[],
        country:'',
        agency:'',
        divisions:[],
        division_id: '',
        district_id: '',
        migrate_applicants:{},
        total2:{
            districts2: [],
            subdistricts2:[],
            unions2:[],
        },
        applicantInfoMainDate:'',
        role_id:'',
        status:'',
        page:1,
        agency_id:'',
        country_id:'',
        districts:[],
        subdistricts:[],
        district:'',
        subdistrict:'',
        division:''
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
    if(this.$auth.user.role_id == 1 || this.$auth.user.role_id == 9){
        this.summaryAdmin();
        this.getAgency();
        this.getMigrateApplicant();
        this.getCountry();
        this.getDivision();
        // this.changeDemoData();
        this.getStatistics();
    }
    else if(this.$auth.user.role_id == 3 ){
        this.summaryAgency();
        this.getCountry();
        this.getMigrateApplicant();
    }
    else if(this.$auth.user.type == 6){
        this.summaryApplicant();
        this.getCountry();
    }
  },
  methods:{
    async getStatistics(){
        var columnChartData = [];
        var pieChartData = [];

        var dis_id = ''
        var subdis_id = ''
        var div_id = ''
        var start_date = ''
        var end_date = ''

        if(this.mydate){
            start_date = this.mydate.start
            end_date   = this.mydate.end
        }

        if(this.district){
           dis_id = this.district.id
        }
        if(this.division){
           div_id = this.division.id
        }
        if(this.subdistrict){
           subdis_id = this.subdistrict.id
        }
       
       await this.$axios.get('api/get/admin-statistics?div_id='+div_id+'&dis_id='+dis_id+'&subdis_id='+subdis_id+'&start_date='+start_date+'&end_date='+end_date).then(response => {
            columnChartData.push(['Element', 'Density', { role: 'style' }])
            columnChartData.push(['আগ্রহী আবেদনকারী',response.data.applied_applicant, '#b87333'])
            columnChartData.push(['দক্ষ', response.data.skilled_applicant, 'silver'])
            columnChartData.push(['অদক্ষ', response.data.unskilled_applicant, 'green'])
            columnChartData.push(['অভিবাসী', response.data.migrate_applicant, 'gold'])

            pieChartData.push(['Gender', 'Participants']);
            pieChartData.push(['পুরুষ', response.data.male]);
            pieChartData.push(['মহিলা', response.data.female]);
            pieChartData.push(['অন্যান্য', response.data.others]);

            this.demoData = {
                intersested:response.data.applied_applicant,
                skilled:response.data.skilled_applicant,
                unskilled:response.data.unskilled_applicant,
                imigrate:response.data.migrate_applicant,
            }
        })
        .catch(error => {

        }); 
        this.columnChartData = columnChartData;
        this.pieChartData    = pieChartData;
    },
    async getSearchData(){
        
        var dis_id = ''
        var subdis_id = ''
        var div_id = ''
        var start_date = ''
        var end_date = ''

        if(this.mydate){
            start_date = this.mydate.start
            end_date   = this.mydate.end
        }

        if(this.district){
           dis_id = this.district.id
        }
        if(this.division){
           div_id = this.division.id
        }
        if(this.subdistrict){
           subdis_id = this.subdistrict.id
        }
        await this.$axios.post('api/get/admin-upazila-statistics',{dis_id,div_id,subdis_id,start_date,end_date}).then(response=>{
            this.upazila_data = response.data;
            this.getStatistics();
        })
    },
    getBanglavalue(a){
        return a;
        if(a == 0){
            return '০';
        }
        var self = this
        var serial = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
        var result = ''
        while(a/10 > 0){
        result = result + serial[(a%10)];
        a = parseInt(a/10)
        }
        var finalresult = result.split("").reverse().join("")
        return finalresult;
    },
    changeDemoData(){
        
        
    },
    async getDivision(){
        await this.$axios.get('api/get-division').then(response => {
              this.divisions = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrict(){
        if (this.division) {
            await this.$axios.get('api/get-district/'+this.division.id).then(response => {
                this.districts = response.data;
            })
            .catch(error => {

            });
        }
        
    },
    async getSubdistrict() {
      if (this.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.district.id)
          .then(response => {
            this.subdistricts = response.data
          })
          .catch(error => {})
      }
    },
    goTo(type){
        this.$router.push('/dashboard/'+type);
    },
    test(){
        alert("ok");
    },
    getPdf(){
      window.open(process.env.LARAVEL_ENDPOINT+'/api/get-migrate-applicant-pdf?page='+this.page+'&type='+this.$auth.user.role_id+'&user='+this.$auth.user.name+'&user_id='+this.$auth.user.id+'&agency_id='+this.agency_id+'&country_id='+this.country_id)
    },
    getMigrateApplicant(page=1){
        this.page = page
        var country_id = ''
        var agency_id = ''
        if(this.agency){
            agency_id = this.agency.id
            this.agency_id = agency_id
        }
        if(this.country){
            country_id = this.country.id
            this.country_id = country_id
        }
        var data = {
            agency_id,
            country_id
        }
        this.$axios.post('api/get/migrate-applicant?page='+page,data).then(response=>{
            this.migrate_applicants = response.data.data
            this.migration_count = response.data.count
        })
    },
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
    summaryAdmin(){
        this.$axios.get('api/get/summary-admin').then(response=>{
            this.total_post = response.data.total_post
            this.total_applicant = response.data.total_applicant
            this.total_agency = response.data.total_agency
            this.total_training_center = response.data.total_training_center
            this.total_financial_organization = response.data.total_financial_organization
            this.total_embassy = response.data.total_embassy
            this.total_migrated = response.data.total_migrated
            // this.total_application = response.data.total
            // this.pending_application = response.data.pending
            // this.sorted_application = response.data.sorted
            // this.selected_application = response.data.selected 
            // this.favourite = response.data.favourite 
        })
    },
    summaryAgency(){
        this.$axios.get('api/get/summary-agency').then(response=>{
            this.total_post = response.data.total_post
            this.total_applied_applicant = response.data.total_applied_applicant
            this.total_migrated = response.data.total_migrated
        })
    },
    getApplicantResult(type,status){
        this.favourite_lists = ''
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
    async getCountry() {
        await this.$axios
          .get('api/get-country')
          .then(response => {
            this.countries = response.data
          })
          .catch(error => {})
      },
      async getAgency() {
        await this.$axios
          .get('api/get-agency')
          .then(response => {
            this.agencies = response.data
          })
          .catch(error => {})
      },
  }
};
</script>
<style>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: #4ed64e;
}

.bg-c-green {
    background: #eeb312;
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

.bg-c-red {
    background: #128897;
}
.bg-c-bb {
    background: #d35267;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    padding: 30px;
    background: #fff;
    border: 1px solid #ccc;
    text-align: center;
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
    padding: 30px;
    background: #fff;
    border: 1px solid #ccc;
}

.order-card i {
    font-size: 16px;
}
.order-card p{
    margin-bottom: 0px !important;
}
.order-card span{
    text-align: center;
    font-size: 40px;
}
.f-left {
    float: left;
    font-size: 22px;
}

.f-right {
    float: right;
}
.table tr>th {
    font-size: 15px;
}
</style>

