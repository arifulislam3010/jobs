<template>
  <div style="margin-top:30px;">
    <div class="row">
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            মোবাইল
            <span class="required">*</span>
          </label>
          <input
            name="Phone"
            @keyup="errorRemove"
            class="form-control col-md-8"
            v-validate="'required'"
            type="number"
            v-model="email"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('Phone')" class="validation_message">{{ errors.first('Phone') }}</span>
            <span v-if="error_message" class="validation_message">{{ error_message }}</span>
          </div>
        </div>
        <div class="form-group row">
          <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">
            পাসওয়ার্ড
            <span class="required">*</span>
          </label>
          <input
            style="margin-top:15px;"
            name="Password"
            class="col-md-8 form-control"
            type="password"
            v-validate="'required'"
            v-model="password"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span
              v-if="errors.has('Password')"
              class="validation_message"
            >{{ errors.first('Password') }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4">
        <div v-if="url" class="image_upload logo_upload">
          <span class="removeImage" @click="RemoveImage">X</span>
          <img :src="url" class="fitimage" />
        </div>
        <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
          <p>ছবি বাছাই করুন</p>
          <i class="fas fa-cloud-upload-alt"></i>
          <input
            type="file"
            ref="ImageFile"
            class="file-input"
            style="display: none"
            v-on:change="imageChanged"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            নাম
            <span class="required">*</span>
          </label>
          <input
            name="Name"
            class="form-control col-md-8"
            v-validate="'required'"
            type="text"
            v-model="name"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('Name')" class="validation_message">{{ errors.first('Name') }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">ইমেইল</label>
          <input
           @keyup="errorRemove2"
            style="margin-top:15px;"
            name="email2"
            class="col-md-8 form-control"
            type="email"
            v-model="email2"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="error_message2" class="validation_message">{{ error_message2 }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">নিবন্ধন নম্বর</label>
          <input
            name="Mother name"
            class="col-md-8 form-control"
            type="text"
            v-model="registration_number"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">ওয়েবসাইট</label>
          <input name="Spouse name" class="col-md-8 form-control" type="text" v-model="website" />
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">ঠিকানা</label>
          <input
            name="Address"
            class="form-control col-md-8"
            type="text"
            v-model="address.name"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">সম্বন্ধে</label>
          <textarea v-model="about" class="form-control col-md-8" aria-label="With textarea"></textarea>
        </div>
      </div>
    </div>
    <div class="col-md-12 row">
        <div class="col-md-10"></div>
        <div class="col-md-2 row">
            <button style="margin-left:30px;background-color:#74CE35;color:#fff" @click="validate()" type="button" class="btn "> নিবন্ধন
            </button>
        </div>
      </div>
      <div style="margin-bottom:30px;"></div>
  </div>
</template>

<script>
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Multiselect from 'vue-multiselect'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
import * as VeeValidate from 'vee-validate'
import Vue from 'vue'
Vue.use(VeeValidate)

export default {
  layout: 'default',
  props: [
    'countries',
    'districts',
    'desired_jobs',
    'divisions',
    'training_centers'
  ],
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  data() {
    return {
      error_message: '',
      error_message2: '',
      image: '',
      not_edit_image: 10,
      name: '',
      email: '',
      password: '',
      url: '',
      about: '',
      website: '',
      address: { name: '' },
      registration_number: '',
      email2: ''
    }
  },
  methods: {
    errorRemove() {
      this.error_message = ''
    },
    errorRemove2() {
      this.error_message2 = ''
    },
    onComplete: function() {
      try {
        var data = {
          agency: 'agency',
          image: this.image,
          not_edit_image: this.not_edit_image,
          name: this.name,
          email: this.email,
          password: this.password,
          address: this.address,
          phone: this.phone,
          about: this.about,
          registration_number: this.registration_number,
          website: this.website,
          email2: this.email2
        }
        var self = this
        this.$axios
          .post('applicant-agency/', data)
          .then(response => {
            this.$notify.success({
              title: 'Agency Info',
              message: 'Succesfully Save'
            })
            self.$router.push('/verify/' + response.data.phone)
          })
          .catch(error => {})
      } catch (error) {}
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
      var self = this
      var data = { email: this.email }

      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
        if (result) {
            self.validate3()
            }
          
        })
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