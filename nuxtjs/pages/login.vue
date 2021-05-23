<template>
    <section class="section section-shaped my-0">
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
                          class="border-0" style="background: #44844f !important;">
                        <template>
                            <div class="text-center mb-4">
                                <small>লগইন করুন</small>
                            </div>
                            <div v-if="this.formError" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-inner--text"><strong>Danger!</strong> {{this.formError.error_description}}</span>
                                <button type="button" @click="SetLoginNotification" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form">
                                <base-input  v-validate="'required|email'" data-vv-as="email" name="email_field"  v-model="login.email" alternative
                                            class="mb-3"
                                            placeholder="Email"
                                            addon-left-icon="ni ni-email-83">
                                </base-input>
                                <p  v-if="errors.has('email_field')" class="validation_message">* {{ errors.first('email_field') }}</p>
                                <base-input name="password"  v-validate="'required'"  v-model="login.password" alternative
                                            type="password"
                                            placeholder="Password"
                                            addon-left-icon="ni ni-lock-circle-open">
                                </base-input>
                                <p  v-if="errors.has('password')" class="validation_message">* {{ errors.first('password') }}</p>
                                <!-- <base-checkbox>
                                    Remember me
                                </base-checkbox> -->
                                <n-link  class="text-light" to="/forgot-password" ><small>পাসওয়ার্ড ভুলে গেছেন?</small></n-link>
                                <div class="text-center">
                                    <base-button v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> লগইন</base-button>

                                    <base-button v-else @click="Login"  type="primary"  class="my-4">লগইন</base-button>
                                </div>
                            </form>
                        </template>
                    </card>
                    <!-- <div class="row mt-3">
                        <div class="col-6">
                            <n-link  class="text-light" to="/forgot-password" ><small>Forgot password?</small></n-link>
                        </div>
                        <div class="col-6 text-right">
                            <n-link  class="text-light" to="/register" ><small>Create new account</small></n-link>
                        </div>
                    </div> -->
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
    middleware: 'guest',
    name: "Login",
    data(){
        return{
            validateStatus:0,
            loader:false,
            check:false,
            login:{
                email:'',
                password:''
            },
            formError:'',
        }
    },
   computed: {
        
    },

    methods: {
        // ...mapActions({
        //    Login: 'admin/user/login/login'
        // }),
        // ...mapMutations({
        //    SetLoginNotification: 'admin/user/login/SET_LOGIN_NOTIFICATION'
        // }),
        SetLoginNotification(){
            this.formError = '';
        },

        async Login () {
            // this.$store.commit('admin/user/login/SET_LOGIN_NOTIFICATION');
            this.$validator.validateAll().then( result =>{
            if(result){
                this.validateStatus = 1;
                }  
            });

            if(this.validateStatus==1){
                this.loader =true;
                await this.$auth.loginWith('password_grant', {
                    data: {
                    grant_type: 'password',
                    client_id: process.env.PASSPORT_PASSWORD_GRANT_ID,
                    client_secret: process.env.PASSPORT_PASSWORD_GRANT_SECRET,
                    scope: '',
                    username: this.login.email,
                    password: this.login.password
                    }
                }).then(response => {
                    this.loader = false;
                })
                .catch(error => {
                    this.loader = false;
                    console.log(error.response.data);
                   this.formError = error.response.data;
                })

            }
                
            
        },
      
   }
}
</script>
<style>
</style>
