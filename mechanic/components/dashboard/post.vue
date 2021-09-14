<template>
    <div class="modal fade"  :class="this.$parent.modalOpen?'show':''" id="exampleModal"  :style="this.$parent.modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 v-if="type==11" class="modal-title" >বিদেশ যাত্রার প্রস্তুতি</h5>
            <h5 v-if="type==12" class="modal-title" >প্রবাসে করণীয়</h5>
            <h5 v-if="type==13" class="modal-title" >বৈধ ভাবে টাকা পাঠানো</h5>
            <h5 v-if="type==14" class="modal-title" >অভিবাসন প্রক্রিয়া</h5>
            <h5 v-if="type==10" class="modal-title" >গাইড বুক</h5>
            <h5 v-if="type==1" class="modal-title" ><span v-if="edit">নিয়োগ বিজ্ঞপ্তি</span><span v-else>নতুন নিয়োগ বিজ্ঞপ্তি</span></h5>
            <h5 v-if="type==2" class="modal-title" >নোটিশ</h5>
            <h5 v-if="type==3" class="modal-title" >সফলতার গল্প</h5>
            <h5 v-if="type==4" class="modal-title" >অন্যান্য</h5>
            <h5 v-if="type==5" class="modal-title" >সচরাচর জিজ্ঞাসা</h5>
            <h5 v-if="type==6" class="modal-title" >নিউজ</h5>
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
                  <label class="typo__label">শিরোনাম <span class="required" >*</span></label>
                    <div class="input-group">
                      <input type="text" v-validate="'required'" v-model="list.headline" class="form-control" placeholder="শিরোনাম" name="headline" aria-label="Name...">
                    </div>
                </div>
                <p  v-if="errors.has('headline') && check" class="validation_message">* শিরোনাম প্রয়োজন</p>
              </div>
              <div v-if="type == 11 || type == 12 || type == 13 || type == 14" class="col-md-12">
                <div class="form-group">
                  <label class="typo__label">ধাপ</label>
                    <div class="input-group">
                      <input type="text" v-model="list.shoulder" class="form-control" placeholder="ধাপ">
                    </div>
                </div>
              </div>
              <div class="col-md-12" v-if="type==1">
                <div class="form-group">
                  
                  <label class="typo__label">নিয়োগ বিজ্ঞপ্তির বিস্তারিত <span class="required" >*</span></label>
                  <!-- <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">ছবি ঘর</button> -->
                   <ckeditor :config="config" name='content' v-validate="'required'"  v-model="list.content"></ckeditor>
                   <!-- <ckeditor  @input="onEditorInput" :config="config" v-model="list.content"></ckeditor> -->
                   <!-- <Vueditor></Vueditor> -->
                   <!-- <kendo-editor :resizable-content="true"
                 style="height:280px" rows="10" cols="30">
                 
            </kendo-editor> -->
                </div>
                  <p  v-if="errors.has('content') && check" class="validation_message">* বিস্তারিত প্রয়োজন</p>
              </div>
              <div class="col-md-12" v-if="type==2">
                <div class="form-group">
                  <label class="typo__label">নোটিশ</label>
                      <!-- <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">ছবি ঘর</button> -->
                      <ckeditor   :config="config" v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type==6">
                <div class="form-group">
                  <label class="typo__label">নিউজ</label>
                     <!-- <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">ছবি ঘর</button> -->
                      <ckeditor   :config="config" v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type == 3">
                <div class="form-group">
                  <label class="typo__label">গল্প</label>
                      <!-- <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">ছবি ঘর</button> -->
                      <ckeditor   :config="config" v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-12" v-if="type == 4 || type == 5 || type == 10 || type == 11 || type == 12 || type == 13 || type == 14">
                <div class="form-group">
                  <label class="typo__label">বিস্তারিত</label>
                     <!-- <button @click="fileModalOpen()" class="btn-primary btn-sm pull-right">ছবি ঘর</button> -->
                      <ckeditor   :config="config" v-model="list.content"></ckeditor>
                </div>
                  <p  v-if="errors.has('content')" class="validation_message">* {{ errors.first('content') }}</p>
                  <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.content!='undefined'">
                    <p  v-for="(error,k) in $store.state.admin.post.errors.errors.content" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                  </div>
              </div>
              <div class="col-md-4" v-if="type==1">
                <div class="form-group">
                  <label class="typo__label">অভিজ্ঞতা(বৎসর)</label>
                  <div class="input-group">
                    <input type="number" step="0.5" v-model="list.experience" class="form-control" placeholder="অভিজ্ঞতা" >
                  </div>
                </div>
              </div>
              <div class="col-md-4" v-if="type==1">
                 <div class="form-group">
                  <label class="typo__label">ডেডলাইন <span class="required" >*</span></label>
                  <div class="input-group">
                      <input type="date" v-validate="'required'" v-model="list.expired_at" class="form-control" placeholder="ডেডলাইন" name="expired_at" >
                  </div>
                </div>
                <p  v-if="errors.has('expired_at') && check" class="validation_message">* ডেডলাইন প্রয়োজন</p>
              </div>
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">পাবলিশ</label>
                  <div class="input-group">
                    <select v-model="list.status"  class="form-control" name="status" aria-label="status...">
                      <option value="1">হ্যাঁ</option>
                      <option value="0">না</option>
                    </select>
                  </div>
                </div>
                <p  v-if="errors.has('status')" class="validation_message">* {{ errors.first('status') }}</p>
              </div> -->
              <div v-if="type == 1" class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">দেশ</label>
                  <div class="input-group">
                      <multiselect
                        name="birth"
                        v-model="list.country"
                        placeholder="দেশ"
                        label="country_name"
                        track-by="id"
                        :options="countries"
                      >
                    </multiselect>
                  </div>
                </div>
              </div>
              <div v-if="type == 1" class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">চাকুরী</label>
                  <div class="input-group">
                      <multiselect
                        name="birth"
                        v-model="list.job"
                        placeholder="চাকুরী"
                        label="name"
                        track-by="id"
                        :options="desire_jobs"
                      >
                    </multiselect>
                  </div>
                </div>
              </div>
              <div v-if="type == 1" class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">ভাষা</label>
                  <div class="input-group">
                      <multiselect
                        name="birth"
                        v-model="list.language"
                        placeholder="ভাষা"
                        label="name"
                        track-by="id"
                        :options="languages"
                      >
                    </multiselect>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-4">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
              </div> -->
              <div class="col-sm-4">
                  <div v-if="url" class="image_upload logo_upload">
                      <span class="removeImage" @click="RemoveImage">X</span>
                      <iframe  :src="url" width="100%" height="100%" />
                  </div>
                  <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
                      <p>ছবি বাছাই করুন</p> <i class="fas fa-cloud-upload-alt"></i>
                      <input  type="file" ref="ImageFile" class="file-input" style="display: none" v-on:change="imageChanged">
                  </div>
                </div>
            </div>
        </div>
        <div v-if="type == 3" class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
          <button type="button" class="btn btn-primary" v-if="loader2"> <i class="fa fa-cog fa-spin"></i> পাবলিশ</button>
          <button type="button" class="btn btn-primary" v-else @click="validateData">পাবলিশ</button>
        </div>
        <div v-if="type == 1" class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
          <button type="button" class="btn btn-success" v-if="loader"> <i class="fa fa-cog fa-spin"></i> পাবলিশ</button>
          <button type="button" class="btn btn-success" v-else @click="publish()">পাবলিশ</button>

          <button type="button" class="btn btn-primary" v-if="loader2"> <i class="fa fa-cog fa-spin"></i> ড্রাফট</button>
          <button type="button" class="btn btn-primary" v-else @click="draft()">ড্রাফট</button>
        </div>
        <div  v-if="type == 2 || type == 4 || type == 5 || type == 6 || type == 10 || type == 11 || type == 12 || type == 13 || type == 14" class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
          <button type="button" class="btn btn-success" v-if="loader"> <i class="fa fa-cog fa-spin"></i> পাবলিশ</button>
          <button type="button" class="btn btn-success" v-else @click="publish()">পাবলিশ</button>
        </div>
        </div>
    </div>
    <filemanger v-show="file_modal_open"  ref="file_maneger" ></filemanger>
    </div>
