<template>
    <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 v-if="type==1" class="modal-title" id="exampleModalLabel">Job Post</h5>
            <h5 v-if="type==2" class="modal-title" id="exampleModalLabel">Notice</h5>
            <h5 v-if="type==3" class="modal-title" id="exampleModalLabel">Story</h5>
            <h5 v-if="type==4" class="modal-title" id="exampleModalLabel">Other</h5>
            <h5 v-if="type==5" class="modal-title" id="exampleModalLabel">Blog</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
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
              <div class="col-md-12">
                <div class="form-group">
                  <label class="typo__label">Name</label>
                    <div class="input-group">
                      <input type="text" v-validate="'required'" v-model="list.headline" class="form-control" placeholder="Name" name="headline" aria-label="Name...">
                    </div>
                </div>
                <p  v-if="errors.has('headline')" class="validation_message">* {{ errors.first('headline') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.headline!='undefined'">
                  <p  v-for="(error,k) in $store.state.admin.post.errors.errors.headline" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-12" v-if="type==1">
                <div class="form-group">
                  <label class="typo__label">Job Description</label>
                  <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">Images</button>
                   <ckeditor v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type==2">
                <div class="form-group">
                  <label class="typo__label">Notice</label>
                      <ckeditor v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type==6">
                <div class="form-group">
                  <label class="typo__label">News</label>
                      <ckeditor v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type == 3">
                <div class="form-group">
                  <label class="typo__label">Story</label>
                      <ckeditor v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type == 4 || type == 5">
                <div class="form-group">
                  <label class="typo__label">Details</label>
                      <ckeditor v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-4" v-if="type==1">
                <div class="form-group">
                  <label class="typo__label">Designation</label>
                  <div class="input-group">
                    <input type="text" v-validate="'required'" v-model="list.designation" class="form-control" placeholder="Designation" name="designation" aria-label="designation...">
                  </div>
                </div>
                <p  v-if="errors.has('designation')" class="validation_message">* {{ errors.first('designation') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.designation!='undefined'">
                  <p  v-for="(error,k) in $store.state.admin.post.errors.errors.designation" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-4" v-if="type==1">
                 <div class="form-group">
                  <label class="typo__label">Deadline</label>
                  <div class="input-group">
                      <input type="date" v-validate="'required'" v-model="list.expired_at" class="form-control" placeholder="Deadline" name="expired_at" aria-label="deadline...">
                  </div>
                </div>
                <p  v-if="errors.has('expired_at')" class="validation_message">* {{ errors.first('expired_at') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.expired_at!='undefined'">
                  <p  v-for="(error,k) in $store.state.admin.post.errors.errors.expired_at" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">Publish</label>
                  <div class="input-group">
                    <select v-model="list.status" v-validate="'required'" class="form-control" name="status" aria-label="status...">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                <p  v-if="errors.has('status')" class="validation_message">* {{ errors.first('status') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.status!='undefined'">
                  <p  v-for="(error,k) in $store.state.admin.post.errors.errors.status" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-sm-4">
                  <div v-if="url" class="image_upload logo_upload">
                      <span class="removeImage" @click="RemoveImage">X</span>
                      <img  :src="url" class="fitimage">
                  </div>
                  <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
                      <p>Choose Image</p> <i class="fas fa-cloud-upload-alt"></i>
                      <input  type="file" ref="ImageFile" class="file-input" style="display: none" v-on:change="imageChanged">
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> Save changes</button>
          <button type="button" class="btn btn-primary" v-else @click="save">Post</button>
        </div>
        </div>
    </div>
    <filemanger v-show="file_modal_open"  ref="file_maneger" ></filemanger>
    </div>
</template>
<script>
import filemanger from "~/components/dashboard/file-manager";
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
    Multiselect,
    filemanger
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
  props: ['type'],
  data() {
    return {
      file_modal_open:false,
      url:'',
      area:'',
      subarea:'',
      role:'',
      validateStatus:0,
      loader:false,
      defaultList: {
        id:"",
        headline: "",
        content: "",
        expired_at:'',
        designation:'', 
        status: 1,
        type: '',
        image:'',
        not_edit_image:10
      },
      index:'',
      list:{
        id:"",
        headline: "",
        content: "",
        expired_at:'',
        designation:'',
        status: 1,
        type: '',
        image:'',
        not_edit_image:10
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
    areasearch({ title, id }){
      return `${title}`
    },
    fileModalOpen() {
      this.$refs.file_maneger.fileModalOpen();
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
      this.list = this.defaultList;
    },
    openModal(data,key) {
      this.errors = {};
      if(data!=''){
        this.list = Object.assign({},data);
        this.list.permission = Object.assign({},data.permission);
        this.url = this.list.image;
        this.index = key;
      }else{
        this.list = this.defaultList;
        this.url = '';
        this.errorClear();
      }
      this.$parent.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/post/set_errors','');
    },
    async save () {
      this.list.type = this.type;
      if(this.role!=''){
        this.list.role = this.role.id;
      }
      this.$store.commit('admin/post/set_errors','');
      this.$validator.validateAll().then( result =>{
        if(result){
          this.validateStatus = 1;
        }
      });
      if(this.validateStatus==1){
        this.loader =true;
        if(this.list.id==''){
          await this.$store.dispatch('admin/post/add',this.list).then(response => {
            this.loader = false;
            this.$parent.modalOpen = false;
            this.list = this.defaultList;
          })
          .catch(error => {
            this.loader = false;
            this.formError = error.response.data;
          })
        }else{
          await this.$store.dispatch('admin/post/update',{index:this.index,list:this.list}).then(response => {
              this.loader = false;
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