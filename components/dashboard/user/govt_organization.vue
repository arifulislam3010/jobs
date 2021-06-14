<template>
    <div class="modal fade bd-example-modal-xl"  :class="this.modalOpen?'show':''" id="exampleModal" :style="this.modalOpen?'display: block; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 v-if="$route.name=='dashboard-financial-organization'" class="modal-title" id="exampleModalLabel">আর্থিক সংস্থা</h5>
            <h5 v-if="$route.name=='dashboard-training-center'" class="modal-title" id="exampleModalLabel">ট্রেনিং সেন্টার</h5>
            <h5 v-if="$route.name=='dashboard-important-embassy'" class="modal-title" id="exampleModalLabel">পগুরুত্বপূর্ণ এম্বাসি</h5>


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
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">নাম *</label>
                      <div class="input-group">
                          <input type="text"  v-validate="'required'" v-model="list.name" class="form-control" name="name">
                      </div>
                </div>
                  <p  v-if="errors.has('name') && check" class="validation_message">* নাম প্রয়োজন</p>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">মোবাইল নাম্বার *</label>
                      <div class="input-group">
                          <input @keyup="errorClear()" type="text"  v-validate="'required'" v-model="list.phone" class="form-control" name="phone" >
                      </div>
                </div>
                  <p  v-if="errors.has('phone') && check" class="validation_message">* মোবাইল নাম্বার প্রয়োজন</p>
                  <p v-if="$store.state.admin.user.user.errors" class="validation_message"><span v-if="$store.state.admin.user.user.errors.phone"><span v-for="(error,key) in $store.state.admin.user.user.errors.phone" :key="key">{{error}}</span></span></p>
            </div>
            
              <div class="col-md-6">
                 <div class="form-group">
                  <label class="typo__label">ওয়েবসাইট</label>
                      <div class="input-group">
                          <input type="text"  v-model="list.website" class="form-control" >
                      </div>
                </div>
              </div>
              
              <div v-if="$route.name == 'dashboard-training-center'" class="col-md-6">
                 <div class="form-group">
                    <label class="typo__label">ট্রেনিং এর ধরন *</label>
                    <div class="input-group">
                        <select v-validate="'required'" v-model="list.training_type" name="training_type" class="form-control">
                          <option value="">ট্রেনিং এর ধরন </option>
                          <option v-for="(t_type,key) in types" :key="key" :value="t_type.id">{{t_type.name}}</option>
                        </select>
                    </div>
                    <p></p>
                     <p  v-if="errors.has('training_type') && check" class="validation_message">* ট্রেনিং এর ধরন প্রয়োজন</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="typo__label">ঠিকানা *</label>
                      <div class="input-group">
                          <textarea  v-validate="'required'" rows="2" cols="5" v-model="list.address[0].name" class="form-control" name="address"></textarea>
                      </div>
                </div>
                  <p  v-if="errors.has('address') && check" class="validation_message">* ঠিকানা প্রয়োজন</p>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  @click="CloseModal" data-dismiss="modal">বাতিল</button>
            <button type="button" class="btn btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> সাবমিট</button>
            <button type="button" class="btn btn-primary" v-else @click="validate()">সাবমিট</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
import { type } from 'os';
Vue.use(VeeValidate)
export default {
  name: "UserCreate",
  data() {
    return {
      modalOpen:false,
      check:false,
      url:'',
      area:'',
      subarea:'',
      role:'',
      validateStatus:0,
      loader:false,
      defaultList: {
        name: "",
        phone:"",
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
        service_url:'',
        training_type:''
      },
      index:'',
      list:{
        name: "",
        phone: "",
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
        service_url:'',
        training_type:''
      },
      types:[]
    }
  },
  mounted(){
    this.getType();
  },
  methods: {
    getType(){
      this.$axios.get('api/get-training-center-type').then(response=>{
        this.types = response.data;
      })
    },
    CloseModal(){
        this.modalOpen = false;
    },
    openModal(data,key) {
      if(data!=''){
        this.list.id = data.id;
        this.list.name = data.name;
        this.list.phone = data.phone;
        this.list.website = data.website;
        this.list.contact_id = data.contact_id;
        this.list.address[0].name = data.address[0].name;

        this.role = this.list.role
        this.url = this.list.image
        this.list.permission = Object.assign({},data.permission);
        this.index = key;
        this.list.old_role_id = 4;
        this.list.training_type = data.training_type;
      }else{
        this.list.name = '';
        this.list.phone = '';
        this.list.website = '';
        this.list.address[0].name = '';
        this.list.role_id = 4;
        this.list.training_type = '';
      }
      this.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/user/user/set_errors','');
    },
    async validate(){
        this.check = true
        this.$validator.validateAll().then( result =>{
            if(result){
              this.validateStatus = 1;
            }
            else{
               this.validateStatus = 0; 
            }
            this.save();
        });
    },
    async save () {
          if(this.$route.name=='dashboard-financial-organization'){
            this.list.role_id = 5;
          }else if(this.$route.name=='dashboard-training-center'){
            this.list.role_id = 4;
          }
          else if(this.$route.name=='dashboard-important-embassy'){
            this.list.role_id = 7;
          }
          
          this.$store.commit('admin/user/user/set_errors','');
          if(this.validateStatus ==1 ){
              this.loader = true;
              if(this.list.id==''){
                
                await this.$store.dispatch('admin/user/user/add',this.list).then(response => {
                    this.loader = false;
                    this.modalOpen = this.$store.state.admin.user.user.modal;
                    if(!this.$store.state.admin.user.user.modal){
                      this.list = this.defaultList;
                      this.check = false
                    }
                    else{
                        this.check = true
                    }
                })
              }else{
                await this.$store.dispatch('admin/user/user/update',{index:this.index,list:this.list}).then(response => {
                    this.loader = false;
                    this.modalOpen = this.$store.state.admin.user.user.modal;
                    if(!this.$store.state.admin.user.user.modal){
                      this.list = this.defaultList;
                      this.check = false
                    }
                    else{
                        this.check = true
                    }
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
.modal {
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}
</style>