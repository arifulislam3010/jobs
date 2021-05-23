<template>
  <div>
    <div v-for="(training,key) in trainings" :key="key" class="row">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Training Name:</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="training.training_name"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Training Center</label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="training.training_center"
                placeholder="Select Training Center"
                label="name"
                track-by="id"
                :options="training_centers"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">delete <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Duration:</label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="training.duration"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Description:</label>
          <textarea v-model="training.description" class="form-control col-md-8" id="exampleFormControlTextarea1" rows="2"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <button @click="addMore" class="btn btn-secondary btn-sm">+ Add More Training</button>
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
import Multiselect from 'vue-multiselect'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
export default {
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  props: ['training_centers'],
  data() {
    return {
      trainings:[{training_name:'',training_center:{},duration:'',description:''}]
    }
  },
  mounted(){
    this.get();
  },
  methods:{
      addMore(){
          var data = {training_name:'',training_center:{},duration:'',description:''}
          this.trainings.push(data)
      },
      remove(index){
        this.trainings.splice(index,1)
      },
      saveData() {
      try {
        var data = {
          trainings: this.trainings,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.trainings = response.data.trainings
            this.$notify.success({
              title: 'Training info',
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
            console.log(response.data)
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