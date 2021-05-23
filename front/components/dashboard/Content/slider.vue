<template>
  <div
    class="modal fade bd-example-modal-lg"
    :class="this.$parent.modalOpen?'show':''"
    id="exampleModal"
    :style="this.$parent.modalOpen?'display: block; padding-right: 17px;':''"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-if="$route.name == 'dashboard-slider'" class="modal-title" >স্লাইডার </h5>
          <h5 v-if="$route.name == 'dashboard-downloads'" class="modal-title" >ফরম </h5>
          <button
            type="button"
            class="close"
            @click="CloseModal"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow: auto;max-height: 350px;">
          <div class="row">
            <div
              v-if="$store.state.admin.slider.errors.error"
              class="alert alert-warning alert-dismissible fade show"
              role="alert"
            >
              <span class="alert-inner--icon">
                <i class="ni ni-like-2"></i>
              </span>
              <span class="alert-inner--text">
                <strong>Warning!</strong>
                {{$store.state.admin.slider.errors.error}}
              </span>
              <button
                type="button"
                class="close"
                @click="errorClear"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="typo__label">শিরোনাম</label>
                <div class="input-group">
                  <input
                    type="text"
                    v-model="list.title"
                    class="form-control"
                    placeholder="শিরোনাম"
                    name="title"
                    v-validate="'required'"
                  />
                </div>
              </div>
              <p
                v-if="errors.has('title')"
                class="validation_message"
              >* <span style="color:red">শিরোনাম প্রয়োজন</span></p>

              <div
                v-if="$store.state.admin.user.user.errors.errors && $store.state.admin.user.user.errors.errors.title!='undefined'"
              >
                <p
                  v-for="(error,k) in $store.state.admin.user.user.errors.errors.title"
                  v-bind:key="'n'+k"
                  class="validation_message"
                >* {{ error }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div
                v-if="list.file==''"
                class="video_upload logo_upload"
                @click="$refs.ContentFile.click()"
              >
                <p v-if="$nuxt.$route.name == 'dashboard-slider'">ছবি বাছাই করুন</p>
                <p v-if="$nuxt.$route.name == 'dashboard-downloads'">পিডিএফ বাছাই করুন</p>
                <i class="fas fa-cloud-upload-alt new_btn"></i>
                <input
                  type="file"
                  ref="ContentFile"
                  class="file-input"
                  style="display: none"
                  v-on:change="onContentChange"
                />
                <small
                  id="emailHelp"
                  class="form-text text-muted"
                  style="color:read"
                  v-if="errors.file"
                >{{errors.file[0]}}</small>
              </div>
              <div v-else class="video_upload logo_upload">
                <span class="removeImage" @click="ContentRemoveFile">X</span>
                <img v-if="list.type=='image'" :src="video" class="fitimage" />
                <video v-else-if="list.type=='video'" :src="video" class="fitimage" controls></video>
                <audio v-else-if="list.type=='audio'" :src="video" class="fitimage" controls></audio>
                <iframe v-else-if="list.type=='document'" :src="video" width="100%" height="100%" />
              </div>
              <input name="file_data" v-validate="'required'"  type="hidden" v-model="list.file">
              <p  v-if="errors.has('file_data') && $nuxt.$route.name == 'dashboard-slider'" style="color:red">ছবি প্রয়োজন</p>
              <p  v-if="errors.has('file_data') && $nuxt.$route.name == 'dashboard-downloads'" style="color:red">পিডিএফ প্রয়োজন</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="CloseModal"
            data-dismiss="modal"
          >বাদ দিন</button>
          <button type="button" class="btn btn-primary" v-if="loader">
            <i class="fa fa-cog fa-spin"></i> সাবমিট
          </button>
          <button type="button" class="btn btn-primary" v-else @click="validate()">সাবমিট</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapMutations, mapGetters, mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate'
Vue.use(VeeValidate)
export default {
  name: 'UserCreate',
  data() {
    return {
      area: '',
      subarea: '',
      role: '',
      validateStatus: 0,
      loader: false,
      change_image:10,
      defaultList: {
        id: '',
        title: '',
        file: '',
        content_category: '',
        type: ''
      },
      index: '',
      list: {
        id: '',
        title: '',
        file: '',
        content_category: '',
        type: ''
      },
      video: '',
      file_ext: '',
      image_ext: ['jpg', 'jpeg', 'JPG', 'png', 'gif'],
      audio_ext: ['mp3', 'MP3', 'ogg', 'mpga'],
      video_ext: [
        'mp4',
        'mpeg',
        'avi',
        'mov',
        'mpeg-4',
        'wmv',
        'mpeg-ps',
        'flv',
        '3gpp',
        'webm',
        'gif'
      ],
      document_ext: ['doc', 'docx', 'pdf', 'pptx', 'ppt', 'xls', 'xlsx', 'txt'],
      content_type: 'image'
    }
  },
  methods: {
    onContentChange(e) {
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.list.file = files[0]
      this.video = files[0]
      var name = this.list.file.name
      this.file_ext = name.substring(name.indexOf('.') + 1)
      this.list.type = this.getType()
      this.createContent(files[0])
      this.change_image = 11
    },
    createContent(file) {
      let reader = new FileReader()
      let vm = this
      reader.onload = e => {
        vm.video = e.target.result
      }
      reader.readAsDataURL(file)
    },
    ContentRemoveFile: function() {
      this.list.file = ''
      this.change_image = 10
    },
    FileCheck(file) {
      if (file == this.file_ext) {
        return true
      } else {
        return false
      }
    },
    getType() {
      if (this.image_ext.find(this.FileCheck)) {
        return 'image'
      }
      if (this.audio_ext.find(this.FileCheck)) {
        return 'audio'
      }
      if (this.video_ext.find(this.FileCheck)) {
        return 'video'
      }
      if (this.document_ext.find(this.FileCheck)) {
        return 'document'
      }
    },
    areasearch({ title, id }) {
      return `${title}`
    },
    rolesearch({ name, id }) {
      return `${name}`
    },
    async get_sa() {
      try {
        await this.$store.dispatch('admin/Basic/get_sa', this.area.id)
      } catch (e) {}
    },
    
    CloseModal() {
      this.$parent.modalOpen = false
    },
    openModal(data, key) {
      if (data != '') {
        this.list = Object.assign({}, data)
        this.list.permission = Object.assign({}, data.permission)
        this.list.index = key
        this.video = this.list.file
        // this.list.type = 'image'
          if ($nuxt.$route.name == 'dashboard-slider') {
            this.list.type = 'image'
          } else if ($nuxt.$route.name == 'dashboard-downloads') {
            this.list.type = 'pdf'
          }
      } else {
        // this.list = this.defaultList
      }

      
      this.$parent.modalOpen = true
    },
    errorClear() {
      this.$store.commit('admin/user/user/set_errors', '')
    },
    async validate(){
      this.$store.commit('admin/slider/set_errors', '')
      this.$validator.validateAll().then(result => {
        if (result) {
          this.validateStatus = 1
          this.save();
        }
        else{
          this.validateStatus = 0
        }
      })
    },
    async save() {
      if (this.validateStatus == 1) {
        this.loader = true
        if (this.list.id == '') {
          if ($nuxt.$route.name == 'dashboard-slider') {
            this.list.content_category = 1
          } else if ($nuxt.$route.name == 'dashboard-downloads') {
            this.list.content_category = 2
          }
          this.list.change_image = this.change_image
          await this.$store
            .dispatch('admin/slider/add', this.list)
            .then(response => {
              this.loader = false
              this.$parent.modalOpen = false
              this.defaultList = this.defaultList
            })
            .catch(error => {
              this.loader = false
              this.formError = error.response.data
            })
        }
        else {
          if ($nuxt.$route.name == 'dashboard-slider') {
            this.list.content_category = 1
          } else if ($nuxt.$route.name == 'dashboard-downloads') {
            this.list.content_category = 2
          }
          this.list.change_image = this.change_image
          await this.$store
            .dispatch('admin/slider/add', this.list)
            .then(response => {
              this.loader = false
              this.$parent.modalOpen = false
              this.defaultList = this.defaultList
            })
            .catch(error => {
              this.loader = false
              this.formError = error.response.data
            })
        }
      }
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.content_type {
  top: -38px;
  position: absolute;
  text-align: right;
  right: 23px;
}
.content_active {
  background-color: #d70f0f !important;
}
.content_type > span {
  padding: 9px 13px;
  background-color: #1fc002;
  color: #fff;
  border-radius: 6px;
  margin: 2px;
  cursor: pointer;
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.logo_upload {
  border: 1px solid #ccc;
  width: 90%;
  height: 90px;
  background: #eceef0;
  text-align: center;
  cursor: pointer;
  margin: 4px;
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
#new_lesson_block .lesson_mat_caption {
  font-size: 18px;
  margin-top: -32px;
}
#new_lesson_block .lesson_mat_caption h4 {
  margin: 0;
  font-size: 18px;
  display: inline-block;
  background-color: #fff;
  padding: 0 10px;
  color: #777;
}
#new_lesson_block label {
  display: block;
  padding-bottom: 5px;
  color: #888;
}
#new_lesson_block .tool_box {
  display: flex;
  flex-direction: row;
  margin-bottom: 15px;
}
#new_lesson_block .tool_box:last-child {
  margin-bottom: 0;
}
#new_lesson_block .tool_box .item {
  margin-right: 14px;
  text-align: center;
  min-width: 90px;
  cursor: pointer;
}
#new_lesson_block .tool_box .item i {
  display: inline-block;
  color: #ccc;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 50%;
  width: 55px;
  height: 45px;
  line-height: 45px;
  transition: all 0.4s;
}
#new_lesson_block .tool_box .item:hover i {
  color: #aaa;
}
#new_lesson_block .tool_box .item span {
  display: block;
  margin-top: 5px;
  font-size: 14px;
  color: #999;
  font-weight: 600;
  transition: all 0.4s;
}
#new_lesson_block .tool_box .item:hover span {
  color: #666;
}
</style>