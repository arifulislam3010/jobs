<template>
    <div class="row">
        <div class="col-md-6">
            <div class="side_form">
                <div style="width:100%;text-align:center;">
                    <br>
                    <button @click="goAgencyReg()" style="border-radius:0;" class="btn btn-primary">Employer Registration</button> 
                    <!-- <button @click="goAdminReg()" style="border-radius:0;" class="btn btn-primary">এডমিন রেজিস্ট্রেশন</button> -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="this.verify" class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text"> {{this.verify}}</span>
                        <button type="button" @click="removeNotification" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Job Seeker Registration</h4>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputPassword" class="labels">
                        Name
                        <span class="required">*</span>
                    </label>
                    <input
                        @keyup="statusUpdate()"
                        name="Name"
                        class="form-control"
                        v-validate="'required'"
                        type="text"
                        v-model="name"
                    />
                    <div>
                        <span v-if="errors.has('Name') && verify_status" class="validation_message">Name Required</span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label  for="inputPassword" class="labels">Email/Phone<span class="required">*</span></label>
                    <input
                    @keyup="errorRemove2('email','phone')"
                    v-validate="'required'"
                        name="email"
                        class="form-control"
                        type="text"
                        v-model="email"
                    />
                    <div>
                        <span v-if="errors.has('email') && verify_status" class="validation_message">Email / phone required</span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.email"><span v-for="(error,key) in error_message.email" :key="key">{{error}}</span></span></span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.phone"><span v-for="(error,key) in error_message.phone" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputPassword" class="labels">Password<span class="required">*</span></label>
                    <input
                        @keyup="errorRemove('password')"
                        name="password"
                        class="form-control"
                        :type="showPassword?'text':'password'"
                        v-validate="'required'"
                        v-model="password"
                    />
                    <span @click="togglePassword()"  class="field-icon"><i :class="showPassword?'fas fa-eye-slash':'fas fa-eye'"></i></span>
                    <div>
                        <span v-if="errors.has('password') && verify_status" class="validation_message">Password required</span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.password"><span v-for="(error,key) in error_message.password" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group ">
                    <label for="inputPassword" class=" labels">Confirm Password<span class="required">*</span></label>
                    <input @keyup="errorRemove('confirm_password')"  name="confirm_password" v-validate="'required'" class="form-control" :type="showConfirmPassword?'text':'password'" v-model="confirm_password" />
                    <span @click="toggleConfirmPassword()"  class="field-icon"><i :class="showConfirmPassword?'fas fa-eye-slash':'fas fa-eye'"></i></span>
                    <div >
                        <span v-if="errors.has('confirm_password') && verify_status" class="validation_message">Confirm password required</span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.confirm_password"><span v-for="(error,key) in error_message.confirm_password" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputPassword" class="labels">বিভাগ<span class="required">*</span></label>
                      <div>
                          <multiselect
                            selectLabel=""
                            deselectLabel=""
                            v-validate="'required'"
                            name = "division"
                            @input="getDistrictByID2()"
                            v-model="address2.division"
                            placeholder="বিভাগ"
                            label="division_name_eng"
                            track-by="id"
                            :options="divisions"
                          ></multiselect>
                        </div>
                      <div>
                          <span v-if="errors.has('division') && verify_status" class="validation_message">বিভাগ প্রয়োজন</span>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputPassword" class="labels">জেলা<span class="required">*</span></label>
                      <div>
                          <multiselect
                              selectLabel=""
                              deselectLabel=""
                              v-validate="'required'"
                              name = "district"
                              v-model="address2.district"
                              @input="getSubdistrict2()"
                              placeholder="জেলা"
                              label="district_name_eng"
                              track-by="id"
                              :options="total2.districts2"
                            ></multiselect>
                        </div>
                      <div>
                          <span v-if="errors.has('district') && verify_status" class="validation_message">জেলা প্রয়োজন</span>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputPassword" class="labels">উপজেলা<span class="required">*</span></label>
                      <div>
                          <multiselect
                            selectLabel=""
                            deselectLabel=""
                            v-validate="'required'"
                            name = "sub_district"
                            v-model="address2.subdistrict"
                            @input="getUnion2()"
                            placeholder="উপজেলা"
                            label="upazila_name_eng"
                            track-by="id"
                            :options="total2.subdistricts2"
                          ></multiselect>
                        </div>
                      <div>
                          <span v-if="errors.has('district2') && verify_status" class="validation_message">উপজেলা প্রয়োজন</span>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="inputPassword" class="labels">ওয়ার্ড/ ইউনিয়ন<span class="required">*</span></label>
                      <div>
                          <multiselect
                            selectLabel=""
                            deselectLabel=""
                            v-validate="'required'"
                            name = "union"
                            v-model="address2.union"
                            placeholder="ওয়ার্ড/ ইউনিয়ন"
                            label="union_name_eng"
                            track-by="id"
                            :options="total2.unions2"
                          ></multiselect>
                        </div>
                      <div>
                          <span v-if="errors.has('union') && verify_status" class="validation_message">ওয়ার্ড/ ইউনিয়ন প্রয়োজন</span>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputPassword" class="labels">কাঙ্খিত চাকুরী<span class="required">*</span></label>
                    <div  @click="statusUpdate()">
                        <treeselect  name="desired_job" placeholder="কাঙ্খিত চাকুরী" v-validate="'required'"  v-model="job" :multiple="true" :options="desired_jobs" />
                    </div>
                    <div>
                        <span v-if="errors.has('desired_job') && verify_status" class="validation_message">কাঙ্খিত চাকুরী প্রয়োজন</span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputPassword" class="labels">কাঙ্খিত দেশ<span class="required">*</span></label>
                    <div  @keyup="statusUpdate()">
                        <treeselect  name="country" v-validate="'required'" placeholder="কাঙ্খিত দেশ"  v-model="country" :multiple="true" :options="countries" />
                    </div>
                    <div >
                        <span v-if="errors.has('country') && verify_status" class="validation_message">কাঙ্খিত দেশ প্রয়োজন</span>
                    </div>
                    </div>
                </div> -->
                <div class="col-md-12 ">
                    <div class="pull-right">
                        <base-button style="border-radius:0;border:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98)" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i>Submit</base-button>

                        <base-button style="border-radius:0;border:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98)" v-else @click="validate()"  type="primary"  class="my-4">Submit</base-button>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-12">
            <div style="height:150px;"></div>
        </div>
    </div>
