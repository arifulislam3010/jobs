<template>
  <div>
    <div class="row mobile-padding">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            নমিনীর নাম 
            <span class="required">*</span>
          </label>
          <input
           v-validate="'required'"
            name="name"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.name"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('name')" class="validation_message col-md-8"><br>নমিনীর নাম প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            সম্পর্ক
            <span class="required">*</span>
          </label>
          <input
            name="relation"
            v-validate="'required'"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.relation"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('relation')" class="validation_message col-md-8"><br>সম্পর্ক প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            ফোন/ মোবাইল
            <span class="required">*</span>
          </label>
          <input
            name="phone_email"
            v-validate="'required'"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.phone"
          />
          <span class="col-md-4"></span>
          <span v-if="errors.has('phone_email')" class="validation_message col-md-8"><br>ফোন/ মোবাইল প্রয়োজন</span>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            ঠিকানা
            <span class="required">*</span>
          </label>
          <textarea
            class="form-control col-md-8"
            v-validate="'required'"
            name="address"
            v-model="nominee.address"
            rows="2"
          ></textarea>
          <span class="col-md-4"></span>
          <span v-if="errors.has('address')" class="validation_message col-md-8"><br>ঠিকানা প্রয়োজন</span>
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
// import address from "~/components/dashboard/profile/large/address"

export default {
  data() {
    return {
      validate_status:false,
      loader:false,
      nominee: {
        address: '',
        phone: '',
        name: '',
        relation: ''
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
    saveData() {
      if(this.validate_status) {
        this.loader = true;
        var data = {
          nominee: this.nominee,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/nominee-info', data)
          .then(response => {
            this.loader = false;
            // this.nominee = response.data.nominee
            this.$emit('clicked', response.data.progress)
            this.$notify.success({
              title: 'Nominee info',
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
            if (response.data.nominee) {
              this.nominee = response.data.nominee
            }
          })
          .catch(error => {})
      } catch (error) {}
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