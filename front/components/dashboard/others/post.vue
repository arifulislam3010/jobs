<template>
    <div class="modal fade"  :class="modalOpen?'show':''" id="exampleModal"  :style="modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 v-if="header == 'districts'" class="modal-title" id="exampleModalLabel">জেলা</h5>
            <h5 v-if="header == 'divisions'" class="modal-title" id="exampleModalLabel">বিভাগ</h5>
            <h5 v-if="header == 'subdistricts'" class="modal-title" id="exampleModalLabel">উপজেলা</h5>
            <h5 v-if="header == 'unions'" class="modal-title" id="exampleModalLabel">ইউনিয়ন</h5>
            <h5 v-if="header == 'jobs'" class="modal-title" id="exampleModalLabel">কাঙ্খিত চাকুরি</h5>
            <h5 v-if="header == 'countries'" class="modal-title" id="exampleModalLabel">দেশ</h5>
            <h5 v-if="header == 'languages'" class="modal-title" id="exampleModalLabel">ভাষা</h5>
            <h5 v-if="header == 'boards'" class="modal-title" id="exampleModalLabel">শিক্ষা বোর্ড</h5>
            <h5 v-if="header == 'boards'" class="modal-title" id="exampleModalLabel">শিক্ষা বোর্ড</h5>
            <h5 v-if="header == 'degrees'" class="modal-title" id="exampleModalLabel">ডিগ্রির নাম</h5>

            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
              <div class="row">
                <div v-if="list.type == 'unions'" class="col-md-6">
                    <label for="">উপজেলা</label>
                    <select v-validate="'required'" name="parent" v-model="list.parent_id" class="form-control">
                      <option value=''>উপজেলা</option>
                      <option v-for="(list,key) in subdistricts.data" :key="key" :value="list.id">{{list.name}}</option>
                    </select>
                    <p  v-if="errors.has('parent') && check" class="validation_message">* উপজেলা প্রয়োজন</p>
                </div>
                <div v-if="list.type == 'subdistricts'" class="col-md-6">
                    <label for="">জেলা</label>
                    <select v-validate="'required'" name="parent" v-model="list.parent_id" class="form-control">
                      <option value=''>জেলা</option>
                      <option v-for="(list,key) in districts.data" :key="key" :value="list.id">{{list.name}}</option>
                    </select>
                    <p  v-if="errors.has('parent') && check" class="validation_message">* জেলা প্রয়োজন</p>
                </div>
                <div v-if="list.type == 'districts'" class="col-md-6">
                    <label for="">বিভাগ</label>
                    <select v-validate="'required'" name="parent" v-model="list.parent_id" class="form-control">
                       <option value=''>বিভাগ</option>
                        <option v-for="(list,key) in divisions.data" :key="key" :value="list.id">{{list.name}}</option>
                    </select>
                    <p  v-if="errors.has('parent') && check" class="validation_message">* বিভাগ প্রয়োজন</p>
                </div>
                <div class="col-md-6">
                    <label for="">নাম</label>
                    <input name="name" v-model="list.name" v-validate="'required'" class="form-control" type="text">
                    <p  v-if="errors.has('name') && check" class="validation_message">* নাম প্রয়োজন</p>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
          <button type="button" class="btn btn-primary" v-if="loader">
                <i class="fa fa-cog fa-spin"></i> Save changes
              </button>
          <button type="button" class="btn btn-primary" v-else @click="validate">Save changes</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
export default {
  data() {
    return {
        modalOpen:false,
        loader:false,
        list:{
          name:'',
          parent_id:'',
          index : '',
          type : '',
          id:''
        },
        header:'',
        validateStatus : 0,
        check:false
    }
  },
  computed: mapGetters({
    divisions: 'admin/others/divisions',
    districts: 'admin/others/districts',
    subdistricts: 'admin/others/subdistricts',
  }),
  methods: {
    validate(){
      this.check = true;
      this.$validator.validateAll().then( result =>{
        if(result){
          this.validateStatus = 1;
          this.save();
        }
        else{
          this.validateStatus = 0;
        }
      });
    },
    save(){
      if(this.validateStatus){
        this.loader = true
        if(this.list.index){
          this.$store.dispatch('admin/others/update',this.list).then(Response=>{
            this.loader = false
            this.check = false
            this.list.name = ''
            this.list.parent_id = ''
            this.modalOpen = false
          })
        }
        else{
          this.$store.dispatch('admin/others/add',this.list).then(Response=>{
            this.loader = false
            this.check = false
            this.list.name = ''
            this.list.parent_id = ''
            this.modalOpen = false
          })
        }
      }
    },
    openModal(data,key,type,header) {
      this.header = header
      this.list.name = data.name
      if(data.parent_id == 'undefined'){
        this.list.parent_id = ''
      }
      else{
        this.list.parent_id = data.parent_id
      }
      this.list.index = key
      this.list.type = type
      if(this.list.index){
        this.list.id = data.id
      }
      this.modalOpen = true
    },
    CloseModal() {
        this.modalOpen = false
    }
  }
};
</script>
<style scoped>
.required{
  color:red;
}
.logo_upload{
    border: 1px solid #ccc;
    width: 100%;
    height: 90px;
    background: #eceef0;
    text-align: center;
    cursor: pointer;
}
.image_upload p{
    margin-top: 10px;
    font-size: 12px;
}

.image_upload i{
    font-size: 34px;
}
.removeImage{
   position: absolute;
    right: 13px;
    top:  14px;
    color: var(--white);
    border: 1px solid;
    border-radius: 25px;
    padding: 4px 8px;
    background-color: #fb1212f5;
    font-size: 10px;
    font-family: cursive;
}
.fitimage {
    width: 32%;
    height: 100%;
    -o-object-fit: contain;
    object-fit: contain;
    background-color: #e6e6ef;
}
.modal {
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

</style>