<template>
  <div style="margin-top:30px;">
    <div class="row">
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
            <span v-if="errors.has('Name')" class="validation_message">নাম প্রয়োজন</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">সার্ভিসের নাম</label>
          <input name="Spouse name" class="col-md-8 form-control" type="text" v-model="service_name" />
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4">
        <div v-if="url" class="image_upload logo_upload">
          <span class="removeImage" @click="RemoveImage">X</span>
          <img :src="url" class="fitimage" />
        </div>
        <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
          <p>প্রোফাইল পিকচার বাছাই করুন</p>
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
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            বিভাগ
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <multiselect
                selectLabel=""
                deselectLabel=""
                v-validate="'required'"
                name = "division"
                style="margin-left:7%;width:98%;"
                @input="getDistrictByID()"
                v-model="division"
                placeholder="বিভাগ"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('division') " class="validation_message col-md-8"><br>বিভাগ প্রয়োজন</span>
        </div>
      </div>
      <div v-if="designation_id == 2 || designation_id == 1" class="col-md-1"></div>
      <div v-if="designation_id == 2 || designation_id == 1" class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <multiselect
                selectLabel=""
                deselectLabel=""
                style="margin-left:7%;width:98%;"
                v-validate="'required'"
                name = "district"
                v-model="district"
                @input="getSubdistrict()"
                placeholder="জেলা"
                label="district_name_eng"
                track-by="id"
                :options="districts"
              ></multiselect>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('district') " class="validation_message col-md-8"><br>জেলা প্রয়োজন</span>
        </div>
      </div>
      <div  class="col-md-1" ></div>
      <div v-if="designation_id == 2" class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            উপজেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <multiselect
                selectLabel=""
                deselectLabel=""
                v-validate="'required'"
                name = "sub_district"
                style="margin-left:7%;width:98%;"
                v-model="subdistrict"
                placeholder="উপজেলা"
                label="upazila_name_eng"
                track-by="id"
                :options="subdistricts"
              ></multiselect>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('sub_district') " class="validation_message col-md-8"><br>উপজেলা প্রয়োজন</span>
        </div>
      </div>
      <div v-if="designation_id == 2" class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-3 labels">পদবি<span class="required">*</span></label>
          <div class="col-md-9">
              <multiselect
                @input="designationSelect"
                name="designation"
                v-validate="'required'"
                style="margin-left:7%;width:98%;"
                v-model="designation"
                placeholder="পদবি"
                label="name"
                track-by="id"
                :options="designations"
              ></multiselect>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-8">
              <span v-if="errors.has('designation')" class="validation_message">পদবি প্রয়োজন</span>
          </div>
        </div>
    </div>
    <div v-if="designation_id != 2" class="col-md-1"></div>
    <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">ওয়েবসাইট</label>
          <input name="Spouse name" class="col-md-8 form-control" type="text" v-model="website" />
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
            <base-button style="background-color:rgba(117, 171, 40, 0.98);margin-left:45px;" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> আপডেট</base-button>

            <base-button style="background-color:rgba(117, 171, 40, 0.98);margin-left:45px;" v-else @click="validate()"  type="primary"  class="my-4">আপডেট</base-button>
        </div>
      </div>
      <div style="margin-bottom:30px;"></div>
  </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import * as VeeValidate from 'vee-validate'
import Vue from 'vue'
Vue.use(VeeValidate)
import Multiselect from 'vue-multiselect'
export default {
  layout: 'default',
  components:{
    Multiselect
  },
  data() {
    return {
      verify_status:false,
      loader:false,
      image: '',
      not_edit_image: 10,
      name: '',
      url: '',
      about: '',
      website: '',
      address:[{name:""}],
      registration_number: '',
      service_name:'',
      service_url:'',
      designations:[],
      designation:'',
      designation_id:'',
      divisions:[],
      districts:[],
      subdistricts:[],
      division:'',
      district:'',
      subdistrict:'',
      division_id:'',
      district_id:'',
      subdistrict_id:'',
    }
  },
  methods: {
    designationSelect(){
      if(this.designation){
        this.designation_id = this.designation.id
      }
    },
    async getDesignation() {
      this.$axios
        .get('api/get-designation')
        .then(response => {
          this.designations = response.data
        })
        .catch(error => {})
    },
    validate(){
      this.$validator.validateAll().then(result => {
        if(result){
          this.verify_status = true
        }
        else{
          this.verify_status = false
        }
        this.saveData();
      })
    },
    saveData() {
      if(this.verify_status){
        this.loader = true
        if(this.designation_id == 1){
          this.subdistrict = '',
          this.subdistrict_id = ''
        }
        if(this.subdistrict){
          this.subdistrict_id = this.subdistrict.id
        }
        if(this.district){
          this.district_id = this.district.id
        }
        if(this.division){
          this.division_id = this.division.id
        }
        try {
          var data = {
            user_id: this.$auth.user.id,
            image: this.image,
            not_edit_image: this.not_edit_image,
            name: this.name,
            about: this.about,
            website: this.website,
            address: this.address,
            registration_number: this.registration_number,
            service_name: this.service_name,
            service_url: this.service_url,
            personal: this.designation,
            designation_id:this.designation_id,
            division:this.division,
            district:this.district,
            subdistrict:this.subdistrict,
            division_id:this.division_id,
            district_id:this.division_id,
            subdistrict_id:this.subdistrict_id,
          }
          this.$axios
            .put('contacts', data)
            .then(response => {
              this.loader = false;
              this.$notify.success({
                title: 'Profile',
                message: 'Succesfully Update'
              })
            })
            .catch(error => {})
        } catch (error) {}
      }
    },
   get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            this.url = response.data.image
            this.name = response.data.name
            this.about = response.data.about
            this.website = response.data.website
            this.registration_number = response.data.registration_number
            this.service_name = response.data.service_name
            this.service_url = response.data.service_url
            this.designation = response.data.personal
            if(this.designation){
              this.designation_id = this.designation.id
            }
            if(response.data.address2){
              this.division = response.data.address2.division
              this.district = response.data.address2.district
              this.subdistrict = response.data.address2.subdistrict
              this.getDistrictByID2();
              this.getSubdistrict2();
            }
          })
          .catch(error => {})
      } catch (error) {}
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
    },
    async getDivision(){
        this.$axios.get('api/get-division').then(response => {
          this.divisions = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrictByID() {
      if (this.division) {
        this.$axios
          .get('api/get-district/' + this.division.id)
          .then(response => {
            this.district = ''
            this.districts = response.data
            this.subdistricts = []
            this.subdistrict = ''
          })
          .catch(error => {})
      }
    },
    async getSubdistrict() {
      if (this.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.district.id)
          .then(response => {
            this.subdistrict = ''
            this.subdistricts = response.data
          })
          .catch(error => {})
      }
    },
    async getDistrictByID2() {
      if (this.division) {
        this.$axios
          .get('api/get-district/' + this.division.id)
          .then(response => {
            this.districts = response.data
          })
          .catch(error => {})
      }
    },
    async getSubdistrict2() {
      if (this.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.district.id)
          .then(response => {
            this.subdistricts = response.data
          })
          .catch(error => {})
      }
    },
  },
  mounted(){
    this.get()
    this.getDesignation()
    this.getDivision()
  }
}
</script>
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
  margin-left: 14%;
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