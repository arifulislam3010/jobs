<template>
    <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Role</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <div v-if="$store.state.admin.user.role.errors.error" class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                      <span class="alert-inner--text"><strong>Warning!</strong> {{$store.state.admin.user.role.errors.error}}</span>
                      <button type="button" class="close" @click="errorClear" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                    <div class="form-group">
                      <div class="input-group">
                          <input type="text"  v-validate="'required'" v-model="list.name" class="form-control" placeholder="Role Title" name="name" aria-label="Role Title...">
                      </div>
                    </div>
                    <p  v-if="errors.has('name')" class="validation_message">* {{ errors.first('name') }}</p>
                   
                    <div v-if="$store.state.admin.user.role.errors.errors && $store.state.admin.user.role.errors.errors.name!='undefined'">
                      <p  v-for="(error,k) in $store.state.admin.user.role.errors.errors.name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
                    </div>
                    <table class="table table-striped table_fields">
                      <thead>
                        <tr>
                          <th scope="col">Module</th>
                          <th scope="col">Create</th>
                          <th scope="col">View</th>
                          <th scope="col">View All</th>
                          <th scope="col">Update</th>
                          <th scope="col">Update All</th>
                          <th scope="col">Delete</th>
                          <th scope="col">Delete All</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Role</td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_view" id="role_view" type="checkbox">
                                  <label class="custom-control-label" for="role_view"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_viewall" id="role_viewall" type="checkbox">
                                  <label class="custom-control-label" for="role_viewall"></label>
                              </div>
                          </td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_create" id="role_create" type="checkbox">
                                  <label class="custom-control-label" for="role_create"></label>
                              </div>
                              
                          </td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_update" id="role_update" type="checkbox">
                                  <label class="custom-control-label" for="role_update"></label>
                              </div>
                            
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_updateall" id="role_updateall" type="checkbox">
                                  <label class="custom-control-label" for="role_updateall"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_delete" id="role_delete" type="checkbox">
                                  <label class="custom-control-label" for="role_delete"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.role_deleteall" id="role_deleteall" type="checkbox">
                                  <label class="custom-control-label" for="role_deleteall"></label>
                              </div>
                          </td>
                        </tr>
                        <tr>
                          <td>User</td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_view" id="user_view" type="checkbox">
                                  <label class="custom-control-label" for="user_view"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_viewall" id="user_viewall" type="checkbox">
                                  <label class="custom-control-label" for="user_viewall"></label>
                              </div>
                          </td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_create" id="user_create" type="checkbox">
                                  <label class="custom-control-label" for="user_create"></label>
                              </div>
                              
                          </td>
                          <td>
                              <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_update" id="user_update" type="checkbox">
                                  <label class="custom-control-label" for="user_update"></label>
                              </div>
                            
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_updateall" id="user_updateall" type="checkbox">
                                  <label class="custom-control-label" for="user_updateall"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_delete" id="user_delete" type="checkbox">
                                  <label class="custom-control-label" for="user_delete"></label>
                              </div>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox mb-3">
                                  <input class="custom-control-input" v-model="list.permission.user_deleteall" id="user_deleteall" type="checkbox">
                                  <label class="custom-control-label" for="user_deleteall"></label>
                              </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
export default {
  name: "RoleCreate",
  data() {
    return {
      validateStatus:0,
      loader:false,
      defaultList: {
        name: "",
        id: "",
        permission: {
          role_view: false,
          role_viewall: true,
          role_create: false,
          role_update: false,
          role_updateall: false,
          role_delete: false,
          role_deleteall: false,

          user_view: false,
          user_viewall: true,
          user_create: false,
          user_update: false,
          user_updateall: false,
          user_delete: false,
          user_deleteall: false,
        }
      },
      index:'',
      list:{
        name: "",
        id: "",
        permission: {
          role_view: false,
          role_viewall: true,
          role_create: false,
          role_update: false,
          role_updateall: false,
          role_delete: false,
          role_deleteall: false,

          user_view: false,
          user_viewall: true,
          user_create: false,
          user_update: false,
          user_updateall: false,
          user_delete: false,
          user_deleteall: false,
        }
      },
    }
  },
  methods: {
    CloseModal(){
        this.$parent.modalOpen = false;
    },
    openModal(data,key) {
      if(data!=''){
        this.list = Object.assign({},data);
        this.list.permission = Object.assign({},data.permission);
        this.index = key;
      }else{
        this.list = this.defaultList;
      }
      
      console.log('this.list');
      console.log(this.list);
      console.log(this.defaultList);
      this.$parent.modalOpen = true;
    },
    errorClear(){
      this.$store.commit('admin/user/role/set_errors','');
    },
    async save () {
            this.$store.commit('admin/user/role/set_errors','');
            this.$validator.validateAll().then( result =>{
            if(result){
                this.validateStatus = 1;
                }  
            });

            if(this.validateStatus==1){
                this.loader =true;
                if(this.list.id==''){
                  await this.$store.dispatch('admin/user/role/add',this.list).then(response => {
                      this.loader = false;
                      this.$parent.modalOpen = false;
                      this.defaultList = this.defaultList;
                  })
                  .catch(error => {
                      this.loader = false;
                    this.formError = error.response.data;
                  })
                }else{
                  await this.$store.dispatch('admin/user/role/update',{index:this.index,list:this.list}).then(response => {
                      this.loader = false;
                      // this.$parent.modalOpen = false;
                      this.defaultList = this.defaultList;
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