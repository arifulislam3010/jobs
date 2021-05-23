<template>
    <div v-if="openModalStatus">
        <div class="black_overlay" @click="closeModal"></div>
        <div class="content_overlay">
            <div class="close_block clearfix">
                <div class="title float-left text_overflow max_one_line_allow">Migration</div>
                <div class="close_btn float-right"  @click="closeModal"><i class="fa fa-times"></i></div>
            </div>
            <div class="cur_content_block">
                <div class="custom-control custom-checkbox mb-3">
                    <input class="custom-control-input" v-model="status_data.migration_status" id="customCheck1" type="checkbox">
                    <label class="custom-control-label" for="customCheck1">Migrated</label>
                </div>
                <div class="form-group">
                    <input type="date" v-model="status_data.migration_date" class="form-control form-control-alternative" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                <button v-if="loader" style="float: right;margin: 3px;"  type="button" class="btn btn-primary">
                   <i class="fa fa-cog fa-spin"></i> Save
                </button>
                <button v-else style="float: right;margin: 3px;"  type="button" class="btn btn-primary" @click="statusUpdate">
                   Save
                </button>
                </div>
            </div>                
        </div>           
    </div>
</template>

<script>
// import { mapState,mapGetters } from "vuex";
// import {ENROLLED_ATTACHMENT} from "@/store/actions.type";
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';

Vue.use(VeeValidate)
    export default {
        middleware: 'guest',
        props: ['status_data'],
        data(){
            return{
                validateStatus:0,
                loader:false,
                check:false,
                user:{
                    email_or_phone:'',
                    password:''
                },
                formError:'',
                openModalStatus:false,               
            }
        },
        
        computed: {
           
        },
        methods: {
             closeModal(){
                this.openModalStatus = false;
            },
            openModal:function(){
                this.openModalStatus = true;
                
            },
            SetLoginNotification(){
            this.formError = '';
        },

        async statusUpdate () {
            this.loader = true;
            this.$parent.status_data.usera = this.$parent.usera
            await this.$store.dispatch('admin/user/user/statusUpdate',this.status_data).then(response => {
                this.loader = false;
                this.openModalStatus = false;
                this.$parent.status_data = this.$parent.d_status_data;
                 this.$parent.usera = [];
                 this.$parent.activate_status = false;
                this.formError={};
                this.$parent.get();
                this.loader = false;
            })
            .catch(error => {
                this.loader = false;
                this.formError = error.response.data;
            })
        },
        }
    }
</script>

<style scoped>
    .black_overlay{
        position: fixed;
        background-color:#91978ea1;
        width: 100%; height: 100%;
        transition: all 0.4s;
        z-index: 100;
        top:0px;
        left:0px;
    }
    .content_overlay{
        position: fixed;        
        width: 33%;
        height: 90%;
        left: 33%;
        top: 25%;
        transition: all 0.4s;
        z-index: 101;        
    }
    .content_overlay .close_block{
        padding: 10px 15px;
        background-color: #778dd6;
        color: #ffffff;
    }
    .content_overlay .close_block .title{
        font-size: 16px; width: calc(100% - 30px);
    }
    .content_overlay .close_block .close_btn{
        display: inline-block;
        cursor: pointer;
        width: 20px;
        height: 24px;
        text-align: center;
        line-height: 26px;
    }    
    .content_overlay .cur_content_block{
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        padding: 15px;
        height: 31%;
    }
    .sl_no,.req_info{
        line-height: 32px;
    }
    .sel_attachment_file_list,.divider,.upload_btn{
        float: left; line-height: 32px;
    }
    .sel_attachment_file_list{
        width: 150px;
    }
    .divider{
        width: 30px; text-align: center
    }
    .upload_btn{
        width: 100px;
        text-align: center;
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.4s;
    }
    .upload_btn:hover{
        background-color: #eee
    }
</style>