<template>
    <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ট্রেনিং সেন্টার</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="overflow: auto;max-height: 350px;">
          <div class="row">
            <div v-if="$store.state.admin.user.role.errors.error" class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-inner--text"><strong>Warning!</strong> {{$store.state.admin.user.role.errors.error}}</span>
                <button type="button" class="close" @click="errorClear" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          </div>
          <div class="row">
              <!-- <div class="col-md-4">
                <div class="form-group" v-if="lists_a">
                    <label class="typo__label">Select Area</label>
                    <multiselect v-model="area" :options="lists_a" :custom-label="areasearch" placeholder="Select one" label="title" track-by="title"></multiselect>
                </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group"  v-if="lists_sa">
                    <label class="typo__label">Select Sub Area</label>
                    <multiselect v-model="subarea" :options="lists_sa" :custom-label="areasearch" placeholder="Select one" label="title" track-by="title"></multiselect>
                </div>
              </div> -->
              
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div v-if="url" class="image_upload logo_upload">
                        <span class="removeImage" @click="RemoveImage">X</span>
                        <img  :src="url" class="fitimage">
                    </div>
                    <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
                        <p>ছবি বাছাই করুন</p> <i class="fa fa-cloud-upload-alt"></i>
                        <input  type="file" ref="ImageFile" class="file-input" style="display: none" v-on:change="imageChanged">
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">নাম</label>
                      <div class="input-group">
                          <input type="text"  v-validate="'required'" v-model="list.name" class="form-control" placeholder="Name" name="name" aria-label="Name...">
                      </div>
                </div>
                  <p  v-if="errors.has('name')" class="validation_message">* {{ errors.first('name') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <!-- <div class="col-md-6">
                 <div class="form-group">
                  <label class="typo__label">Spouse Name</label>
                      <div class="input-group">
                          <input type="text"  v-validate="'required'" v-model="list.spouse_name" class="form-control" placeholder="spouse name" name="spouse_name" aria-label="spouse name...">
                      </div>
                </div>
                  <p  v-if="errors.has('spouse_name')" class="validation_message">* {{ errors.first('spouse_name') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.spouse_name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.spouse_name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div> -->
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">ইমেইল </label>
                      <div class="input-group">
                          <input type="text"  v-validate="'required'" v-model="list.email" class="form-control" placeholder="email" name="email" aria-label="email...">
                      </div>
                </div>
                  <p  v-if="errors.has('email')" class="validation_message">* {{ errors.first('email') }}</p>
                  
                <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.name!='undefined'">
                  <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.email" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
            </div>
            <div class="row">
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">Email</label>
                      <div class="input-group">
                          <input type="text"  v-validate="'required|email'" v-model="list.email" class="form-control" placeholder="email" name="email" aria-label="email...">
                      </div>
                </div>
                  <p  v-if="errors.has('email')" class="validation_message">* {{ errors.first('email') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.email" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div> -->
              </div>
              <div class="col-md-6">
                 <div class="form-group">
                  <label class="typo__label">মোবাইল নাম্বার</label>
                      <div class="input-group">
                          <input type="text"  v-model="list.mobile_number" class="form-control" placeholder="mobile number" name="mobile_number" aria-label="mobile number...">
                      </div>
                </div>
                  <p  v-if="errors.has('mobile_number')" class="validation_message">* {{ errors.first('mobile_number') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.mobile_number!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.mobile_number" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">রেজিস্ট্রেশন নাম্বার</label>
                      <div class="input-group">
                          <input type="text"  v-model="list.registration_number" class="form-control" placeholder="designation" name="designation" aria-label="designation...">
                      </div>
                </div>
                  <p  v-if="errors.has('designation')" class="validation_message">* {{ errors.first('designation') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.designation!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.designation" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
            </div>
             <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">Father Name</label>
                      <div class="input-group">
                          <input type="text" v-model="list.father_name" class="form-control" placeholder="father_name" name="father_name" aria-label="father_name...">
                      </div>
                </div>
                  <p  v-if="errors.has('father_name')" class="validation_message">* {{ errors.first('father_name') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.father_name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.father_name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-6">
                 <div class="form-group">
                  <label class="typo__label">Mother Name</label>
                      <div class="input-group">
                          <input type="text"   v-model="list.mother_name" class="form-control" placeholder="mother name" name="mother_name" aria-label="mother name...">
                      </div>
                </div>
                  <p  v-if="errors.has('mother_name')" class="validation_message">* {{ errors.first('mother_name') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.mother_name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.mother_name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
            </div> -->
             <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">NID</label>
                      <div class="input-group">
                          <input type="text"   v-model="list.nid" class="form-control" placeholder="Name" name="nid" aria-label="nid...">
                      </div>
                </div>
                  <p  v-if="errors.has('nid')" class="validation_message">* {{ errors.first('nid') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.nid!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.nid" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-6">
                 <div class="form-group">
                  <label class="typo__label">Birthday</label>
                      <div class="input-group">
                          <input type="text"   v-model="list.birthday" class="form-control" placeholder="birthday" name="birthday" aria-label="birthday...">
                      </div>
                </div>
                  <p  v-if="errors.has('birthday')" class="validation_message">* {{ errors.first('birthday') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.birthday!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.birthday" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
            </div> -->
            <div class="row">
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">Designation</label>
                      <div class="input-group">
                          <input type="text"  v-model="list.designation" class="form-control" placeholder="designation" name="designation" aria-label="designation...">
                      </div>
                </div>
                  <p  v-if="errors.has('designation')" class="validation_message">* {{ errors.first('designation') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.designation!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.designation" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div> -->
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">Registration number</label>
                      <div class="input-group">
                          <input type="text"  v-model="list.registration_number" class="form-control" placeholder="designation" name="designation" aria-label="designation...">
                      </div>
                </div>
                  <p  v-if="errors.has('designation')" class="validation_message">* {{ errors.first('designation') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.designation!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.designation" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div> -->
              <div class="col-md-6">
                  <p  v-if="errors.has('company_name')" class="validation_message">* {{ errors.first('company_name') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.company_name!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.company_name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="typo__label">ওয়েবসাইট</label>
                      <div class="input-group">
                          <input type="text"   v-model="list.website" class="form-control" placeholder="Name" name="nid" aria-label="nid...">
                      </div>
                </div>
                  <p  v-if="errors.has('nid')" class="validation_message">* {{ errors.first('nid') }}</p>
                  
                  <div v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.nid!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.user.user.errors.errors.nid" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>

              <div class="col-md-12" >
                <div class="form-group">
                  <label class="typo__label">সম্বন্ধে</label>
                      <ckeditor v-model="list.about"></ckeditor>
                      <!-- <vue-ckeditor type="classic" v-model="list.about" :editors="editors"></vue-ckeditor> -->
                      <!-- <div class="input-group">
                          <textarea v-model="list.about"  class="form-control" placeholder="About" name="content" aria-label="About..."></textarea>
                      </div> -->
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  @click="CloseModal" data-dismiss="modal">বাতিল</button>
            <button type="button" class="btn btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> সাবমিট</button>
            <button type="button" class="btn btn-primary" v-else @click="save">সাবমিট</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
// import CKEditor from 'ckeditor4-vue';
let CKEditor;
if (process.client) {
  CKEditor = require('ckeditor4-vue')
  Vue.component('ckeditor', CKEditor.component)
}
Vue.use(VeeValidate)
export default {
  name: "UserCreate",
  components: {
    Multiselect
  },
 
   computed:{
      ...mapGetters({
        lists_a: 'admin/Basic/lists_a',
        lists_sa: 'admin/Basic/lists_sa',
        lists_r: 'admin/user/role/lists'
      }),
   },

   watch:{
     area: function(val, oldVal) {
       this.get_sa();
       this.subarea = '';
     }
   },
   mounted(){
   },

  
  data() {
    return {
      url:'',
      area:'',
      subarea:'',
      role:'',
      validateStatus:0,
      loader:false,
      defaultList: {
        name: "",
        address:[{name:""}],
        country:[{name:""}],
        id: "",
        role:'',
        role_id: 4,
        email:'',
        nid:'',
        birthday:'',
        designation:'',
        company_name:'',
        occupation:'',
        father_name:'',
        mother_name:'',
        spouse_name:'',
        area_code:'',
        area_village:'',
        post_ofiice:'',
        street_para:'',
        image:'',
        not_edit_image:10,
        website:'',
        about:'',
        registration_number:'',
        service_name:'',
        service_url:''
      },
      index:'',
      list:{
        name: "",
        address:[{name:""}],
        country:[{name:""}],
        id: "",
        role:'',
        role_id:'',
        email:'',
        nid:'',
        birthday:'',
        designation:'',
        company_name:'',
        occupation:'',
        father_name:'',
        mother_name:'',
        spouse_name:'',
        area_code:'',
        area_village:'',
        post_ofiice:'',
        street_para:'',
        image:'',
        not_edit_image:10,
        website:'',
        about:'',
        registration_number:'',
        service_name:'',
        service_url:''
      },
    }
  },
  methods: {
      imageChanged(e) {
          var fileReader = new FileReader()
          fileReader.readAsDataURL(e.target.files[0])
          fileReader.onload = (e) => {
              this.list.image = e.target.result
              this.list.not_edit_image = 11
          }
          this.url = URL.createObjectURL(e.target.files[0]);
      },
      RemoveImage: function () {
              this.list.image = '';
              this.list.not_edit_image = 10;
              this.url = '';
      },
    addAddres(){
      this.list.address.push({name:""});
    },
    removeAddres(index){
      this.list.address.splice(index,1)
    },
    addCountry(){
      this.list.country.push({name:""});
    },
    removeCountry(index){
      this.list.country.splice(index,1)
    },
    areasearch({ title, id }) {
      return `${title}`
    },
    rolesearch({ name, id }){
      return `${name}`
    },
    async get_sa () {
      try {
        await this.$store.dispatch('admin/Basic/get_sa',this.area.id)
      } catch (e) {
        
      }
    },
    // nameWithLang ({ title, id }) {
    //   return `${title} — [${id}]`
    // },
    CloseModal(){
        this.$parent.modalOpen = false;
    },
    openModal(data,key) {
      if(data!=''){
        this.list = Object.assign({},data);
        this.role = this.list.role
        this.url = this.list.image
        this.list.permission = Object.assign({},data.permission);
        this.index = key;
        this.list.old_role_id = 4;
      }else{
        this.list = this.defaultList;
      }
      this.$parent.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/user/user/set_errors','');
    },
   async save () {
          this.list.role_id = 4;
          this.$store.commit('admin/user/user/set_errors','');
          this.$validator.validateAll().then( result =>{
          if(result){
              this.validateStatus = 1;
            }  
          });
          if(this.validateStatus==1){
              this.loader =true;
              if(this.list.id==''){
                
                await this.$store.dispatch('admin/user/user/add',this.list).then(response => {
                    this.loader = false;
                    this.$parent.modalOpen = false;
                    this.list = this.defaultList;
                })
                .catch(error => {
                  this.loader = false;
                  this.formError = error.response.data;
                })
              }else{
                await this.$store.dispatch('admin/user/user/update',{index:this.index,list:this.list}).then(response => {
                    this.loader = false;
                    this.$parent.modalOpen = false;
                    this.list = this.defaultList;
                })
                .catch(error => {
                    this.loader = false;
                    this.formError = error.response.data;
                })
              }
          }
      },
   }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.logo_upload{
    border: 1px solid #ccc;
    width: 100%;
    height: 90px;
    background: #eceef0;
    text-align: center;
    cursor: pointer;
}
.image_upload p{
    margin-top: 10px;
    font-size: 12px;
}

.image_upload i{
    font-size: 34px;
}
.removeImage{
   position: absolute;
    right: 13px;
    top:  14px;
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