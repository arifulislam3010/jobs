<template>
  <div>
    <div class="row">
      <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
        <div>
          <p style="padding-top:12px;">Permanent Address</p>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Division<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                @input="getDistrictByID2()"
                v-model="address2.division"
                placeholder="Select Division"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">District<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address2.district"
                @input="getSubdistrict2()"
                placeholder="Select District"
                label="district_name_eng"
                track-by="id"
                :options="total2.districts2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Thana/ Upazilla<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address2.subdistrict"
                @input="getUnion2()"
                placeholder="Select Thana/ Upazilla"
                label="upazila_name_eng"
                track-by="id"
                :options="total2.subdistricts2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Ward/ Union<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address2.union"
                placeholder="Select Ward/ Union"
                label="union_name_eng"
                track-by="id"
                :options="total2.unions2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Area/ Village<span class="required">*</span></label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="address2.village"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Post Office<span class="required">*</span></label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="address2.postoffice"
          />
        </div>
      </div>
      
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Street Address/ Para</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="address2.street"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Phone</label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="address2.phone"
          />
        </div>
      </div>
      <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
        <div class="row">
          <div class="col-md-6">
            <p style="padding-top:12px;">Mailing Address</p>
          </div>
          <div class="col-md-6">
            <p style="margin-top:15px;float:right"><input  v-model="same_address" name="checkbox" @click="sameAddress();" type="checkbox" id="checkbox" />As Permanent Address.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Division<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                @input="getDistrictByID3()"
                v-model="address3.division"
                placeholder="Select Division"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">District<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address3.district"
                @input="getSubdistrict3()"
                placeholder="Select District"
                label="district_name_eng"
                track-by="id"
                :options="total3.districts2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Thana/ Upazilla<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address3.subdistrict"
                @input="getUnion3()"
                placeholder="Select Thana/ Upazilla"
                label="upazila_name_eng"
                track-by="id"
                :options="total3.subdistricts2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">Ward/ Union<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="address3.union"
                placeholder="Select Ward/ Union"
                label="union_name_eng"
                track-by="id"
                :options="total3.unions2"
              ></multiselect>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Area/ Village<span class="required">*</span></label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="address3.village"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Post Office<span class="required">*</span></label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="address3.postoffice"
          />
        </div>
      </div>
      
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Street Address/ Para</label>
          <input
            id="firstName"
            class="form-control col-md-8"
            type="text"
            v-model="address3.street"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">Phone</label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="address3.phone"
          />
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
  name: 'address2',
  components: {
    Multiselect,
    VueCtkDateTimePicker
  },
  props: ['divisions'],
  data() {
    return {
      same_address:false,
      address2:{
        division: {},
        district: {},
        subdistrict: {},
        union: {},
        village:'',
        street:'',
        postoffice:'',
        phone:''
      },
      address3:{
        division: {},
        district: {},
        subdistrict: {},
        union: {},
        village:'',
        street:'',
        postoffice:'',
        phone:''
      },
      total2:{
        districts2: [],
        subdistricts2:[],
        unions2:[],
      },
      total3:{
        districts2: [],
        subdistricts2:[],
        unions2:[],
      }
    }
  },
  mounted(){
    this.get();
  },
  methods: {
    
    sameAddress(){
      if(!this.same_address){
        this.address3 = this.address2
      }
      else{
        this.address3 = {
          division: {},
          district: {},
          subdistrict: {},
          union: {},
          village:'',
          street:'',
          postoffice:'',
          phone:''
        }
      }
    },
    saveData() {
      try {
        var data = {
          address2: this.address2,
          address3: this.address3,
          user_id: this.$auth.user.id,
          same_address: this.same_address
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.address2 = response.data.address2
            this.address3 = response.data.address3
            this.same_address = response.data.same_address
            this.$notify.success({
              title: 'Address info',
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
            if(response.data.address2){
              this.address2 = response.data.address2
              this.address3 = response.data.address3
              this.same_address = response.data.same_address
            }
          })
          .catch(error => {})
      } catch (error) {}
    },
    async getDistrictByID2() {
      this.$axios
        .get('api/get-district/' + this.address2.division.id)
        .then(response => {
          this.total2.districts2 = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict2(){
        this.$axios.get('api/get-subdistrict/'+this.address2.district.id).then(response => {
              this.total2.subdistricts2 = response.data;
    })
    .catch(error => {

      });
    },
    async getUnion2(){
        this.$axios.get('api/get-union/'+this.address2.subdistrict.id).then(response => {
              this.total2.unions2 = response.data;
    })
    .catch(error => {

      });
    },
    async getDistrictByID3() {
      this.$axios
        .get('api/get-district/' + this.address3.division.id)
        .then(response => {
          this.total3.districts2 = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict3(){
        this.$axios.get('api/get-subdistrict/'+this.address3.district.id).then(response => {
              this.total3.subdistricts2 = response.data;
    })
    .catch(error => {

      });
    },
    async getUnion3(){
        this.$axios.get('api/get-union/'+this.address3.subdistrict.id).then(response => {
              this.total3.unions2 = response.data;
    })
    .catch(error => {

      });
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