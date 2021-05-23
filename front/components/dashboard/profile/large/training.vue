<template>
  <div>
    <div v-for="(training,key) in trainings" :key="key" class="row mobile-padding">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">প্রশিক্ষনের নাম<span class="required">*</span></label>
          <input
            :name="`${key}_training_name`"
                v-validate="'required'"
                data-vv-as="training_name"
            class="col-md-8 form-control"
            type="text"
            v-model="training.training_name"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_training_name`)" class="validation_message col-md-8"><br>প্রশিক্ষনের নাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">ট্রেনিং সেন্টার<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                :name="`${key}_training_center`"
                v-validate="'required'"
                data-vv-as="_training_center"
                v-model="training.training_center"
                placeholder="ট্রেনিং সেন্টার"
                label="name"
                track-by="id"
                :options="training_centers"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_training_center`)" class="validation_message col-md-8"><br>ট্রেনিং সেন্টার প্রয়োজন</span>
        </div>
      </div>
      <div v-if="!isMobile" class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">সময়কাল<span class="required">*</span></label>
          <input
            :name="`${key}_duration`"
                v-validate="'required'"
                data-vv-as="_duration"
            class="col-md-8 form-control"
            type="text"
            v-model="training.duration"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_duration`)" class="validation_message col-md-8"><br>সময়কাল প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">বিস্তারিত<span class="required">*</span></label>
          <textarea :name="`${key}_description`"
                v-validate="'required'"
                data-vv-as="_description" v-model="training.description" class="form-control col-md-8" id="exampleFormControlTextarea1" rows="2"></textarea>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_description`)" class="validation_message col-md-8"><br>বিস্তারিত প্রয়োজন</span>
        </div>
      </div>
      <div v-if="isMobile" class="col-md-11 text-center">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div  v-if="trainings.length>(key+1)" class="col-md-11">
          <hr style="width:100%;">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <button @click="addMore" class="btn btn-secondary btn-sm">আরো যোগ করুন</button>
      </div>
    </div>
    <div class="row ">
        <div class="col-md-8"></div>
      <div class="col-md-3">
        <button style="background-color:#75ab28;float:right" v-if="loader"  type="button" class="btn btn-primary btn-md">
          <i class="fa fa-cog fa-spin"></i> আপডেট
        </button>
        <button style="background-color:#75ab28;float:right" v-else @click="validate()" type="button" class="btn btn-primary btn-md">
          আপডেট
        </button>
      </div>
    </div>
    <div style="height:290px;"></div>
  </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
import { isMobile } from 'mobile-device-detect';
export default {
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  props: ['training_centers'],
  data() {
    return {
      isMobile:isMobile,
      validate_status:false,
      loader:false,
      trainings:[{training_name:'',training_center:'',duration:'',description:''}]
    }
  },
  mounted(){
    this.get();
  },
  methods:{
    validate(){
      this.$validator.validateAll().then(result => {
        if(result){
          this.validate_status = true;
          this.saveData();
        }
        else{
          this.validate_status = false;
        }
      })
    },
      addMore(){
          var data = {training_name:'',training_center:'',duration:'',description:''}
          this.trainings.push(data)
      },
      remove(index){
        this.trainings.splice(index,1)
      },
      saveData() {
      if(this.validate_status) {
        this.loader = true;
        var data = {
          trainings: this.trainings,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/training-info', data)
          .then(response => {
            this.loader = false;
            this.$emit('clicked', response.data.progress)
            this.$notify.success({
              title: 'Training ',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {
            this.loader = false;
          })
      } 
    },
    get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            if (response.data.trainings) {
              this.trainings = response.data.trainings
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  }
}
</script>
<style scoped>
  @media only screen and (max-width: 600px) {
    .mobile-padding{
      padding:0px 5px 0px 15px;
    }
  }
</style>