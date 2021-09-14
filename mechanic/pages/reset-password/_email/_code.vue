<template>
    <section class="section section-shaped section-lg my-0">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-md">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <card type="secondary" shadow
                          header-classes="bg-white pb-5"
                          body-classes="px-lg-5 py-lg-5"
                          class="border-0">
                        <template>
                            <div class="text-center text-muted mb-4">
                                <img width="200px;" src="../../../assets/logo.png" alt="">
                            </div>
                            <div v-if="formError" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-inner--text"><strong>{{formError}}!</strong> {{this.formError.error_description}}</span>
                                <button type="button" @click="SetLoginNotification" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form">
                                <base-input type="password" ref="password"  v-validate="'required'" name="password"  v-model="password" alternative
                                            class="mb-3"
                                            placeholder="পাসওয়ার্ড"
                                             addon-left-icon="ni ni-lock-circle-open">
                                </base-input>
                                <p  v-if="errors.has('password')" class="validation_message">* পাসওয়ার্ড প্রয়োজন</p>
                                <base-input type="password" ref="confirm_password"  v-validate="'required|confirmed:password'" name="confirm password"  v-model="confirm_password" alternative
                                            class="mb-3"
                                            placeholder="কনফার্ম পাসওয়ার্ড"
                                             addon-left-icon="ni ni-lock-circle-open">
                                </base-input>
                                <p  v-if="errors.has('confirm password')" class="validation_message">* পাসওয়ার্ড এর মিল নেই</p>
                                
                                <div class="text-center">
                                    <base-button style="background-color:rgba(117, 171, 40, 0.98)" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> সাবমিট</base-button>

                                    <base-button style="background-color:rgba(117, 171, 40, 0.98)" v-else @click="forgot"  type="primary"  class="my-4">সাবমিট</base-button>
                                </div>
                            </form>
                        </template>
                    </card>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
// 

Vue.use(VeeValidate)
export default {
    name: "Login",
    data(){
        return{
            validateStatus:0,
            loader:false,
            check:false,
            code:'',
            password:'',
            confirm_password:'',
            formError:'',
            email:''
        }
    },
   computed: {
        
    },
    mounted(){
        this.email = this.$route.params.email;
        this.code = this.$route.params.code;
    },
    methods: {
    SetLoginNotification(){
        this.formError = '';
    },
     forgot(){
         this.formError = '';
         var self = this;
         
         var data = {code:this.code,email:this.email,password:this.password}
         this.$validator.validateAll().then( result =>{
            if(result){
                self.loader = true;
                this.$axios
                .post('applicant-agency/reset-password',data)
                .then(response => {
                    self.loader = false;
                    this.$notify.success({
                        title: 'পাসওয়ার্ড',
                        message: 'পরিবর্তন করতে সফল হয়েছেন'
                    })
                    self.$router.push('/login');
                })
                .catch(error => {
                    self.loader = false;
                    self.formError = error.response.data.error
                    
                })
            }
             
        });
         
     }
      
   }
}
</script>
<style>
</style>
