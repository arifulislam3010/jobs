<template>
  <div>
    <div v-for="(education,key) in educations" :key="key" class="row mobile-padding">
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">ডিগ্রীর নাম<span class="required">*</span></label>
          <select :name="`degree_name_${key}`" data-vv-as="degree"
            v-validate = "'required'" v-model="education.degree" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">ডিগ্রীর নাম</option>
            <option v-for="(year,key) in years" :key="key">{{year.year}}</option>
          </select>
          <!-- <input
            :name="`${key}_degree_name`"
            v-validate="'required'"
            data-vv-as="degree"
            class="col-md-8 form-control"
            type="text"
            v-model="education.degree"
          /> -->
          <span class="col-md-4"></span>
          <span v-if="errors.has(`degree_name_${key}`)" class="validation_message col-md-8"><br>ডিগ্রীর নাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">পাশের সন<span class="required">*</span></label>
          <input
            :name="`p_year_${key}`" data-vv-as="p-year"
            v-validate = "'required'" v-model="education.p_year" class="form-control col-md-8"
            type="number"
          />
          <!-- <select :name="`p_year_${key}`" data-vv-as="p-year"
            v-validate = "'required'" v-model="education.p_year" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">পাশের সন </option>
            <option v-for="(year,key) in years" :key="key">{{year.year}}</option>
          </select> -->
          <span class="col-md-4"></span>
          <span v-if="errors.has(`p_year_${key}`)" class="validation_message col-md-8"><br>পাশের সন প্রয়োজন</span>
        </div>
        
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">শিক্ষাপ্রতিষ্ঠান/ স্কুল<span class="required">*</span></label>
          <input
            :name="`school_${key}`"
            v-validate = "'required'"
            data-vv-as="school_"
            class="form-control col-md-8"
            type="text"
            v-model="education.institute"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`school_${key}`)" class="validation_message col-md-8"><br>শিক্ষাপ্রতিষ্ঠান/ স্কুল প্রয়োজন</span>
        </div>
      </div>
      <div  v-if="!isMobile" class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">শিক্ষাবোর্ড<span class="required">*</span></label>
          <select data-vv-as="board_" :name="`board_${key}`"
            v-validate = "'required'" class="form-control col-md-8" id="exampleFormControlSelect1" v-model="education.board">
            <option value="">শিক্ষাবোর্ড</option>
            <option v-for="(board,key) in boards" :key="key">{{board.name}}</option>
            <!-- <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Jessore">Jessore</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Madrasah">Madrasah</option>
            <option value="Technical">Technical</option> -->
          </select>
          <span class="col-md-4"></span>
          <span v-if="errors.has(`board_${key}`)" class="validation_message col-md-8"><br>শিক্ষাবোর্ড প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">বিষয়<span class="required">*</span></label>
          <input
            data-vv-as="subject_"
            :name="`subject_${key}`"
            v-validate = "'required'"
            class="col-md-8 form-control"
            type="text"
            v-model="education.subject"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`subject_${key}`)" class="validation_message col-md-8"><br>বিষয় প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">গ্রেড/ডিভিশান<span class="required">*</span></label>
          <input
            data-vv-as="grade_"
            :name="`grade_${key}`"
            v-validate = "'required'"
            class="form-control col-md-8"
            type="text"
            v-model="education.grade"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has(`grade_${key}`)" class="validation_message col-md-8"><br>গ্রেড/ডিভিশান প্রয়োজন</span>
        </div>
      </div>
      <div v-if="isMobile" class="col-md-11 text-center">
        <p @click="remove(key)" style="cursor:pointer">বাদ দিন <i class="far fa-trash-alt"></i></p>
      </div>
      <div  v-if="educations.length>(key+1)" class="col-md-11">
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
import { isMobile } from 'mobile-device-detect';
export default {
  components: {
  },
  data() {
    return {
      validate_status:false,
      loader:false,
      isMobile:isMobile,
      boards:[],
      years:[],
      educations:[
        {degree:'',p_year:'',institute:'',board:'',subject:'',grade:''}
      ]
    }
  },
  mounted(){
    this.get();
    this.getYear();
    this.getBoard();
  },
  methods: {
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
      var data = {degree:'',p_year:'',institute:'',board:'',subject:'',grade:''}
      this.educations.push(data)
    },
    remove(index){
      this.educations.splice(index,1);
    },
    saveData() {
      this.loader= true
      if(this.validate_status) {
        this.loader = true;
        var data = {
          educations: this.educations,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/education-info', data)
          .then(response => {
            this.loader= false
            this.$emit('clicked', response.data.progress)
            // this.educations = response.data.educations
            this.$notify.success({
              title: 'Education info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {
            this.loader= false
          })
      }
    },
    get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            if (response.data.educations) {
              this.educations = response.data.educations
            }
          })
          .catch(error => {})
      } catch (error) {}
    },
    async getBoard(){
      await this.$axios
        .get('api/get-board')
        .then(response => {
          this.boards = response.data
        })
      .catch(error => {})
    },
    async getYear(){
      await this.$axios
        .get('api/get-p-year')
        .then(response => {
          this.years = response.data
        })
      .catch(error => {})
    }
  }
}
</script>
<style scoped>
.required{
  color:red;
}
@media only screen and (max-width: 600px) {
  .mobile-padding{
    padding:0px 5px 0px 15px;
  }
}

</style>