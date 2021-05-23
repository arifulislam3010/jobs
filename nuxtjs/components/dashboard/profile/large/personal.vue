<template>
  <div>
    <div class="row">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            Full name
            <span class="required">*</span>
          </label>
          <input name="Full name" class="form-control col-md-8" type="text" v-model="name" />
          <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">
            Father's name
            <span class="required">*</span>
          </label>
          <input
            style="margin-top:15px;"
            name="Father name"
            class="col-md-8 form-control"
            type="text"
            v-model="personal.father_name"
          />
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4">
        <div v-if="url" class="image_upload logo_upload">
          <span class="removeImage" @click="RemoveImage">X</span>
          <img :src="url" class="fitimage" />
        </div>
        <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
          <p>Choose Image</p>
          <i class="fas fa-cloud-upload-alt"></i>
          <input
            type="file"
            ref="ImageFile"
            class="file-input"
            style="display: none"
            v-on:change="imageChanged"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">
            Mother's name
            <span class="required">*</span>
          </label>
          <input
            name="Mother name"
            class="col-md-8 form-control"
            type="text"
            v-model="personal.mother_name"
            required="required"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Spouse's Name</label>
          <input
            name="Spouse name"
            class="col-md-8 form-control"
            type="text"
            v-model="personal.spouse_name"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">National ID</label>
          <input
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="personal.nid"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            Birth Country
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="personal.country"
                placeholder="Select Country"
                label="country_name"
                track-by="id"
                :options="countries"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            District
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="personal.district"
                placeholder="Select District"
                label="district_name_eng"
                track-by="id"
                :options="districts"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            Birth date
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding:3px;">
              <VueCtkDateTimePicker
                style="margin-left:18px;"
                v-model="personal.birth_date"
                label="Select date"
                :only-date="true"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Nationality
            <span class="required">*</span>
          </label>
          <input
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="personal.nationality"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Marital Status
            <span class="required">*</span>
          </label>
          <select
            class="form-control col-md-8"
            id="exampleFormControlSelect1"
            v-model="personal.marital_status"
          >
            <option value>Select Marital Status</option>
            <option value="Married">Married</option>
            <option value="Unmarried">Unmarried</option>
          </select>
        </div>
      </div>

      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Sex
            <span class="required">*</span>
          </label>
          <select
            class="form-control col-md-8"
            id="exampleFormControlSelect1"
            v-model="personal.sex"
          >
            <option value>Select Sex</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
          </select>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Religion
            <span class="required">*</span>
          </label>
          <select
            class="form-control col-md-8"
            id="exampleFormControlSelect1"
            v-model="personal.religion"
          >
            <option value>Select Religion</option>
            <option value="Islam">Islam</option>
            <option value="Hinduism">Hinduism</option>
            <option value="Christianity">Christianity</option>
            <option value="Buddhism">Buddhism</option>
            <option value="Others">Others</option>
          </select>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            Desired Job
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="personal.job"
                tag-placeholder="Add this as new job"
                placeholder="Select Job"
                label="name"
                track-by="id"
                :options="desired_jobs"
                :multiple="true"
                :taggable="true"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Weight(Kg)
            <span class="required">*</span>
          </label>
          <input class="form-control col-md-8" type="text" v-model="personal.weight" />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Height(Meter)
            <span class="required">*</span>
          </label>
          <input class="form-control col-md-8" type="text" value="Height" v-model="personal.height" />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">No. of Daughter</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="personal.no_daughter"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">No. of Son</label>
          <input id="firstName" class="form-control col-md-8" type="text" v-model="personal.no_son" />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Passport issue date</label>
          <div class="col-md-9">
            <div style="padding:3px;">
              <VueCtkDateTimePicker
                style="margin-left:18px;"
                v-model="personal.passport_date"
                label="Select date"
                :only-date="true"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Passport No</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            value="Height"
            v-model="personal.passport_no"
          />
        </div>
      </div>
      <div class="col-md-7"></div>
      <div class="col-md-4 row">
        <button @click="saveData" type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save
        </button>
        <button type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save & next
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>
    <div style="height:290px;"></div>
  </div>
</template>
<script>
// import address from "~/components/dashboard/profile/large/address"
import Multiselect from 'vue-multiselect'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
export default {
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  props: ['countries', 'districts', 'desired_jobs'],
  data() {
    return {
      image: '',
      not_edit_image: 10,
      name: '',
      personal: {
        name: '',
        father_name: '',
        mother_name: '',
        spouse_name: '',
        nid: '',
        nationality: 'Bangladeshi',
        country: {},
        district: {},
        marital_status: '',
        sex: '',
        religion: '',
        weight: '',
        height: '',
        job: [],
        passport_no: '',
        passport_date: '',
        birth_date: '',
        no_son: '',
        no_daughter: ''
      },
      url: ''
    }
  },
  mounted() {
    this.get()
  },
  methods: {
    saveData() {
      try {
        var data = {
          personal: this.personal,
          user_id: this.$auth.user.id,
          image: this.image,
          not_edit_image: this.not_edit_image,
          name: this.name
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.personal = response.data.personal
            this.$notify.success({
              title: 'Personal info',
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
            if(response.data.personal){
              this.personal = response.data.personal
            }
            this.url = response.data.image
            this.name = response.data.name
            //this.not_edit_image = response.data.not_edit_image;
            console.log(response.data)
          })
          .catch(error => {})
      } catch (error) {}
    },
    imageChanged(e) {
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = e => {
        this.image = e.target.result
        this.not_edit_image = 11
      }
      this.url = URL.createObjectURL(e.target.files[0])
    },
    RemoveImage: function() {
      this.image = ''
      this.not_edit_image = 10
      this.url = ''
    }
  }
}
</script>
<style scoped>
.required {
  color: red;
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