</template>
<script>

import * as VeeValidate from 'vee-validate'
import Multiselect from 'vue-multiselect'
import Vue from 'vue'
Vue.use(VeeValidate)
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
export default {
  layout: 'default',
  props: [
    'countries',
    'desired_jobs',
  ],
  components: {
    Multiselect
  },
  data() {
    return {
      showConfirmPassword:false,
      showPassword:false,
      job:null,
      country:null,
      validate_status:false,
      verify_status:true,
      verify:null,
      loader:false,
      error_message: '',
      error_message2 :'',
      image: '',
      not_edit_image: 10,
      name: '',
      email: '',
      password: '',
      confirm_password: '',
      url: '',
      about: '',
      website: '',
      address:[{name:""}],
      registration_number: '',
      email2: null,
      divisions:[],
      same_address: true,
      address2: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      address3: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      total2: {
        districts2: [],
        subdistricts2: [],
        unions2: []
      },
    }
  },
  mounted(){
    this.getDivision();
  },
  methods: {
    async getDivision(){
        this.$axios.get('api/get-division').then(response => {
          this.divisions = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrictByID2() {
      if (this.address2.division) {
        this.$axios
          .get('api/get-district/' + this.address2.division.id)
          .then(response => {
            this.total2.districts2 = response.data
            this.total2.subdistricts2 = []
            this.total2.unions2 = []
            this.address2.district = ''
            this.address2.subdistrict = ''
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    async getSubdistrict2() {
      if (this.address2.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.address2.district.id)
          .then(response => {
            this.total2.subdistricts2 = response.data
            this.address2.subdistrict = ''
            this.total2.unions2 = []
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    async getUnion2() {
      if (this.address2.subdistrict) {
        this.$axios
          .get('api/get-union/' + this.address2.subdistrict.id)
          .then(response => {
            this.total2.unions2 = response.data
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    toggleConfirmPassword(){
      this.showConfirmPassword = !this.showConfirmPassword
    },
    togglePassword(){
      this.showPassword = !this.showPassword
    },
    goAdminReg(){
      this.$router.push('/admin/registration');
    },
    goAgencyReg(){
      this.$emit('switchReg');
    },
    removeNotification(){
      this.verify = null;
    },
    errorRemove(field) {
      delete this.error_message[field];
      this.verify_status = true
    },
    errorRemove2(field1,field2){
      delete this.error_message[field1];
      delete this.error_message[field2];
      this.verify_status = true
    },
    statusUpdate(){
      this.verify_status = true
    },
    onComplete: function() {
        this.verify = null;
        var data = {
          applicant : 'applicant',
          name: this.name,
          email: this.email,
          password: this.password,
          confirm_password: this.confirm_password,
          job:this.job,
          country:this.country,
          same_address:this.same_address,
          address2:this.address2,
          address3:this.address3
        }
        if(this.validate_status){
          this.loader = true;
            var self = this
            this.$axios
              .post('applicant-agency', data)
              .then(response => {
                this.loader = false;
                if(response.data.phone){
                  self.$router.push('/verify/' + response.data.phone)
                }
                if(response.data.verify){
                  this.verify = response.data.verify;
                  this.name = ''
                  this.email = ''
                  this.password = ''
                  this.confirm_password = ''
                  this.job = null
                  this.country = null
                  this.verify_status = false
                  this.total2.districts2 = []
                  this.total2.subdistricts2 = []
                  this.total2.unions2 = []
                  this.address2.division = ''
                  this.address2.district = ''
                  this.address2.subdistrict = ''
                  this.address2.union = ''
                }
                
              })
              .catch(error => {
                this.error_message = error.response.data.errors
                this.loader = false;
              })
        } 
    },
    
    validate() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.validate_status = true;
          this.onComplete();
        }
        else{
          this.validate_status = false;
        }
      })
    },
    imageChanged(e) {
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = e => {
        this.image = e.target.result
        this.not_edit_image = 11
      }
      this.url = URL.createObjectURL(e.target.files[0])
    },
    RemoveImage: function() {
      this.image = ''
      this.not_edit_image = 10
      this.url = ''
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.required {
  color: red;
}
.logo_upload {
  border: 1px solid #ccc;
  width: 90%;
  height: 100px;
  background: #eceef0;
  text-align: center;
  cursor: pointer;
  margin-left: 45px;
}
.image_upload p {
  margin-top: 10px;
  font-size: 12px;
}

.image_upload i {
  font-size: 34px;
}
.removeImage {
  position: absolute;
  right: 13px;
  top: 14px;
  color: var(--white);
  border: 1px solid;
  border-radius: 25px;
  padding: 4px 8px;
  background-color: #fb1212f5;
  font-size: 10px;
  font-family: cursive;
}
.fitimage {
  width: 32%;
  height: 100%;
  -o-object-fit: contain;
  object-fit: contain;
  background-color: #e6e6ef;
}
.field-icon {
  float: right;
  margin-right: 3%;
  margin-top: -30px;
  position: relative;
  z-index: 2;
  cursor: pointer;
}
.side_form{
  background-image:url('../../../assets/image/unnamed.jpg');
  background-size:cover;height:100%;
  background-position:center
}
</style>
<style>
  .multiselect__tags{
    border-radius: 0px;
    height: 42px;
  }
  .vue-treeselect__control{
    /* padding: 10px; */
    border-radius: 0px;
  }
  .form-control{
    height: 42px;
    border-radius: 0px;
  }
  input[type=text]:focus {
    color: #000;
  }
  input[type=text] {
    color: #000;
  }
  input[type=password]:focus {
    color: #000;
  }
  input[type=password] {
    color: #000;
  }
</style>