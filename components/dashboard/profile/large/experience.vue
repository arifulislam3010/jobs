<template>
  <div>
    <div class="row mobile-padding" v-for="(experience,key) in experiences" :key="key">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">কোম্পানী নাম <span class="required">*</span></label>
          <input
            :name="`${key}_company_Name`"
                v-validate="'required'"
                data-vv-as="company_Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.company_name"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_company_Name`)" class="validation_message col-md-8"><br>কোম্পানী নাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">পদবী <span class="required">*</span></label>
          <input
            :name="`${key}_post_held`"
                v-validate="'required'"
                data-vv-as="post_held"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.post_held"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_post_held`)" class="validation_message col-md-8"><br>পদবী প্রয়োজন</span>
        </div>
      </div>
      <div v-if="!isMobile" class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">শুরু <span class="required">*</span></label>
          <div class="col-md-9">
            <div  @click="find(key)" >
              <a-date-picker @change="serveForm"  placeholder="শুরু" style="margin-left:8%;width:92%" v-model="experience.serve_form"   
                :name="`${key}_serve_form`"
                v-validate="'required'"
                data-vv-as="serve_form"
              />
              <!-- <VueCtkDateTimePicker
                format='YYYY-MM-DD'
                formatted = 'll'
                :name="`${key}_serve_from`"
                v-validate="'required'"
                data-vv-as="serve_from"
                style="margin-left:18px;"
                label="শুরু"
                v-model="experience.serve_from"
                :only-date="true"
              /> -->
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_serve_from`)" class="validation_message col-md-8"><br>শুরু প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">শেষ <span class="required">*</span></label>
          <div class="col-md-9">
            <div @click="find(key)">
              <a-date-picker @change="serveTill"  placeholder="শেষ" style="margin-left:8%;width:92%" v-model="experience.serve_till"   
                :name="`${key}_serve_till`"
                v-validate="'required'"
                data-vv-as="serve_till"
              />
              <!-- <VueCtkDateTimePicker
                style="margin-left:18px;"
                format='YYYY-MM-DD'
                formatted = 'll'
                :name="`${key}_serve_till`"
                v-validate="'required'"
                data-vv-as="serve_till"
                label="শেষ"
                v-model="experience.serve_till"
                :only-date="true"
              /> -->
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_serve_till`)" class="validation_message col-md-8"><br>শেষ প্রয়োজন</span>
        </div>
        
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">সম্পর্কিত ব্যক্তি</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.contact_person"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">ফোন/ মোবাইল<span class="required">*</span></label>
          <input
            :name="`${key}_serve_phone`"
                v-validate="'required'"
                data-vv-as="serve_phone"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.phone"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_serve_phone`)" class="validation_message col-md-8"><br>ফোন/ মোবাইল প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">ইমেইল</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.email"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">দায়িত্ব</label>
          <textarea class="form-control col-md-8" v-model="experience.responsibility" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">অর্জন</label>
          <textarea class="form-control col-md-8" v-model="experience.achievement" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
      </div>
      <div v-if="isMobile" class="col-md-11 text-center">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div  v-if="experiences.length>(key+1)" class="col-md-11">
          <hr style="width:100%;">
      </div>
    </div>
    <div class="row ">
        <div class="col-md-12 text-center">
            <button @click="addMore()" class="btn btn-secondary btn-sm">আরো যোগ করুন</button>
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
        <!-- <button type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save & next
          <i class="fas fa-arrow-right"></i>
        </button> -->
      </div>
    </div>
    <div style="height:290px;"></div>
  </div>
</template>
<script>
// import address from "~/components/dashboard/profile/large/address"
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
import { isMobile } from 'mobile-device-detect';
export default {
  components: { VueCtkDateTimePicker },
  data() {
    return {
      isMobile:isMobile,
      validate_status:false,
      keyvlaue:-1,
      loader:false,
      experiences:[{company_name:'',contact_name:'',post_held:'',serve_form:'',serve_till:'',address:'',phone:'',contact_person:'',email:'',responsibility:'',achievement:''}]
    }
  },
  methods:{
    find(key){
      this.keyvlaue = key;
    },
    serveForm(date, dateString) {
      this.experiences[this.keyvlaue].serve_form = dateString
    },
    serveTill(date, dateString) {
      this.experiences[this.keyvlaue].serve_till = dateString
    },
    validate(){
      this.$validator.validateAll().then(result => {
        if(result){
          this.validate_status = true;
          this.saveData();
          //  alert("ok");
        }
        else{
          this.validate_status = false;
        }
      })
    },
    addMore(){
      var data = {company_name:'',contact_name:'',post_held:'',serve_form:'',serve_till:'',address:'',phone:'',contact_person:'',email:'',responsibility:'',achievement:''};
      this.experiences.push(data)
    },
    remove(index){
      this.experiences.splice(index,1)
    },
    saveData() {
      if(this.validate_status) {
        this.loader = true;
        var data = {
          experiences: this.experiences,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/experience-info', data)
          .then(response => {
            // this.experiences = response.data.experiences
            this.$emit('clicked', response.data.progress)
            this.loader = false;
            this.$notify.success({
              title: 'Experience info',
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
            if (response.data.experiences) {
              this.experiences = response.data.experiences
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  },
  mounted(){
    this.get();
  }
}
</script>
<style scoped>
.required{
  color:red
}
@media only screen and (max-width: 600px) {
  .mobile-padding{
    padding:0px 5px 0px 15px;
  }
}
</style>