</template>
<script>
import filemanger from "~/components/dashboard/file-manager";
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
import Multiselect from 'vue-multiselect'
// import CKEditor from 'ckeditor4-vue';
// let CKEditor;
// if (process.client) {
//   CKEditor = require('ckeditor4-vue')
//   Vue.component('ckeditor', CKEditor.component)
// }
Vue.use(VeeValidate)
export default {
  name: "UserCreate",
  components: {
    filemanger,
    Multiselect
  },
  mounted(){
      this.getCountry();
      this.getJobs();
      this.getlanguages();
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
      check:false,
      edit:false,
      countries:[],
      desire_jobs:[],
      languages:[],
      country:'',
      job:'',
      language:'',
      config:{
        format_tags:'p;h1;h2;h3;h4;h5;h6;pre;address;div',
        stylesSet: [
    // Block-level styles
    { name: 'Blue Title', element: 'h2', styles: { 'color': 'Blue' } },
    { name: 'Red Title' , element: 'h3', styles: { 'color': 'Red' } },

    // Inline styles
    { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
    { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
],
//       toolbar :'Full',
//       toolbar_Full :
// [
//     { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
//     { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
//     { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
//     { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
//         'HiddenField']
//     },
//     '/',
//     { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
//     { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv',
//     '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
//     },
//     { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
//     { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
//     '/',
//     { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
//     { name: 'colors', items: ['TextColor', 'BGColor'] },
//     { name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About'] }
// ],
extraPlugins : 'iframe,font'
 
        // toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
      },
      file_modal_open:false,
      url:'',
      area:'',
      subarea:'',
      role:'',
      validateStatus:0,
      loader:false,
      loader2:false,
      defaultList: {
        id:"",
        headline: "",
        content: "",
        expired_at:'',
        experience:'', 
        status: 1,
        type: '',
        image:'',
        not_edit_image:10,
        country:'',
        job:'',
        language:'',
        shoulder:''
      },
      index:'',
      list:{
        id:"",
        headline: "",
        content: "",
        expired_at:'',
        experience:'',
        status: 1,
        type: '',
        image:'',
        not_edit_image:10,
        country:'',
        job:'',
        language:'',
        shoulder:''
      },
    }
  },
  methods: {
    publish(){
      this.list.status = 1
      this.validateData();
    },
    draft(){
      this.list.status = 0
      this.validateStatus = 1;
      this.list.type = this.type;
      this.save();
    },
    async getCountry(){
        await this.$axios.get('api/get-country').then(response => {
          this.countries = response.data;
    })
    .catch(error => {

      });
    },
    async getJobs(){
      await  this.$axios.get('api/get-desired-job').then(response => {
        this.desire_jobs = response.data;
    })
    .catch(error => {

      });
    },
    async getlanguages(){
      await  this.$axios.get('api/get-language').then(response => {
        this.languages = response.data;
    })
    .catch(error => {

      });
    },
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
    CloseModal(){
      this.$parent.modalOpen = false;
      this.list = this.defaultList;
    },
    openModal(data,key) {
      this.check = false;
      if(data!=''){
        this.list = Object.assign({},data);
        this.list.permission = Object.assign({},data.permission);
        this.url = this.list.image;
        this.index = key;
        this.edit = true;
      }else{
        this.list.headline =  "",
        this.list.shoulder =  "",
        this.list.content =  ""
        this.list.expired_at = ''
        this.list.experience = ''
        this.list.status =  1
        this.list.country = ''
        this.list.job = ''
        this.list.language = ''
        this.url = '';
        this.edit = false;
        this.errorClear();
      }

      if(this.type == 3){
        this.list.status = 0
      }
      this.$parent.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/post/set_errors','');
    },
    
    validateData () {
      this.check = true;
      this.list.type = this.type;
      if(this.role!=''){
        this.list.role = this.role.id;
      }
      this.$validator.validateAll().then( result =>{
        if(result){
          this.validateStatus = 1;
          this.save();
        }
        else{
          this.validateStatus = 0;
        }
      });
    },
    async save(){
      if(this.validateStatus==1){
        if(this.list.status == 1){
          this.loader =true;
        }
        if(this.list.status == 0){
          this.loader2 =true;
        }
        
        if(this.list.id==''){
          await this.$store.dispatch('admin/post/add',this.list).then(response => {
            this.loader = false;
            this.loader2 = false;
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
              this.loader2 = false;
              this.$parent.modalOpen = false;
              this.list = this.defaultList;
          })
          .catch(error => {
              this.loader = false;
              this.loader2 = false;
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
.required{
  color:red;
}
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