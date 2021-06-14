<template>
    <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="overflow: auto;max-height: 350px;">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="typo__label">Website</label>
                      <div class="input-group">
                          <input type="text"   v-model="list.website" class="form-control" placeholder="Name" name="nid" aria-label="nid...">
                      </div>
                </div>
              </div>
              <div class="col-md-12" >
                <div class="form-group">
                  <label class="typo__label">About</label>
                      <ckeditor v-model="list.about"></ckeditor>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  @click="CloseModal" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> Save changes</button>
            <button type="button" class="btn btn-primary" v-else @click="save">Save changes</button>
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
        registration_number:''
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
        registration_number:''
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
        this.list.old_role_id = this.list.role_id;
      }else{
        this.list = this.defaultList;
      }
      this.$parent.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/user/user/set_errors','');
    },
   async save () {
          if(this.list.role!=''){
            this.list.role_id = this.list.role.id;
          }
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