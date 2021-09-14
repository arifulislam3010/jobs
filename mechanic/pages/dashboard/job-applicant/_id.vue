<template>
    <div>
      <div class="col-md-12 mb-2">
        <div class="row ">
          <div style="width:50%">
            <!-- {{$route.name}} -->
              <div v-if="lists2.data" >
                  <b><span v-if="lists2.data.length>0">{{lists2.data[0].post}}</span></b>
                </div>
            </div>
          <div style="width:15%"> 
            <input v-model="name" placeholder="নাম    " type="text" class="form-control">
          </div>
          &nbsp;
          <div style="width:20%">
            <select v-model="status"  class="form-control">
              <option value="">স্ট্যাটাস নির্বাচন করুন</option>
              <option value="1">পেন্ডিং তালিকা</option>
              <option value="2">সর্ট তালিকা</option>
              <option value="10">রিজেক্ট তালিকা</option>
              <option value="3">সাক্ষাৎকার তালিকা</option>
              <option value="4">সিলেক্ট তালিকা</option>
              <option value="111">সমস্ত তালিকা</option>
            </select>
          </div>
          &nbsp;
          <div style="width:5%">
            <button @click="get(1)" class="btn btn-info">সার্চ</button>
          </div>
          &nbsp;
          <div style="width:9%">
            <button  @click="getPdf()" class="btn btn-success"><i class="fas fa-file-pdf"></i> এক্সপোর্ট</button>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12 mx-auto">
            <div>
              <div class="table-responsive mb-0">
                <table class="table table-pricing">
                  <tbody>
                    <tr class="bg-primary">
                      <td>#</td>
                      <!-- <td class="text-white">
                          <b>শিরোনাম</b>
                      </td> -->
                      <td class="text-white">
                          <b>চাকরিপ্রার্থী</b>
                      </td>
                      <!-- <td class="text-white" >
                          <b>এজেন্সির নাম</b>
                      </td> -->
                      <td class="text-white" >
                          <b>স্ট্যাটাস</b>
                      </td>
                      <!-- <td  v-if="$auth.user.type == 3" class="text-white" > -->
                        <td   class="text-white" >
                          <b>ম্যানেজ</b>
                      </td>
                    </tr>
                    <tr style="border-bottom:1px solid #f2f0f0;" v-for="(list,key) in lists2.data" :key="key">
                      <td>{{seria[key]}}</td>
                      <!-- <td>{{list.post}}</td> -->
                      <td>{{list.applicant}}</td>
                      <!-- <td>{{list.agency}}</td> -->
                      <td>
                        <span v-if="list.status == 1">পেন্ডিং</span>
                        <span v-else-if="list.status == 2">সর্ট</span>
                        <span v-else-if="list.status == 3">সাক্ষাৎকার</span>
                        <span v-else-if="list.status == 4">সিলেক্ট</span>
                        <span v-else-if="list.status == 10">রিজেক্ট</span>
                      </td>
                      <!-- <td v-if="$auth.user.type == 3" style="position:absolute;"> -->
                      <td style="position:absolute;">
                        <span style="cursor:pointer" @click="openCvModal(list.applicant_details.id)">বিস্তারিত <span><i class="fa fa-eye"></i></span></span>
                        <b-nav-item-dropdown v-if="$auth.user.type == 3" text="প্রক্রিয়া" right>
                          <b-dropdown-item @click="manageList(1,list.id,key)" href="#">পেন্ডিং তালিকায় যোগ করুন</b-dropdown-item>
                          <b-dropdown-item @click="manageList(2,list.id,key)" href="#">সর্ট তালিকায় যোগ করুন</b-dropdown-item>
                          <b-dropdown-item @click="manageList(10,list.id,key)" href="#">রিজেক্ট তালিকায় যোগ করুন</b-dropdown-item>
                          <b-dropdown-item @click="manageList(3,list.id,key)" href="#">সাক্ষাৎকার তালিকায় যোগ করুন</b-dropdown-item>
                          <b-dropdown-item @click="manageList(4,list.id,key)" href="#">সিলেক্ট তালিকায় যোগ করুন</b-dropdown-item>
                        </b-nav-item-dropdown>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <applicantView ref="applicant_view"></applicantView>
          </div>
          <div class="col-md-12">
            <!-- <button @click="openModal()">Test</button> -->
            <pagination :data="lists2" @pagination-change-page="get"></pagination>
          </div>
        </div>
        <CvView ref="cv_view"></CvView>
    </div>
</template>

<script>
import CvView from "~/components/dashboard/cv";
import applicantView from "~/components/dashboard/applicantView";
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
export default {
  name: "JobPostApplicant",
  middleware: 'sup-agency-admin',
  layout: 'dashboard',
  components:{
    pagination,
    applicantView,
    CvView
  },
  data() {
    return {
      lists:[],
      post_id:'',
      status:'',
      name:'',
      page:1,
      seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
    }
  },
  mounted(){
    this.get();
  },
  computed:{
    ...mapGetters({
      lists2: 'admin/appliedApplicant/lists'
    })
  },
  methods: {
    getPdf(){
      window.open(process.env.LARAVEL_ENDPOINT+'/api/get-applied-applicant-pdf?page='+this.page+'&post_id='+this.$route.params.id+'&post_id='+this.$route.params.id+'&user='+this.$auth.user.name+'&name='+this.name+'&status='+this.status+'&auth_id='+this.$auth.user.id)
    },
    openModal() {
       this.$refs.applicant_view.openModal();
    },
    async manageList(status,id,index){
      await this.$store.dispatch('admin/appliedApplicant/update',{status,id,index})
    },
    async openCvModal(user_id) {
        await this.$axios.get('api/cv?user_id='+user_id).then(response => {
            // console.log(response);
            this.$refs.cv_view.openModal(response.data);
        })
    },
    async get(page=1) {
      this.page = page
      var data = {
        page:page,
        status:this.status,
        post_id:this.$route.params.id,
        name:this.name
      }
      await this.$store.dispatch('admin/appliedApplicant/get',data)
    }
  }
};
</script>
