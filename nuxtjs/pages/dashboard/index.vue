<template>
    <div class="profile-page">
        <section style="padding-top:0px;" class="section section-skew">
            <!-- <div class="container">
                <card shadow class="card-profile mt--300" no-body>
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img v-lazy="'/argon/img/theme/team-4-800x800.jpg'" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                                <div class="card-profile-actions py-4 mt-lg-0">
                                    <base-button type="info" size="sm" class="mr-4">Connect</base-button>
                                    <base-button type="default" size="sm" class="float-right">Message</base-button>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Friends</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <h3>Jessica Jones
                                <span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>Bucharest, Romania</div>
                            <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer</div>
                            <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
                        </div>
                        <div class="mt-5 py-5 border-top text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>
                                    <a href="#">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </card>
            </div> -->
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div  class="card bg-c-blue order-card">
                        <p style="font-size:15px;" class="m-b-0">মোট এজেন্সি<span  class="f-right"><i  class="fa fa-credit-card f-left"></i></span></p>
                        <span class="f-left">{{ lists.agency }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div  class="card bg-c-green order-card">
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
                    <div  class="card bg-c-pink order-card">
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
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">আগ্রহী প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.interested}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">দক্ষ প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.skilled}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
                                    <div  class="card2 bg-c-blue order-card" style="height:70px;padding-right:0px;">
                                        <span style="font-size:15px;" class="m-b-0">অদক্ষ প্রার্থী</span><br>
                                        <span class="f-left">{{all_statistics.total_data.unskilled}}</span>
                                    </div>
                                </div>
                                <div style="padding-right:0px;" class="col-md-12 col-xl-12">
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
                    <div class="">
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
// import HotelDatePicker from 'vue-hotel-datepicker'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
import { GChart } from 'vue-google-charts';
import Multiselect from 'vue-multiselect';
export default {
  middleware: 'auth',
  layout: 'dashboard',
  components: {
    // HotelDatePicker,
    VueCtkDateTimePicker,
    GChart,
    Multiselect
  },
  data(){
      return {
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
      }
  },
  computed: mapGetters({
    lists: 'admin/dashboard/lists',
    all_statistics: 'admin/dashboard/all_statistics'
  }),
  mounted(){
    this.get();
    this.getAllStatistics();
    this.getDivision();
  },
  methods:{
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
        this.district_id = '';
        this.$axios
        .get('api/get-district/' + this.division_id.id)
        .then(response => {
          this.total2.districts2 = response.data
        })
        .catch(error => {})
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
    background: #0080ff;
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
</style>

