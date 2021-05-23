<template>
  <div>
    <div class="row" v-for="(experience,key) in experiences" :key="key">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Company Name:</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.comapny_name"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Post Held:</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.post_held"
          />
        </div>
      </div>
      <div class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">delete <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Serve From:</label>
          <div class="col-md-9">
            <div style="padding:3px;">
              <VueCtkDateTimePicker
                style="margin-left:18px;"
                label="Select date"
                v-model="experience.serve_from"
                :only-date="true"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Serve Till:</label>
          <div class="col-md-9">
            <div style="padding:3px;">
              <VueCtkDateTimePicker
                style="margin-left:18px;"
                label="Select date"
                v-model="experience.serve_till"
                :only-date="true"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Contact Person:</label>
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
          <label for="inputPassword" class="col-md-4 labels">Phone/Mobile:</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="experience.phone"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Email:</label>
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
          <label class="labels col-md-4" for="#firstName">Responsibility:</label>
          <textarea class="form-control col-md-8" v-model="experience.responsibility" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Achievement:</label>
          <textarea class="form-control col-md-8" v-model="experience.achievement" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
      </div>
    </div>
    <div class="row ">
        <div class="col-md-12 text-center">
            <button @click="addMore()" class="btn btn-secondary btn-sm">+ Add More Experience</button>
        </div>
    </div>
    <div class="col-md-4 row">
        <button @click="saveData" type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save
        </button>
        <button type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save & next
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    <div style="height:290px;"></div>
  </div>
</template>
<script>
// import address from "~/components/dashboard/profile/large/address"
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
export default {
  components: { VueCtkDateTimePicker },
  data() {
    return {
      experiences:[{contact_name:'',post_held:'',serve_form:'',serve_till:'',address:'',phone:'',contact_person:'',email:'',responsibility:'',achievement:''}]
    }
  },
  methods:{
    addMore(){
      var data = {contact_name:'',post_held:'',serve_form:'',serve_till:'',address:'',phone:'',contact_person:'',email:'',responsibility:'',achievement:''};
      this.experiences.push(data)
    },
    remove(index){
      this.experiences.splice(index,1)
    },
    saveData() {
      try {
        var data = {
          experiences: this.experiences,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.experiences = response.data.experiences
            this.$notify.success({
              title: 'Experience info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {})
      } catch (error) {}
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