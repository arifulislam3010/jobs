<template>
  <div>
    <div id="myModal" :class="this.$parent.file_modal_open?'modal':''">
      <!-- Modal content -->
      <div class="modal-content">
        <span @click="fileModalClose" class="close">&times;</span>
        <div class="col-md-12">
          <div style="margin-bottom:20px;margin-top:10px;">
            <input v-model="title" type="text"> <button @click="get()">Search</button>
            <button style="width:100px;" @click="fileCreateModalOpen" class="btn-primary btn-sm">Add</button>
          </div>
        </div>
        <div class="row">
          
    
          <div v-for="(list,key) in lists.data" :key="key" class="col-md-3" style="position:relative">
            <span @click="doCopy(list)" style="margin-left:30px;position:absolute;background-color:green;width:50px;border-radius:20px;cursor:pointer;color:#fff">Copy!</span>
            <span @click="remove(list.id,key)" style="position:absolute;background-color:red;width:30px;border-radius:20px;cursor:pointer;color:#fff">&nbsp;&nbsp;X</span>
              <img style="height:200px;width:100%;overflow: visible;" :src="list.file" alt="">
              
          </div>
          <pagination :data="this.lists" @pagination-change-page="get" :limit="5"></pagination>
        </div>
      </div>
    </div>
    <filemanagercreate ref="file_maneger_create"></filemanagercreate>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import filemanagercreate from '~/components/dashboard/file-manager/create'
import pagination from 'laravel-vue-pagination'
import Vue from 'vue'
import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)
export default {
  components: {
    filemanagercreate,
    pagination
  },
  computed: mapGetters({
    lists: 'admin/slider/lists'
  }),
  mounted() {
    this.get()
  },
  data() {
    return {
      file_manager_create: false,
      title:'',
    }
  },
  methods: {
    doCopy: function (list) {
        this.$copyText(list.file).then(function (e) {
          alert('Copied')
          console.log(e)
        }, function (e) {
          alert('Can not copy')
          console.log(e)
        })
      },
    async remove(id,key){
      await this.$store.dispatch('admin/slider/removeContent',{key:key,id:id}).then(response => {
        this.list = response.data;
      })
      .catch(error => {
        
      })
    },
    fileModalOpen() {
      this.$parent.file_modal_open = true
    },
    fileModalClose() {
      this.$parent.file_modal_open = false
    },
    fileCreateModalOpen() {
      // alert("ok");
      this.$refs.file_maneger_create.fileCreateModalOpen()
    },
    async get(page = 1) {
      let search = { content_category: 3, limit: 4,page:page,title:this.title }
      try {
        await this.$store.dispatch('admin/slider/get', search)
      } catch (e) {}
    }
  }
}
</script>
<style  scoped>
.modal {
  display: block; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 70%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>