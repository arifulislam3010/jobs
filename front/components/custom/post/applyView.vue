<template>
    <div class="modal fade bd-example-modal-lg" :class="this.$parent.applyModalOpen?'show':''" id="exampleModal" :style="this.$parent.applyModalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apply</h5>
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
                    <input type="text" v-validate="'required'" v-model="list.name" class="form-control" placeholder="Name" name="name" aria-label="Name...">
                  </div>
                </div>
                <p v-if="errors.has('name')" class="validation_message">* {{ errors.first('name') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.name!='undefined'">
                  <p v-for="(error,k) in $store.state.admin.post.errors.errors.name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">Contact</label>
                  <div class="input-group">
                    <input type="text" v-validate="'required'" v-model="list.contact" class="form-control" placeholder="contact" name="contact" aria-label="contact...">
                  </div>
                </div>
                <p v-if="errors.has('contact')" class="validation_message">* {{ errors.first('contact') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.contact!='undefined'">
                  <p v-for="(error,k) in $store.state.admin.post.errors.errors.contact" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="typo__label">Email</label>
                  <div class="input-group">
                    <input type="email" v-validate="'required'" v-model="list.email" class="form-control" placeholder="Email" name="email" aria-label="deadline...">
                  </div>
                </div>
                <p v-if="errors.has('email')" class="validation_message">* {{ errors.first('email') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.email!='undefined'">
                  <p v-for="(error,k) in $store.state.admin.post.errors.errors.email" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <label class="typo__label">Resume</label>
                <div class="input-group">
                  <input type="file" v-validate="'required'" class="form-control" placeholder="resume" name="resume" aria-label="deadline...">
                </div>
                </div>
                <p v-if="errors.has('resume')" class="validation_message">* {{ errors.first('resume') }}</p>
                <div v-if="$store.state.admin.post.errors.errors && $store.state.admin.post.errors.errors.resume!='undefined'">
                  <p v-for="(error,k) in $store.state.admin.post.errors.errors.resume" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" @click="CloseModal" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-sm btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> Save changes</button>
          <button type="button" class="btn btn-sm btn-primary" v-else @click="save">Post</button>
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
Vue.use(VeeValidate)
export default {
  name: "applyView",
  data() {
    return {
      role:'',
      validateStatus:0,
      loader:false,
      defaultList: {
        id:"",
        name: "",
        contact: "",
        email:'',
        resume:'',
      },
      list:{
        id:"",
        name: "",
        contact: "",
        email:'',
        resume:'',
      },
    }
  },
  methods: {
    rolesearch({ name, id }){
      return `${name}`
    },
    CloseModal(){
      this.$parent.applyModalOpen = false;
      this.list = this.defaultList;
    },
    openModal(id) {
      if(id!=0){
        this.list.id = id;
        this.$parent.applyModalOpen = true;
      }
    },
    errorClear(){
      this.$store.commit('admin/post/set_errors','');
    },
    async save () {
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
          await this.$store.dispatch('admin/post/apply',this.list).then(response => {
            this.loader = false;
            this.$parent.applyModalOpen = false;
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