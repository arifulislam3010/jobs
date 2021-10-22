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
                                <img width="100px;" src="~/assets/icon/logo_custom.png" alt="">
                                <br>
                                <small style="font-size:16px;">Forget your password</small>
                            </div>
                            <div v-if="formError" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-inner--text"><strong>{{formError}}!</strong> {{this.formError.error_description}}</span>
                                <button type="button" @click="SetLoginNotification" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div v-if="notification" class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-inner--text"><strong>{{notification}}!</strong> {{this.formError.error_description}}</span>
                                <button type="button" @click="SetLoginNotification" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form">
                                <base-input  v-validate="'required'" data-vv-as="email/phone" name="email_field"  v-model="login.email" alternative
                                            class="mb-3"
                                            placeholder="email/phone"
                                            addon-left-icon="ni ni-email-83">
                                </base-input>
                                <p  v-if="errors.has('email_field')" class="validation_message">* Email / phone required</p>
                                
                                <div class="text-center">
                                    <base-button style="background-color:rgb(117,171,40);" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> Submit</base-button>

                                    <base-button style="background-color:rgb(117,171,40);" v-else @click="forgot"  type="primary"  class="my-4">Submit</base-button>
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
            login:{
                email:''
            },
            formError:'',
            notification:'',
        }
    },
   computed: {
        
    },

    methods: {
    SetLoginNotification(){
        this.formError = '';
        this.notification = '';
        
    },
     forgot(){
         this.formError = '';
        
         var self = this;
         self.loader = true;
         var data = {email:this.login.email}
         this.$validator.validateAll().then( result =>{
            if(result){
                this.$axios
                .post('applicant-agency/forgot-password',data)
                .then(response => {
                    self.loader = false;
                    if(response.data.phone == 'phone'){
                        self.$router.push('/reset-password/'+self.login.email);
                    }else{
                        self.notification = response.data.success
                        self.loader = false;
                    }
                                     
                })
                .catch(error => {
                    self.loader = false;
                    self.formError = error.response.data.error
                    
                })
            }
            else{
                this.loader = false;
            }
             
        });
         
     }
      
   }
}
</script>
<style>
</style>
