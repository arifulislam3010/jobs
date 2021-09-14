<template>
  <div class="row mb-4">
    <div class="col-md-4">
      <h4>
        <i class="fas fa-cog"></i> সেটিংস
      </h4>
      <h5>পাসওয়ার্ড পরিবর্তন</h5>
    </div>
    <div class="col-md-4">
      <br />
      <br />
      <br />
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">পুরোনো পাসওয়ার্ড</label>
          <div class="input-group">
            <input
              @keyup="errorRemove('old_password')"
              type="password"
              v-validate="'required'"
              v-model="list.old_password"
              class="form-control"
              placeholder="পুরোনো পাসওয়ার্ড"
              name="old_password"
            />
          </div>
        </div>
        <p v-if="errors.has('old_password') && verify_status" class="validation_message">* পুরোনো পাসওয়ার্ড প্রয়োজন</p>
        <p v-if="error_message" class="validation_message"><span v-if="error_message.old_password">{{error_message.old_password}}</span></p>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">নতুন পাসওয়ার্ড</label>
          <div class="input-group">
            <input
              @keyup="errorRemove('new_password')"
              ref="new_password"
              type="password"
              v-validate="'required'"
              v-model="list.new_password"
              class="form-control"
              placeholder="নতুন পাসওয়ার্ড"
              name="new_password"
            />
          </div>
        </div>
        <p v-if="errors.has('new_password') && verify_status" class="validation_message">* নতুন পাসওয়ার্ড প্রয়োজন</p>
        <p v-if="error_message" class="validation_message"><span v-if="error_message.new_password"><span v-for="(error,key) in error_message.new_password" :key="key">{{error}}</span></span></p>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">পুনরায়-নতুন পাসওয়ার্ড</label>
          <div class="input-group">
            <input
              @keyup="errorRemove('confirm_password')"
              type="password"
              v-validate="'required|confirmed:new_password'"
              v-model="list.confirm_password"
              class="form-control"
              placeholder="পুনরায়-নতুন পাসওয়ার্ড"
              name="confirm_password"
            />
          </div>
        </div>
        <p v-if="errors.has('confirm_password') && verify_status" class="validation_message">* পাসওয়ার্ড একই হতে হবে</p>
        <p v-if="error_message" class="validation_message"><span v-if="error_message.confirm_password"><span v-for="(error,key) in error_message.confirm_password" :key="key">{{error}}</span></span></p>
      </div>
      <div class="col-md-12">
        <div>
          <base-button style="color:#fff;background-color:rgb(117,171,40);float:right" v-if="loader"   class="btn btn-md"> <i class="fa fa-cog fa-spin"></i> পরিবর্তন করুন</base-button>
          <button v-else
            @click="valiadte"
            style="color:#fff;background-color:rgb(117,171,40);float:right"
            class="btn btn-md"
          >পরিবর্তন করুন</button>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</template>

<script>
import Vue from 'vue'
import * as VeeValidate from 'vee-validate'
Vue.use(VeeValidate)
export default {
  middleware:'auth',
  name: 'setting',
  layout: 'dashboard',
  data() {
    return {
      loader:false,
      verify_status:true,
      valiadte_status:0,
      error_message:'',
      list: {
        old_password: '',
        new_password: '',
        confirm_password: ''
      }
    }
  },

  mounted() {},
  methods: {
    valiadte() {
      var self = this
      this.$validator.validateAll().then(result => {
        if (result) {
          this.valiadte_status = 1
          self.change()
        }
        else{
          this.valiadte_status = 0
        }
      })
    },
    errorRemove(field) {
      delete this.error_message[field];
      this.verify_status = true;
    },
    change() {
      if(this.valiadte_status == 1){
        this.loader = true;
        var data = this.list
        this.$axios
        .post('/api/contacts/password-change', data)
        .then(response => {
          this.loader = false;
          this.list.old_password = '';
          this.list.new_password = '';
          this.list.confirm_password = '';
          this.verify_status = false;
          this.$notify.success({
            title: 'পাসওয়ার্ড ',
            message: 'পাসওয়ার্ড চেঞ্জ করতে সক্ষম হয়েছেন'
          })
        })
        .catch(error => {
          this.error_message = error.response.data.errors
          this.loader = false;
        })
      }
    }
  }
}
</script>
