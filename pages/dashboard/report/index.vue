<template>
    <div class="profile-page">
        <section style="padding-top:0px;" class="section section-skew">
            <div class="row">
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
                        <div style="margin-bottom:14px;" class="col-md-4 ">
                                <select @change="role()"  v-model="role_id" class="form-control">
                                    <option value="">ইউজার টাইপ নির্বাচন করুন</option>
                                    <option value="6">আগ্রহী প্রার্থী</option>
                                    <option value="4">প্রশিক্ষণ ইনস্টিটিউট</option>
                                    <option value="3">এজেন্সি</option>
                                    <option value="5">ফিনান্সিয়াল অর্গানাইজেশন</option>
                                </select>
                        </div>
                        <div style="margin-bottom:14px;" class="col-md-4 ">
                                <select v-model="status" class="form-control">
                                    <option value="">স্ট্যাটাস নির্বাচন করুন</option>
                                    <option value="1">দক্ষ প্রার্থী</option>
                                    <option value="0">অদক্ষ প্রার্থী</option>
                                    <option value="11">অভিবাসী প্রার্থী</option>
                                    <option value="00">অ অভিবাসী প্রার্থী</option>
                                </select>
                        </div>
                        <div style="margin-bottom:14px;"  class="col-md-4">
                            
                            <button :disabled="!role_id" style="padding-left:37px;" type="button" class="btn btn-secondary " @click="getReport()">খোঁজ করুন</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div v-if="role_id == 6">
                        <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>ইমেইল/মোবাইল নম্বর</th>
                            <th>উপজিলা</th>
                            <th>ইউনিয়ন</th>
                            <th>দক্ষ/অদক্ষ</th>
                            <th>অবস্থা</th>
                            <!-- <th>মোট অভিবাসী</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(list,index) in lists.data" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ list.name }}</td>
                            <td>{{ list.email }} <br>{{ list.phone }}</td>
                            <td>{{ list.subdistrict }}</td>
                            <td v-if="list.union">{{ list.union }}</td>
                            <td v-else> --- </td>
                            <td v-if="list.skill_status">দক্ষ</td>
                            <td v-else>অদক্ষ</td>
                            <td v-if="list.migration_status">অভিবাসী</td>
                            <td v-else>অ-অভিবাসী</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div v-if="role_id == 3 || role_id == 4">
                        <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>ইমেইল/মোবাইল নম্বর</th>
                            <th>ঠিকানা</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(list,index) in lists.data" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ list.name }}</td>
                            <td>{{ list.email }} <br>{{ list.phone }}</td>
                            <td  v-if="list.address"><span v-if="list.address.length>0">{{ list.address[0].name }} </span></td>
                            <td v-else></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div v-if="role_id == 5">
                        <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>ইমেইল/মোবাইল নম্বর</th>
                            <th>সার্ভিসের নাম</th>
                            <th>ঠিকানা</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(list,index) in lists.data" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ list.name }}</td>
                            <td>{{ list.email }} <br>{{ list.phone }}</td>
                            <td>{{list.service_name}}</td>
                            <td><span v-if="list.address"></span>{{ list.address[0] }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <pagination :data="this.lists" @pagination-change-page="getReport" :limit="5"></pagination>
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
import pagination from 'laravel-vue-pagination'
export default {
  middleware: 'auth-admin',
  layout: 'dashboard',
  components: {
    VueCtkDateTimePicker,
    Multiselect,
    pagination
  },
  data(){
      return {
          yourValue:'',
          role_id:'',
          status:'',
        divisions:[],
        division_id: {id:''},
        district_id: {id:''},
        total2:{
            districts2: [],
            subdistricts2:[],
            unions2:[],
        },
        applicantInfoMainDate:{start:'',end:''},
      }
  },
  computed: mapGetters({
    lists: 'admin/dashboard/lists',
  }),
  mounted(){
    this.applicantInfoMainDate = this.$route.query.applicantInfoMainDate
    this.district_id = this.$route.query.district
    this.division_id = this.$route.query.division
    this.role_id = this.$route.query.role_id
    this.status = this.$route.query.status

    this.getReport();
    this.getDivision();
  },
  methods:{
    role(){
        this.$store.commit('admin/dashboard/empty')
    },
    getReport(page=1){
       if(!this.applicantInfoMainDate){
           this.applicantInfoMainDate = {start:'',end:''}
       }
       if(!this.division_id){
           this.division_id = {id:''}
       }
       if(!this.district_id){
           this.district_id = {id:''}
       }
      //  if(this.division_id.id == undefined){
      //    alert("ok");
      //  }
       var data = {
            division_id:this.division_id.id,
            district_id:this.district_id.id,
            start_date:this.applicantInfoMainDate.start,
            end_date:this.applicantInfoMainDate.end,
            role_id:this.role_id,
            status:this.status,
            page:page
        }
        this.$store.dispatch('admin/dashboard/getRepot',data)
    },
    report(){
        // this.$router.push({path: this.$route.path, query: { foo: 'bar' }})
        this.$router.push({path: 'dashboard/report', query: { foo: 'bar' }})
    },
    async get () {
      try {
        await this.$store.dispatch('admin/dashboard/get')
      } catch (e) {
        
      }
    },
    async getDistrictByID2() {
        this.district_id = {id:''};
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

