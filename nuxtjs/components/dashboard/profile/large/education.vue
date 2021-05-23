<template>
  <div>
    <div v-for="(education,key) in educations" :key="key" class="row">
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Degree Name<span class="required">*</span></label>
          <input
            id="firstName"
            name="Father Name"
            class="col-md-8 form-control"
            type="text"
            v-model="education.degree"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Passing Year<span class="required">*</span></label>
          <select v-model="education.p_year" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">Passing Year</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
          </select>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Institute/School<span class="required">*</span></label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="education.institute"
          />
        </div>
      </div>
      <div class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">delete <i class="far fa-trash-alt"></i></p>
      </div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Board<span class="required">*</span></label>
          <select class="form-control col-md-8" id="exampleFormControlSelect1" v-model="education.board">
            <option value="">Board</option>
            <option value="Barisal">Barisal</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Jessore">Jessore</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Madrasah">Madrasah</option>
            <option value="Technical">Technical</option>
          </select>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Subject<span class="required">*</span></label>
          <input
            id="firstName"
            name="Mother Name"
            class="col-md-8 form-control"
            type="text"
            v-model="education.subject"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Grade/ division<span class="required">*</span></label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="education.grade"
          />
        </div>
      </div>
    </div>
    <div class="row ">
        <div class="col-md-12 text-center">
            <button @click="addMore()" class="btn btn-secondary btn-sm">+ Add More</button>
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

export default {
  components: {
  },
  data() {
    return {
      educations:[
        {degree:'',p_year:'',institute:'',board:'',subject:'',grade:''}
      ]
    }
  },
  mounted(){
    this.get();
  },
  methods: {
    addMore(){
      var data = {degree:'',p_year:'',institute:'',board:'',subject:'',grade:''}
      this.educations.push(data)
    },
    remove(index){
      this.educations.splice(index,1);
    },
    saveData() {
      try {
        var data = {
          educations: this.educations,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.educations = response.data.educations
            this.$notify.success({
              title: 'Education info',
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
            if (response.data.educations) {
              this.educations = response.data.educations
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  }
}
</script>
<style scoped>
.required{
  color:red;
}
.logo_upload {
  border: 1px solid #ccc;
  width: 90%;
  height: 100px;
  background: #eceef0;
  text-align: center;
  cursor: pointer;
  margin-left: 50px;
}
.image_upload p {
  margin-top: 10px;
  font-size: 12px;
}

.image_upload i {
  font-size: 34px;
}
.removeImage {
  position: absolute;
  right: 13px;
  top: 14px;
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
</style>