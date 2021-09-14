<template>
  <div>
    <div class="row mobile-padding" v-for="(language,key) in languages" :key="key">
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label style="font-size:13px;" for="inputPassword" class="col-md-4 labels">ভাষা<span class="required">*</span></label> 
          <div class="col-md-8">
              <multiselect
                selectLabel=""
                deselectLabel=""
                :name="`${key}_language`"
                v-validate="'required'"
                data-vv-as="language"
                v-model="language.language"
                placeholder="ভাষা"
                label="name"
                track-by="id"
                :options="language_list"
              ></multiselect>
            </div>
            <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_language`)" class="validation_message col-md-8"><br>ভাষা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">মৌখিক দক্ষতা<span class="required">*</span></label>
          <select :name="`${key}_oral_skill`"
                v-validate="'required'"
                data-vv-as="oral_skill" v-model="language.oral_skill" class="form-control col-md-8">
            <option value="">মৌখিক দক্ষতা</option>
            <option value="দুর্দান্ত">দুর্দান্ত</option>
            <option value="ভাল">ভাল</option>
            <option value="কার্যক্ষম">কার্যক্ষম</option>
          </select>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_oral_skill`)" class="validation_message col-md-8"><br>মৌখিক দক্ষতা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">লিখন দক্ষতা<span class="required">*</span></label>
          <select :name="`${key}_writing_skill`"
                v-validate="'required'"
                data-vv-as="writing_skill" v-model="language.writing_skill" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">লিখন দক্ষতা</option>
            <option value="দুর্দান্ত">দুর্দান্ত</option>
            <option value="ভাল">ভাল</option>
            <option value="কার্যক্ষম">কার্যক্ষম</option>
          </select>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`${key}_writing_skill`)" class="validation_message col-md-8"><br>লিখন দক্ষতা প্রয়োজন</span>
        </div>
      </div>
      <div v-if="!isMobile" class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div v-if="isMobile" class="col-md-11 text-center">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div  v-if="languages.length>(key+1)" class="col-md-11">
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
import Multiselect from 'vue-multiselect'
import { isMobile } from 'mobile-device-detect';
export default {
  components: {
    Multiselect
  },
  data(){
    return{
      validate_status:false,
      isMobile:isMobile,
      loader:false,
      language_list:[],
      languages:[{language:'',writing_skill:'',oral_skill:'',}],
      language:{}
    }
  },
  methods:{
    validate(){
      this.$validator.validateAll().then(result => {
        if(result){
          this.saveData();
          //  alert("ok");
        }
      })
    },
    async getLanguage() {
      this.$axios
        .get('api/get-language')
        .then(response => {
          this.language_list = response.data
        })
        .catch(error => {})
    },
    addMore(){
      var data = {language:'',writing_skill:'',oral_skill:'',};
      this.languages.push(data)
    },
    remove(index){
       this.languages.splice(index,1)
    },
    saveData() {
      this.loader = true;
      try {
        var data = {
          languages: this.languages,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/language-info', data)
          .then(response => {
            this.loader = false;
            // this.languages = response.data.languages
            this.$emit('clicked', response.data.progress)
            this.$notify.success({
              title: 'Language info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {
            this.loader = false;
          })
      } catch (error) {
        this.loader = false;
      }
    },
    get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            if (response.data.languages) {
              this.languages = response.data.languages
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  },
  mounted(){
    this.getLanguage(),
    this.get()
  }
}
</script>
<style>
.required{
  color:red
}
@media only screen and (max-width: 600px) {
  .mobile-padding{
    padding:0px 5px 0px 15px;
  }
}
</style>