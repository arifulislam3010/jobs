<template>
  <div class="row mb-4">
    <div class="col-md-2">
      <h4>
        <i class="fas fa-phone"></i> &nbsp;<i class="fa fa-facebook"></i> &nbsp;<i class="fa fa-youtube"></i> 
      </h4>
      <h5>যোগাযোগ</h5>
    </div>
    <div class="col-md-4">
      <br />
      <br />
      <br />
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">হটলাইন নাম্বার</label>
          <div class="input-group">
            <input
              type="text"
              v-model="list.phone"
              class="form-control"
            />
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">ফেইসবুক পেজ লিংক</label>
          <div class="input-group">
            <input
              type="text"
              v-model="list.facebook"
              class="form-control"
            />
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="typo__label">ইউটুব চ্যানেল লিংক </label>
          <div class="input-group">
            <input
              type="text"
              v-model="list.youtube"
              class="form-control"
            />
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div>
          <base-button style="color:#fff;background-color:rgb(117,171,40);float:right" v-if="loader"   class="btn btn-md"> <i class="fa fa-cog fa-spin"></i> পরিবর্তন করুন</base-button>
          <button v-else
            @click="change()"
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
  middleware:'auth-admin',
  name: 'contact',
  layout: 'dashboard',
  data() {
    return {
      loader:false,
      verify_status:true,
      valiadte_status:0,
      error_message:'',
      list: {
        facebook: '',
        phone: '',
        youtube: ''
      }
    }
  },

  mounted() {
    this.get();
  },
  methods: {
    get(){
        this.$axios.get('/api/social-link').then(response =>{
            this.list = response.data
        })
    },
    change() {
        this.loader = true;
        var data = this.list
        this.$axios
        .post('/api/social-link', data)
        .then(response => {
          this.loader = false;
          this.list = response.data
          this.$notify.success({
            title: 'যোগাযোগ ',
            message: 'যোগাযোগ চেঞ্জ করতে সক্ষম হয়েছেন'
          })
        })
        .catch(error => {
          this.error_message = error.response.data.errors
          this.loader = false;
        })
    }
  }
}
</script>
