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
                          class="border-0" style="background: #eee !important;color:#fff !important,opacity:0.5">
                        <template>
                            <div class="text-center mb-4">
                                <img width="200px;" src="../assets/logo.png" alt="">
                            </div>
                            <div v-if="this.formError" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="fas fa-exclamation-triangle"></i></span>
                                <span class="alert-inner--text"><strong>{{this.formError.error}}</strong></span>
                                <button type="button" @click="SetLoginNotification" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form">
                                <base-input @keyup.enter="trigger" v-validate="'required'" data-vv-as="email" name="email_field"  v-model="login.email" alternative
                                            class="mb-3"
                                            placeholder="ইমেইল/ মোবাইল"
                                            addon-left-icon="ni ni-email-83">
                                </base-input>
                                <p  v-if="errors.has('email_field')" class="validation_message">* ইমেইল/মোবাইল প্রয়োজন</p>
                                <base-input @keyup.enter="trigger" name="password"  v-validate="'required'"  v-model="login.password" alternative
                                            type="password"
                                            placeholder="পাসওয়ার্ড"
                                            addon-left-icon="ni ni-lock-circle-open">
                                </base-input>
                                <p  v-if="errors.has('password')" class="validation_message">* পাসওয়ার্ড  প্রয়োজন</p>
                                <!-- <base-checkbox>
                                    Remember me
                                </base-checkbox> -->
                                <input  @click="Login" ref="sendReply" type="hidden">
                                <n-link  class="text" to="/forgot-password" ><small>পাসওয়ার্ড ভুলে গেছেন?</small></n-link>
                                <div class="text-center">
                                    <base-button style="background-color:rgb(117,171,40);border:rgb(117,171,40);border-radius:0" v-if="loader"  type="primary"  class="my-4"> <i class="fa fa-cog fa-spin"></i> লগইন</base-button>

                                    <base-button style="background-color:rgb(117,171,40);border:rgb(117,171,40);border-radius:0" v-else @click="Login"   type="primary"  class="my-4">লগইন</base-button>
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
            validateStatus:false,
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
        trigger () {
            this.$refs.sendReply.click()
        },
        async Login () {
            // this.$store.commit('admin/user/login/SET_LOGIN_NOTIFICATION');
            this.$validator.validateAll().then( result =>{
                if(result){
                    this.validateStatus = true;
                    this.login2();
                }
                else{
                   this.validateStatus = false; 
                } 
            });       
            
        },
        async login2(){
            if(this.validateStatus){
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
                }).catch(error => {
                    this.loader = false;
                    this.formError = error.response.data;
                })

            }
        }
      
   }
}
</script>
<style>
 
</style>
