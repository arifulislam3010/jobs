<template>
  <div>
    <div class="row mobile-padding">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            পূর্ণনাম
            <span class="required">*</span>
          </label>
          <input name="name" class="form-control col-md-8" v-validate="'required'" type="text" v-model="name" />
          <span v-if="errors.has('name')" class="col-md-4"></span>
          <span v-if="errors.has('name')" class="validation_message col-md-8"><br>পূর্ণনাম প্রয়োজন</span>
          <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">
            পিতার নাম
            <span class="required">*</span>
          </label>
          <input
            style="margin-top:15px;"
            name="Father_name"
            class="col-md-8 form-control"
            type="text"
            v-validate="'required'"
            v-model="personal.father_name"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('Father_name')" class="validation_message col-md-8"><br>পিতার নাম প্রয়োজন</span>
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
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            মাতার নাম
            <span class="required">*</span>
          </label>
          <input
            name="Mother_name"
            class="col-md-8 form-control"
            type="text"
            v-model="personal.mother_name"
            v-validate="'required'"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('Mother_name')" class="validation_message col-md-8"><br>মাতার নাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">স্বামী/স্ত্রীরনাম</label>
          <input
            name="Spouse name"
            class="col-md-8 form-control"
            type="text"
            v-model="personal.spouse_name"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">জাতীয় পরিচয়পত্র নম্বর</label>
          <input
            @keyup="errorRemove('nid')"
            name="National_ID"
            class="form-control col-md-8"
            type="text"
            v-model="personal.nid"
            v-validate="'required'"
          />
          <span v-if="errors.has('National_ID')" class="col-md-4"></span>
          <span v-if="errors.has('National_ID')" class="validation_message col-md-8"><br>জাতীয় পরিচয়পত্র নম্বর প্রয়োজন</span>
          <span v-if="error_message" class="col-md-4"></span>
          <span style="margin-top:10px;" v-if="error_message" class="validation_message col-md-8"><span v-if="error_message.nid"><span v-for="(error,key) in error_message.nid" :key="key">{{error}}</span></span></span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জন্মস্থান
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:12px;">
              <multiselect
              selectLabel=""
              deselectLabel=""
               v-validate="'required'"
               name="birth"
                style="margin-left:15px;"
                v-model="personal.country_name"
                placeholder="জন্মস্থান"
                label="country_name"
                track-by="id"
                :options="countries"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('birth')" class="validation_message col-md-8"><br>জন্মস্থান প্রয়োজন</span>
        </div>
      </div>
      <div v-if="personal.country_name" class="col-md-5 align-self-center">
        <div v-if="personal.country_name.id !=0" class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            ঠিকানা
            <span class="required">*</span>
          </label>
          <input
            class="form-control col-md-8"
            type="text"
            v-model="personal.foreign_district"
          />
        </div>
        <div  v-if="personal.country_name.id == 18" class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
              selectLabel=""
                deselectLabel=""
              v-validate="'required'"
               name="district"
                style="margin-left:15px;"
                v-model="personal.district"
                placeholder="জেলা"
                label="district_name_eng"
                track-by="id"
                :options="districts"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('district')" class="validation_message col-md-8"><br>জেলা প্রয়োজন</span>
        </div>
      </div>
      <div v-else class="col-md-5 align-self-center">

      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জন্ম তারিখ 
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="margin-left:30px;">
              <a-date-picker @change="bdate" style="width:100%" name="birth_date" v-validate="'required'" placeholder="জন্ম তারিখ" v-model="personal.birth_date"  />
              <!-- <VueCtkDateTimePicker
                v-validate="'required'"
                format="YYYY-MM-DD"
                formatted="ll"
                name="birth_date"
                style="margin-left:18px;"
                v-model="personal.birth_date"
                label="জন্ম তারিখ "
                :only-date="true"
              /> -->
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('birth_date')" class="validation_message col-md-8"><br>জন্ম তারিখ প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            জাতীয়তা
            <span class="required">*</span>
          </label>
          <input
            v-validate="'required'"
            name="Nationality"
            class="form-control col-md-8"
            type="text"
            v-model="personal.nationality"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('Nationality')"  class="validation_message col-md-8"><br>জাতীয়তা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            বৈবাহিক অবস্থা
            <span class="required">*</span>
          </label>
          <select
          name="maritial_status"
           v-validate="'required'"
            class="form-control col-md-8"
            id="exampleFormControlSelect1"
            v-model="personal.marital_status"
          >
            <option value>বৈবাহিক অবস্থা</option>
            <option value="বিবাহিত">বিবাহিত</option>
            <option value="অবিবাহিত">অবিবাহিত</option>
          </select>
          <span class="col-md-4"></span>
          <span  v-if="errors.has('maritial_status')" class="validation_message col-md-8"><br>বৈবাহিক অবস্থা প্রয়োজন</span>
        </div>
      </div>

      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            লিঙ্গ
            <span class="required">*</span>
          </label>
          <select
           name="sex"
            class="form-control col-md-8"
            v-validate="'required'"
            v-model="personal.sex"
          >
            <option value>লিঙ্গ</option>
            <option value="পুরুষ">পুরুষ</option>
            <option value="মহিলা">মহিলা</option>
            <option value="অন্যান্য">অন্যান্য</option>
          </select>
          <span class="col-md-4"></span>
          <span v-if="errors.has('sex')" class="validation_message col-md-8"><br>লিঙ্গ প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            ধর্ম
            <span class="required">*</span>
          </label>
          <select
            name="religion"
            v-validate = "'required'"
            class="form-control col-md-8"
            id="exampleFormControlSelect1"
            v-model="personal.religion"
          >
            <option value>ধর্ম</option>
            <option value="ইসলাম">ইসলাম</option>
            <option value="হিন্দুধর্ম">হিন্দুধর্ম</option>
            <option value="খ্রীষ্টধর্ম">খ্রীষ্টধর্ম</option>
            <option value="বৌদ্ধধর্ম">বৌদ্ধধর্ম</option>
            <option value="অন্যান্য">অন্যান্য</option>
          </select>
          <span class="col-md-4"></span>
          <span v-if="errors.has('religion')" class="validation_message col-md-8"><br>ধর্ম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            কাঙ্খিত চাকুরী
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="margin-left:28px;">
              <treeselect style="width:104%;" name="desire_job" placeholder="কাঙ্খিত চাকুরী" v-validate="'required'"  v-model="personal.job" :multiple="true" :options="desired_jobs" />
              <!-- <a-tree-select
                v-model="personal.job"
                style="width: 104%"
                :tree-data="desired_jobs"
                tree-checkable
                :show-checked-strategy="SHOW_PARENT2"
                placeholder="কাঙ্খিত চাকুরী"
                search-placeholder="কাঙ্খিত চাকুরী"
                v-validate="'required'"
                name="desire_job"
              /> -->
              <!-- <multiselect
                style="margin-left:15px;"
                v-validate="'required'"
                name="desire_job"
                v-model="personal.job"
                tag-placeholder="Add as new job"
                placeholder="কাঙ্খিত চাকুরী"
                label="name"
                track-by="id"
                :options="desired_jobs"
                :multiple="true"
                :taggable="true"
              ></multiselect> -->
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('desire_job')" class="validation_message col-md-8"><br>কাঙ্খিত চাকুরী প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            কাঙ্খিত দেশ
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="margin-left:28px;">
              <treeselect style="width:104%;" name="desire_country" placeholder="কাঙ্খিত দেশ" v-validate="'required'"  v-model="personal.country" :multiple="true" :options="treeData" />
              <!-- <a-tree-select
                  v-model="personal.country"
                  style="width: 104%"
                  :tree-data="treeData"
                  tree-checkable
                  :show-checked-strategy="SHOW_PARENT"
                  placeholder="কাঙ্খিত দেশ"
                  search-placeholder="কাঙ্খিত দেশ"
                  v-validate="'required'"
                  name="desire_country"
                /> -->
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('desire_country')" class="validation_message col-md-8"><br>কাঙ্খিত দেশ প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            উচ্চতা (মিটার)
            <span class="required">*</span>
          </label>
          <input v-validate="'required'" name="height" class="form-control col-md-8" type="text" value="Height" v-model="personal.height" />
          <span class="col-md-4"></span>
          <span v-if="errors.has('height')" class="validation_message col-md-8"><br>উচ্চতা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            ওজন(কেজি)
            <span class="required">*</span>
          </label>
          <input v-validate="'required'" name="weight" class="form-control col-md-8" type="text" v-model="personal.weight" />
          <span class="col-md-4"></span>
          <span v-if="errors.has('weight')" class="validation_message col-md-8"><br>ওজন প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">পুত্রের সংখ্যা</label>
          <input id="firstName" class="form-control col-md-8" type="text" v-model="personal.no_son" />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">কন্যার সংখ্যা</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="personal.no_daughter"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">পাসপোর্ট নম্বর</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            value="Height"
            v-model="personal.passport_no"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">পাসপোর্ট ইস্যু তারিখ</label>
          <div class="col-md-9">
            <div style="margin-left:30px;">
              <a-date-picker @change="pdate" placeholder="পাসপোর্ট ইস্যু তারিখ" style="width:100%" v-model="personal.passport_date"   />
              <!-- <VueCtkDateTimePicker
                style="margin-left:18px;"
                format="YYYY-MM-DD"
                formatted="ll"
                v-model="personal.passport_date"
                label="পাসপোর্ট ইস্যু তারিখ"
                :only-date="true"
              /> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-11">
        <div class="row">
          <div class="col-md-8">
          </div>
          <div class="col-md-4 ">
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
    <div style="height:290px;"></div>
  </div>
