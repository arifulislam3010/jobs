<template>
  <div style="margin-top:30px;">
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
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            Name
            <span class="required">*</span>
          </label>
          <input
            @keyup="statusUpdate()"
            name="Name"
            class="form-control col-md-8"
            v-validate="'required'"
            type="text"
            v-model="name"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('Name') && verify_status" class="validation_message">নাম প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label  for="inputPassword" class="col-md-4 labels">ইমেইল/মোবাইল<span class="required">*</span></label>
          <input
           @keyup="errorRemove2('email','phone')"
           v-validate="'required'"
            name="email"
            class="col-md-8 form-control"
            type="text"
            v-model="email"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('email') && verify_status" class="validation_message">ইমেইল/মোবাইল প্রয়োজন</span>
            <span v-if="error_message" class="validation_message"><span v-if="error_message.email"><span v-for="(error,key) in error_message.email" :key="key">{{error}}</span></span></span>
            <span v-if="error_message" class="validation_message"><span v-if="error_message.phone"><span v-for="(error,key) in error_message.phone" :key="key">{{error}}</span></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">পাসওয়ার্ড<span class="required">*</span></label>
          <input
            @keyup="errorRemove('password')"
            name="password"
            class="col-md-8 form-control"
            type="password"
            v-validate="'required'"
            v-model="password"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('password') && verify_status" class="validation_message">পাসওয়ার্ড প্রয়োজন</span>
            <span v-if="error_message" class="validation_message"><span v-if="error_message.password"><span v-for="(error,key) in error_message.password" :key="key">{{error}}</span></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">কনফার্ম পাসওয়ার্ড<span class="required">*</span></label>
          <input @keyup="errorRemove('confirm_password')"  name="confirm_password" v-validate="'required'" class="col-md-8 form-control" type="password" v-model="confirm_password" />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('confirm_password') && verify_status" class="validation_message">কনফার্ম পাসওয়ার্ড প্রয়োজন</span>
            <span v-if="error_message" class="validation_message"><span v-if="error_message.confirm_password"><span v-for="(error,key) in error_message.confirm_password" :key="key">{{error}}</span></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-3 labels"> চাকুরী ক্যাটাগরি<span class="required">*</span></label>
          <div class="col-md-9 " @click="statusUpdate()">
            <treeselect style="margin-left:7%;width:98%;" name="desired_job" placeholder=" চাকুরী" v-validate="'required'"  v-model="job" :multiple="true" :options="desired_jobs" />
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('desired_job') && verify_status" class="validation_message"> চাকুরী  ক্যাটাগরি প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-3 labels"> দেশ<span class="required">*</span></label>
          <div class="col-md-9 " @keyup="statusUpdate()">
            <treeselect style="margin-left:7%;width:98%;" name="country" v-validate="'required'" placeholder=" দেশ"  v-model="country" :multiple="true" :options="countries" />
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('country') && verify_status" class="validation_message"> দেশ প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            রেজিস্ট্রেশন নম্বর
            <span class="required">*</span>
          </label>
          <input
            @keyup="errorRemove('registration_number')"
            name="registration_number"
            class="form-control col-md-8"
            v-validate="'required'"
            type="text"
            v-model="registration_number"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('registration_number') && verify_status" class="validation_message">রেজিস্ট্রেশন নম্বর প্রয়োজন</span>
            <span  v-if="error_message" class="validation_message col-md-8"><span v-if="error_message.registration_number"><span v-for="(error,key) in error_message.registration_number" :key="key">{{error}}</span></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label  for="inputPassword" class="col-md-4 labels">ফোন<span class="required">*</span></label>
          <input
           @keyup="statusUpdate()"
           v-validate="'required'"
            name="phone2"
            class="col-md-8 form-control"
            type="text"
            v-model="phone2"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('phone2') && verify_status" class="validation_message">ফোন প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            ওয়েবসাইট
          </label>
          <input
            @keyup="statusUpdate()"
            name="registration_number"
            class="form-control col-md-8"
            type="text"
            v-model="website"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label  for="inputPassword" class="col-md-4 labels">ঠিকানা<span class="required">*</span></label>
          <textarea
           @keyup="statusUpdate()"
           v-validate="'required'"
            name="address"
            class="col-md-8 form-control"
            type="text"
            v-model="address[0].name"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('address') && verify_status" class="validation_message">ঠিকানা প্রয়োজন</span>
          </div>
        </div>
      </div>
    <div class="col-md-12 ">
        <div class="row">
          <div class="col-md-10">
          </div>
            <div class="col-md-2">
                <base-button style="background-color:rgba(117, 171, 40, 0.98)" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> নিবন্ধন</base-button>

                <base-button style="background-color:rgba(117, 171, 40, 0.98)" v-else @click="validate()"  type="primary"  class="my-4">নিবন্ধন</base-button>
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
</style>
<style>
  .vue-treeselect__control{
    padding: 10px;
  }
</style>