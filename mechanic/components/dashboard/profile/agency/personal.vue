<template>
  <div>
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
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label  for="inputPassword" class="col-md-4 labels">ফোন<span class="required">*</span></label>
          <input
           v-validate="'required'"
            name="phone2"
            class="col-md-8 form-control"
            type="text"
            v-model="phone2"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('phone2')" class="validation_message">ফোন প্রয়োজন</span>
          </div>
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
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <multiselect
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
      <div  class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            উপজেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
              <multiselect
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
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-3 labels"> যেসব চাকুরীতে লোক পাঠানো<span class="required">*</span></label>
          <div class="col-md-9 ">
            <treeselect style="margin-left:7%;width:98%;" name="desired_job" placeholder=" চাকুরী" v-validate="'required'"  v-model="job" :multiple="true" :options="desired_jobs" />
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('desired_job') " class="validation_message"> চাকুরী প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-3 labels"> যেসব দেশে লোক পাঠানো হয়<span class="required">*</span></label>
          <div class="col-md-9 ">
            <treeselect style="margin-left:7%;width:98%;" name="country" v-validate="'required'" placeholder=" দেশ"  v-model="country" :multiple="true" :options="treeData" />
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('country') " class="validation_message"> দেশ প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
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
            <span v-if="errors.has('registration_number')" class="validation_message">রেজিস্ট্রেশন নম্বর প্রয়োজন</span>
            <span  v-if="error_message" class="validation_message col-md-8"><span v-if="error_message.registration_number"><span v-for="(error,key) in error_message.registration_number" :key="key">{{error}}</span></span></span>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            ওয়েবসাইট
          </label>
          <input
            name="website"
            class="form-control col-md-8"
            type="text"
            v-model="website"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            গুগল ম্যাপ লিঙ্ক
          </label>
          <input
            name="map_link"
            class="form-control col-md-8"
            type="text"
            v-model="map_link"
          />
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label  for="inputPassword" class="col-md-4 labels">ঠিকানা<span class="required">*</span></label>
          <textarea
           v-validate="'required'"
            name="address"
            class="col-md-8 form-control"
            type="text"
            v-model="address[0].name"
          />
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <span v-if="errors.has('address')" class="validation_message">ঠিকানা প্রয়োজন</span>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <div class="row ">
          <label   class="col-md-2 labels">আমাদের সমন্ধে</label>
          <div class="col-md-12 labels">
              <ckeditor v-model="about"></ckeditor>
          </div>
        </div>
      </div>
        <div class="col-md-11">
        <div class="row">
          <div class="col-md-8">
          </div>
          <div class="col-md-4 ">
            <br>
            <br>
            <button style="background-color:#75ab28;float:right" v-if="loader"  type="button" class="btn btn-primary btn-md">
              <i class="fa fa-cog fa-spin"></i> আপডেট
            </button>
            <button style="background-color:#75ab28;float:right" v-else @click="validate()" type="button" class="btn btn-primary btn-md">
              আপডেট
            </button>
          </div>
        </div>
      </div>
    </div>
    <div style="height:30px;"></div>
  </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect'
export default {
  props: ['desired_jobs','treeData'],
  components:{
    Multiselect
  },
  data() {
    return {
      loader:false,
      validate_status:false,
      error_message:'',
      map_link:'',
      name:'',
      website:'',
      address:[{name:""}],
      country:null,
      job:null,
      registration_number:'',
      phone2:'',
      about:'',
      divisions:[],
      districts:[],
      subdistricts:[],
      division:'',
      district:'',
      subdistrict:'',
      division_id:'',
      district_id:'',
      subdistrict_id:''
    }
  },
  mounted() {
    this.get()
    this.getDivision()
  },
  methods: {
    errorRemove(field) {
      delete this.error_message[field];
    },
    bdate(value, dateString){
      this.personal.birth_date = dateString;
    },
    pdate(value, dateString){
      this.personal.passport_date = dateString;
    },
    validate(){
      this.$validator.validateAll().then(result => {
        if(result){
          this.validate_status = true;
          this.saveData();
        }
        else{
          this.validate_status = false;
        }
      })
    },
    saveData() {
      if(this.validate_status){
        this.loader = true
        if(this.subdistrict){
          this.subdistrict_id = this.subdistrict.id
        }
        if(this.district){
          this.district_id = this.district.id
        }
        if(this.division){
          this.division_id = this.division.id
        }
        var data = {
          personal: {
            job:this.job,
            country:this.country
          },
          name:this.name,
          website:this.website,
          address:this.address,
          registration_number:this.registration_number,
          phone2:this.phone2,
          about:this.about,
          map_link:this.map_link,
          division:this.division,
          district:this.district,
          subdistrict:this.subdistrict,
          subdistrict_id:this.subdistrict_id,
          district_id:this.district_id,
          division_id:this.division_id
        }
        this.$axios
          .put('contacts/basic-info', data)
          .then(response => {
            this.loader = false
            this.$notify.success({
              title: 'Personal info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {
            this.loader = false
            this.error_message = error.response.data.errors
          })
      }
    },
    async get() {
      try {
        await this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            this.job = response.data.personal.job
            this.country = response.data.personal.country
            this.name = response.data.name
            this.website = response.data.website
            this.address = response.data.address
            this.registration_number = response.data.registration_number
            this.phone2 = response.data.contact_number
            this.about = response.data.about
            this.map_link = response.data.map_link
            if(response.data.address2){
              this.division    = response.data.address2.division
              this.district    = response.data.address2.district
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
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
  .vue-treeselect__control{
    padding: 10px;
  }
</style>
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
  margin-left: 50px;
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
.ant-input{
  width: 104%;
  padding: 20px;
}
.ant-select-selection--multiple .ant-select-selection__rendered {
    height: auto;
    margin-bottom: 0px;
    margin-left: 5px;
    padding: 5px;
}
</style>