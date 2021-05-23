<template>
  <div>
    <div class="row mobile-padding">
      <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
        <div>
          <p style="padding-top:12px;">স্থায়ী ঠিকানা </p>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            বিভাগ
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                v-validate="'required'"
                name = "division"
                style="margin-left:15px;"
                @input="getDistrictByID2()"
                v-model="address2.division"
                placeholder="বিভাগ"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('division')" class="validation_message col-md-8"><br>বিভাগ প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            জেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                v-validate="'required'"
                name = "district"
                v-model="address2.district"
                @input="getSubdistrict2()"
                placeholder="জেলা"
                label="district_name_eng"
                track-by="id"
                :options="total2.districts2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('district')" class="validation_message col-md-8"><br>জেলা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            থানা/ উপজেলা
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                v-validate="'required'"
                name = "sub_district"
                style="margin-left:15px;"
                v-model="address2.subdistrict"
                @input="getUnion2()"
                placeholder="উপজেলা"
                label="upazila_name_eng"
                track-by="id"
                :options="total2.subdistricts2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('sub_district')" class="validation_message col-md-8"><br>উপজেলা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">
            ওয়ার্ড/ ইউনিয়ন
            <span class="required">*</span>
          </label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect
                selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                v-validate="'required'"
                name = "union"
                v-model="address2.union"
                placeholder="ওয়ার্ড/ ইউনিয়ন"
                label="union_name_eng"
                track-by="id"
                :options="total2.unions2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('union')" class="validation_message col-md-8"><br>ওয়ার্ড/ ইউনিয়ন প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            এলাকা/ গ্রাম
            <span class="required">*</span>
          </label>
          <input
            v-validate="'required'"
                name = "village"
            class="form-control col-md-8"
            type="text"
            v-model="address2.village"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('village')" class="validation_message col-md-8"><br>এলাকা/ গ্রাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            পোস্ট অফিস
            <span class="required">*</span>
          </label>
          <input
            v-validate="'required'"
                name = "post_office"
            class="form-control col-md-8"
            type="text"
            v-model="address2.postoffice"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('post_office')" class="validation_message col-md-8"><br>পোস্ট অফিস প্রয়োজন</span>
        </div>
      </div>

      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">রোডনম্বর/ পাড়া</label>
          <input  class="form-control col-md-8" type="text" v-model="address2.street" />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">ফোন</label>
          <input
            class="form-control col-md-8"
            type="text"
            v-model="address2.phone"
          />
        </div>
      </div>
      <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
        <div class="row">
          <div class="col-md-6">
            <p style="padding-top:12px;">চিঠি পাঠানোর ঠিকানা</p>
          </div>
          <div class="col-md-6">
            <p style="margin-top:15px;float:right">
              <input
                v-model="same_address"
                name="checkbox"
                @click="sameAddress();"
                type="checkbox"
                id="checkbox"
              /> স্থায়ী ঠিকানার মত
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">বিভাগ<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect :disabled="same_address"
                selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                v-validate="'required'"
                name = "division2"
                @input="getDistrictByID3()"
                v-model="address3.division"
                placeholder="বিভাগ"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('division2')" class="validation_message col-md-8"><br>বিভাগ প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">জেলা<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect :disabled="same_address"
               selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                name="district2"
                v-validate="'required'"
                v-model="address3.district"
                @input="getSubdistrict3()"
                placeholder="জেলা"
                label="district_name_eng"
                track-by="id"
                :options="total3.districts2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('district2')" class="validation_message col-md-8"><br>জেলা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">উপজেলা<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect :disabled="same_address"
                selectLabel=""
                deselectLabel=""
                style="margin-left:15px;"
                name="sub_district2"
                v-validate="'required'"
                v-model="address3.subdistrict"
                @input="getUnion3()"
                placeholder="উপজেলা"
                label="upazila_name_eng"
                track-by="id"
                :options="total3.subdistricts2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('sub_district2')" class="validation_message col-md-8"><br>থানা/উপজেলা প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-3" for="#firstName">ওয়ার্ড/ ইউনিয়ন<span class="required">*</span></label>
          <div class="col-md-9">
            <div style="padding-left:6px;">
              <multiselect :disabled="same_address"
                selectLabel=""
                deselectLabel=""
                name="union2"
                v-validate = "'required'"
                style="margin-left:15px;"
                v-model="address3.union"
                placeholder="Select Ward/ Union"
                label="union_name_eng"
                track-by="id"
                :options="total3.unions2"
              ></multiselect>
            </div>
          </div>
          <span class="col-md-4"></span>
          <span v-if="errors.has('union2')" class="validation_message col-md-8"><br>ওয়ার্ড/ ইউনিয়ন প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            এলাকা/ গ্রাম
            <span class="required">*</span>
          </label>
          <input
            :disabled="same_address"
            name="area2"
            v-validate="'required'"
            class="form-control col-md-8"
            type="text"
            v-model="address3.village"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('area2')" class="validation_message col-md-8"><br>এলাকা/ গ্রাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            পোস্ট অফিস
            <span class="required">*</span>
          </label>
          <input
            name="post_office2"
            v-validate = "'required'"
            :disabled="same_address"
            class="form-control col-md-8"
            type="text"
            v-model="address3.postoffice"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('post_office2')" class="validation_message col-md-8"><br>পোস্ট অফিস প্রয়োজন</span>
        </div>
      </div>

      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">রোডনম্বর/ পাড়া</label>
          <input
            :disabled="same_address"
            class="form-control col-md-8"
            type="text"
            v-model="address3.street"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">ফোন</label>
          <input
            :disabled="same_address"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="address3.phone"
          />
        </div>
      </div>
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
export default {
  name: 'address2',
  components: {
    Multiselect
  },
  props: ['divisions'],
  data() {
    return {
      validate_status:false,
      loader:false,
      same_address: false,
      address2: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      address3: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      total2: {
        districts2: [],
        subdistricts2: [],
        unions2: []
      },
      total3: {
        districts2: [],
        subdistricts2: [],
        unions2: []
      }
    }
  },
  mounted() {
    this.get()
  },
  methods: {
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
    sameAddress() {
      if (!this.same_address) {
        this.address3 = this.address2
        this.total3 = this.total2
      } else {
        this.address3 = {
          division: '',
          district: '',
          subdistrict: '',
          union: '',
          village: '',
          street: '',
          postoffice: '',
          phone: ''
        }
      }
    },
    saveData() {
      if(this.validate_status) {
        this.loader = true;
        var data = {
          address2: this.address2,
          address3: this.address3,
          user_id: this.$auth.user.id,
          same_address: this.same_address
        }
        this.$axios
          .put('contacts/address-info', data)
          .then(response => {
            this.loader = false;
            this.$emit('clicked', response.data.progress)
            // this.address2 = response.data.address2
            // this.address3 = response.data.address3
            // this.same_address = response.data.same_address
            this.$notify.success({
              title: 'Address info',
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
            if (response.data.address2) {
              if(response.data.same_address){
                this.address2 = response.data.address2
                this.address3 = this.address2
              }
              else{
                this.address2 = response.data.address2
                this.address3 = response.data.address3
              }
              this.same_address = response.data.same_address
            }
          })
          .catch(error => {})
      } catch (error) {}
    },
    async getDistrictByID2() {
      if (this.address2.division) {
        this.$axios
          .get('api/get-district/' + this.address2.division.id)
          .then(response => {
            this.total2.districts2 = response.data
            this.total2.subdistricts2 = []
            this.total2.unions2 = []
            this.address2.district = ''
            this.address2.subdistrict = ''
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    async getSubdistrict2() {
      if (this.address2.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.address2.district.id)
          .then(response => {
            this.total2.subdistricts2 = response.data
            this.address2.subdistrict = ''
            this.total2.unions2 = []
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    async getUnion2() {
      if (this.address2.subdistrict) {
        this.$axios
          .get('api/get-union/' + this.address2.subdistrict.id)
          .then(response => {
            this.total2.unions2 = response.data
            this.address2.union = ''
            if (this.same_address) {
              this.address3 = this.address2
              this.total3 = this.total2
            }
          })
          .catch(error => {})
      }
    },
    async getDistrictByID3() {
      if (this.address3.division) {
        this.$axios
          .get('api/get-district/' + this.address3.division.id)
          .then(response => {
            this.total3.districts2 = response.data
            this.total3.subdistricts2 = []
            this.total3.unions2 = []
            this.address3.district = ''
            this.address3.subdistrict = ''
            this.address3.union = ''
          })
          .catch(error => {})
      }
    },
    async getSubdistrict3() {
      if (this.address3.district) {
        this.$axios
          .get('api/get-subdistrict/' + this.address3.district.id)
          .then(response => {
            this.total3.subdistricts2 = response.data
            this.address3.subdistrict = ''
            this.total3.unions2 = []
            this.address3.union = ''
          })
          .catch(error => {})
      }
    },
    async getUnion3() {
      if (this.address3.subdistrict) {
        this.$axios
          .get('api/get-union/' + this.address3.subdistrict.id)
          .then(response => {
            this.total3.unions2 = response.data
            this.address3.union = ''
          })
          .catch(error => {})
      }
    }
  }
}
</script>
<style scoped>
.required {
  color: red;
}
@media only screen and (max-width: 600px) {
  .mobile-padding{
    padding:0px 5px 0px 15px;
  }
}

</style>