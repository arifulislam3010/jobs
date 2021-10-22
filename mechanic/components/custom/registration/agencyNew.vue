<template>
    <div class="row">
        <div class="col-md-6">
            <div class="side_form">
                <div style="width:100%;text-align:center;">
                    <br>
                    <button @click="goApplicantReg()" style="border-radius:0;" class="btn btn-primary">Job Seeker Registration</button> 
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
                    <h4>Employer Registration</h4>
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
                    <div >
                        <span v-if="errors.has('Name') && verify_status" class="validation_message">Name is required</span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label  for="inputPassword" class="labels">Email/ phone<span class="required">*</span></label>
                    <input
                    @keyup="errorRemove2('email','phone')"
                    v-validate="'required'"
                        name="email"
                        class="form-control"
                        type="text"
                        v-model="email"
                    />
                    <div>
                        <span v-if="errors.has('email') && verify_status" class="validation_message">Email/phone required</span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.email"><span v-for="(error,key) in error_message.email" :key="key">{{error}}</span></span></span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.phone"><span v-for="(error,key) in error_message.phone" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputPassword" class="labels">Confirm password<span class="required">*</span></label>
                    <input @keyup="errorRemove('confirm_password')"  name="confirm_password" v-validate="'required'" class="form-control" :type="showConfirmPassword?'text':'password'" v-model="confirm_password" />
                    <span @click="toggleConfirmPassword()"  class="field-icon"><i :class="showConfirmPassword?'fas fa-eye-slash':'fas fa-eye'"></i></span>
                    <div>
                        <span v-if="errors.has('confirm_password') && verify_status" class="validation_message">Confirm Password required</span>
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.confirm_password"><span v-for="(error,key) in error_message.confirm_password" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group ">
                    <label for="inputPassword" class="labels">Job Category<span class="required">*</span></label>
                    <div @click="statusUpdate()">
                        <treeselect  name="desired_job" placeholder="Job category" v-validate="'required'"  v-model="job" :multiple="true" :options="desired_jobs" />
                    </div>
                    <div>
                        <span v-if="errors.has('desired_job') && verify_status" class="validation_message"> Job Category Required</span>
                    </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="form-group ">
                    <label for="inputPassword" class="labels"> দেশ<span class="required">*</span></label>
                    <div  @keyup="statusUpdate()">
                        <treeselect  name="country" v-validate="'required'" placeholder=" দেশ"  v-model="country" :multiple="true" :options="countries" />
                    </div>
                    <div>
                        <span v-if="errors.has('country') && verify_status" class="validation_message"> দেশ প্রয়োজন</span>
                    </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="form-group ">
                    <label for="inputPassword" class="labels">
                        Registration Number
                        <span class="required">*</span>
                    </label>
                    <input
                        @keyup="errorRemove('registration_number')"
                        name="registration_number"
                        class="form-control "
                        v-validate="'required'"
                        type="text"
                        v-model="registration_number"
                    />
                    <div class="">
                        <span v-if="errors.has('registration_number') && verify_status" class="validation_message">Registration number required</span>
                        <span  v-if="error_message" class="validation_message "><span v-if="error_message.registration_number"><span v-for="(error,key) in error_message.registration_number" :key="key">{{error}}</span></span></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label  for="inputPassword" class="labels">Phone<span class="required">*</span></label>
                    <input
                    @keyup="statusUpdate()"
                    v-validate="'required'"
                        name="phone2"
                        class="form-control"
                        type="text"
                        v-model="phone2"
                    />
                    <div class="">
                        <span v-if="errors.has('phone2') && verify_status" class="validation_message">Phone required</span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group ">
                    <label for="inputPassword" class="labels">
                        website
                    </label>
                    <input
                        @keyup="statusUpdate()"
                        name="registration_number"
                        class="form-control"
                        type="text"
                        v-model="website"
                    />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label  for="inputPassword" class="labels">Address<span class="required">*</span></label>
                    <textarea style="color:#000"
                    @keyup="statusUpdate()"
                    v-validate="'required'"
                        name="address"
                        class="form-control"
                        type="text"
                        v-model="address[0].name"
                    />
                    <div>
                        <span v-if="errors.has('address') && verify_status" class="validation_message">Address  Required</span>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <!-- <div class="col-md-10"></div> -->
                        <div class="pull-right">
                            <base-button style="border-radius:0;border:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98)" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i>Submit</base-button>

                            <base-button style="border-radius:0;border:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98)" v-else @click="validate()"  type="primary"  class="my-4">Submit</base-button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>
<script>

import * as VeeValidate from 'vee-validate'
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
      address:[{name:""}],
      registration_number: '',
      phone2: '',
      website:'',
    }
  },
  methods: {
    toggleConfirmPassword(){
      this.showConfirmPassword = !this.showConfirmPassword
    },
    togglePassword(){
      this.showPassword = !this.showPassword
    },
    goAdminReg(){
      this.$router.push('/admin/registration');
    },
    goApplicantReg(){
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
          agency : 'agency',
          name: this.name,
          email: this.email,
          password: this.password,
          confirm_password: this.confirm_password,
          job:this.job,
          country:this.country,
          address:this.address,
          phone2:this.phone2,
          website:this.website,
          registration_number:this.registration_number
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
                  this.address[0].name = ''
                  this.phone2 = ''
                  this.website = '',
                  this.registration_number = ''
                  this.verify_status = false
                }
                
              })
              .catch(error => {
                this.error_message = error.response.data.errors
                this.loader = false;
              })
        } 
    },
    validate2() {
      var self = this
      var data = { email: this.email2 }
      return new Promise((resolve, reject) => {
        this.$axios
          .post('applicant-agency/validation', data)
          .then(response => {
            self.onComplete()
          })
          .catch(error => {
            self.error_message2 = error.response.data.error
            reject(error)
          })
      })
    },
    validate3() {
      var self = this
      var data = { email: this.email }
      return new Promise((resolve, reject) => {
        this.$axios
            .post('applicant-agency/validation', data)
            .then(response => {
              
              if(self.email2) {
                  self.validate2()
                } else {
                  self.onComplete()
                }
            })
            .catch(error => {
              reject(error)
              self.error_message = error.response.data.error
            })
      })
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
  background-image:url('../../../assets/image/agency.jpg');
  background-size:cover;
  height:100%;
  background-position:center
}
</style>
<style>
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