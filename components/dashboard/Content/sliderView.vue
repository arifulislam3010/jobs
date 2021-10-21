<template>
  <div
    class="modal fade bd-example-modal-lg"
    :class="this.$parent.slider_view ? 'show' : ''"
    id="exampleModal"
    :style="
      this.$parent.slider_view ? 'display: block; padding-right: 17px;' : ''
    "
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Slider</h5>
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
            <div>
              <p></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="CloseModal"
            data-dismiss="modal"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import { mapState, mapMutations, mapGetters, mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate'
Vue.use(VeeValidate)
export default {
  name: 'UserCreate',
  components: {
    Multiselect
  },

  computed: {
    ...mapGetters({
      lists_a: 'admin/Basic/lists_a',
      lists_sa: 'admin/Basic/lists_sa',
      lists_r: 'admin/user/role/lists'
    })
  },

  watch: {
    area: function(val, oldVal) {
      this.get_sa()
      this.subarea = ''
    }
  },

  data() {
    return {
      area: '',
      subarea: '',
      role: '',
      validateStatus: 0,
      loader: false,
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
    CloseModal() {
      this.$parent.slider_view = false
    },
    openSliderViewModal(data) {
      this.$parent.slider_view = true
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