</template>
<script>
// import address from "~/components/dashboard/profile/large/address"

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
// import AvatarCropper from "vue-avatar-cropper"
// import 'ant-design-vue/dist/antd.css';
import { TreeSelect } from 'ant-design-vue';
const SHOW_PARENT = TreeSelect.SHOW_PARENT;
const SHOW_PARENT2 = TreeSelect.SHOW_PARENT2;
import Multiselect from 'vue-multiselect'
// import '@riophae/vue-treeselect/dist/vue-treeselect.css'
export default {
  components: {
    Multiselect
  },
  props: ['countries', 'districts', 'desired_jobs','treeData'],
  data() {
    return {
      SHOW_PARENT,
      SHOW_PARENT2,
      error_message:'',
      loader:false,
      validate_status:false,
      image: '',
      not_edit_image: 10,
      name: '',
      personal: {
        name: '',
        father_name: '',
        mother_name: '',
        spouse_name: '',
        nid: '',
        nationality: 'বাংলাদেশী',
        district: '',
        foreign_district:'',
        marital_status: '',
        sex: '',
        religion: '',
        weight: '',
        height: '',
        job: null,
        country:null,
        country_name:'',
        passport_no: '',
        passport_date: '',
        birth_date: '',
        no_son: '',
        no_daughter: ''
      },
      url: '',
    }
  },
  mounted() {
    this.get()
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
        var data = {
          nid:this.personal.nid,
          personal: this.personal,
          image: this.image,
          not_edit_image: this.not_edit_image,
          name: this.name,
          personal_status:1
        }
        this.$axios
          .put('contacts/personal-info', data)
          .then(response => {
            this.loader = false
            this.personal = response.data.personal
            this.$emit('clicked', response.data.progress)
            this.$notify.success({
              title: 'Personal info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {
            this.error_message = error.response.data.errors
            this.loader = false
          })
      }
    },
    get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            if(response.data.personal_status == 1){
              this.personal = response.data.personal
            }
            else{
              this.personal.job = response.data.personal.job
              this.personal.country = response.data.personal.country
            }
            this.$emit('clicked', response.data.progress)
            this.url = response.data.image
            this.name = response.data.name
            //this.not_edit_image = response.data.not_edit_image;
            // console.log(response.data)
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
    }
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
@media only screen and (max-width: 600px) {
  .mobile-padding{
    padding:0px 5px 0px 15px;
  }
}
</style>
