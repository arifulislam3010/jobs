<template>
  <div class="container card">
    <div style="margin-top:10px;">
        <div class="row">
            <div class="col-md-12">
                <div style="background:#eceef0;padding:10px;text-align:center;font-size:20px;margin-bottom:15px;">
                    <span>এডমিন রেজিস্ট্রেশন</span>
                </div>
            </div>
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
                    নাম
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
                <label  for="inputPassword" class="col-md-4 labels">ইমেইল<span class="required">*</span></label>
                <input
                @keyup="errorRemove('email')"
                v-validate="'required'"
                    name="email"
                    class="col-md-8 form-control"
                    type="text"
                    v-model="email"
                />
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <span v-if="errors.has('email') && verify_status" class="validation_message">ইমেইল প্রয়োজন</span>
                    <span v-if="error_message" class="validation_message"><span v-if="error_message.email"><span v-for="(error,key) in error_message.email" :key="key">{{error}}</span></span></span>
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
                <label for="inputPassword" class="col-md-3 labels">পদবি<span class="required">*</span></label>
                <div class="col-md-9">
                    <multiselect
                      selectLabel=""
                      deselectLabel=""
                      @input="designationSelect()"
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
                    <span v-if="errors.has('designation') && verify_status" class="validation_message">পদবি প্রয়োজন</span>
                </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <!-- <div class="col-md-5">
                <div class="form-group row">
                <label for="inputPassword" class="col-md-4 labels">
                    কর্মস্থল
                    <span class="required">*</span>
                </label>
                <input
                    @keyup="statusUpdate()"
                    name="workplace"
                    class="form-control col-md-8"
                    v-validate="'required'"
                    type="text"
                    v-model="address[0].name"
                />
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <span v-if="errors.has('workplace') && verify_status" class="validation_message">কর্মস্থল প্রয়োজন</span>
                </div>
                </div>
            </div> -->
            <div class="col-md-5 align-self-center">
              <div class="form-group row">
                <label class="labels col-md-3" for="#firstName">
                  বিভাগ
                  <span class="required">*</span>
                </label>
                <div class="col-md-9">
                  <div style="padding-left:6px;">
                    <multiselect
                      selectLabel=""
                      deselectLabel=""
                      v-validate="'required'"
                      name = "division"
                      style="margin-left:15px;"
                      @input="getDistrictByID()"
                      v-model="division"
                      placeholder="বিভাগ"
                      label="division_name_eng"
                      track-by="id"
                      :options="divisions"
                    ></multiselect>
                  </div>
                </div>
                <span class="col-md-4"></span>
                <span v-if="errors.has('division') && verify_status" class="validation_message col-md-8"><br>বিভাগ প্রয়োজন</span>
              </div>
            </div>
            <div v-if="designation_id == 1 || designation_id == 2" class="col-md-1"></div>
            <div v-if="designation_id == 1 || designation_id == 2" class="col-md-5 align-self-center">
              <div class="form-group row">
                <label class="labels col-md-3" for="#firstName">
                  জেলা
                  <span class="required">*</span>
                </label>
                <div class="col-md-9">
                  <div style="padding-left:6px;">
                    <multiselect
                      selectLabel=""
                      deselectLabel=""
                      style="margin-left:15px;"
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
                </div>
                <span class="col-md-4"></span>
                <span v-if="errors.has('district') && verify_status" class="validation_message col-md-8"><br>জেলা প্রয়োজন</span>
              </div>
            </div>
            <div class="col-md-1" ></div>
            <div v-if="designation_id == 2" class="col-md-5 align-self-center">
              <div class="form-group row">
                <label class="labels col-md-3" for="#firstName">
                  উপজেলা
                  <span class="required">*</span>
                </label>
                <div class="col-md-9">
                  <div style="padding-left:6px;">
                    <multiselect
                      selectLabel=""
                      deselectLabel=""
                      v-validate="'required'"
                      name = "sub_district"
                      style="margin-left:15px;"
                      v-model="subdistrict"
                      placeholder="উপজেলা"
                      label="upazila_name_eng"
                      track-by="id"
                      :options="subdistricts"
                    ></multiselect>
                  </div>
                </div>
                <span class="col-md-4"></span>
                <span v-if="errors.has('sub_district') && verify_status" class="validation_message col-md-8"><br>উপজেলা প্রয়োজন</span>
              </div>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <label for="inputPassword" class="col-md-4 labels">
                        মোবাইল নম্বর
                    </label>
                    <input
                         @keyup="errorRemove('phone')"
                        name="Name"
                        class="form-control col-md-8"
                        type="text"
                        v-model="phone"
                    />
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <span v-if="error_message" class="validation_message"><span v-if="error_message.phone"><span v-for="(error,key) in error_message.phone" :key="key">{{error}}</span></span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-7">
                        <div v-if="url" class="image_upload logo_upload">
                            <span class="removeImage" @click="RemoveImage">X</span>
                            <img :src="url" class="fitimage" />
                        </div>
                        <div  v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
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
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="row">
                <div style="margin:40px auto">
                    <button class="btn btn-primary"  style="border-color:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98);width:200px;" v-if="loader"  type="primary"> <i class="fa fa-cog fa-spin"></i> নিবন্ধন</button>

                    <button class="btn btn-primary" style="border-color:rgba(117, 171, 40, 0.98);background-color:rgba(117, 171, 40, 0.98);width:200px;" v-else @click="validate()"  type="primary">নিবন্ধন</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
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
  components: {
      Multiselect
  },
  data() {
    return {
      loader:false,
      image: '',
      not_edit_image: 10,
      name: '',
      confirm_password:'',
      password:'',
      url: '',
      phone:'',
      email:'',
      address:[{name:""}],
      designations: [],
      designation:'',
      error_message: '',
      verify_status:true,
      verify:'',
      divisions:[],
      districts:[],
      subdistricts:[],
      division:'',
      district:'',
      subdistrict:'',
      designation_id:'',
      subdistrict_id:''
    }
  },
  mounted() {
    this.getDesignation()
    this.getDivision()
  },
  methods: {
    designationSelect(){
      if(this.designation){
        this.designation_id = this.designation.id
      }
    },
    validate() {
      this.verify_status = true,
      this.$validator.validateAll().then(result => {
        if (result) {
          this.validate_status = true;
        }
        else{
          this.validate_status = false;
        }
        this.onComplete();
      })
    },
    onComplete: function() {
        this.verify = null;
        if(this.designation_id == 1){
          this.subdistrict = ''
          this.subdistrict_id = ''
        }
        if(this.subdistrict){
          this.subdistrict_id = this.subdistrict.id
        }
        var data = {
          name: this.name,
          email: this.email,
          phone: this.phone,
          password: this.password,
          confirm_password: this.confirm_password,
          workplace:this.address,
          designation:this.designation,
          designation_id:this.designation_id,
          image:this.image,
          not_edit_image:this.not_edit_image,
          district_id:this.district.id, 
          division_id:this.division.id,
          subdistrict_id:this.subdistrict_id,
          district:this.district,   
          subdistrict:this.subdistrict,
          division:this.division    
        }
        if(this.validate_status){
          this.loader = true;
            var self = this
            this.$axios
              .post('admin-registration', data)
              .then(response => {
                this.loader = false;
                this.verify = response.data.verify;
                this.name = ''
                this.email = ''
                this.phone = ''
                this.password = ''
                this.confirm_password = ''
                this.designation = ''
                this.address[0].name = ''
                this.verify_status = false
                this.url = ''
                this.districts = []
                this.subdistricts = []
                this.division = ''
                this.district = ''
                this.subdistrict = ''
              })
              .catch(error => {
                this.error_message = error.response.data.errors
                this.loader = false;
              })
        } 
    },
    removeNotification(){
      this.verify = null;
    },
    statusUpdate(){
      this.verify_status = true
    },
    errorRemove(field) {
      delete this.error_message[field];
      this.verify_status = true
    },
    async getDesignation() {
      this.$axios
        .get('api/get-designation')
        .then(response => {
          this.designations = response.data
        })
        .catch(error => {})
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
            this.subdistricts = response.data
          })
          .catch(error => {})
      }
    },
  }
}
</script>
<style scoped>
    .required {
        color: red;
    }
    .logo_upload {
        border: 1px solid #ccc;
        width: 160px;
        height: 120px;
        background: #eceef0;
        text-align: center;
        cursor: pointer;
        margin-left: 7%;
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
        width: 100%;
        height: 100%;
        -o-object-fit: contain;
        object-fit: contain;
        background-color: #e6e6ef;
    }
</style>