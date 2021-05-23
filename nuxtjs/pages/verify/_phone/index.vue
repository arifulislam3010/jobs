<template>
  <section class="section section-shaped section-lg my-0">
    <div style="margin-top:0px" class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <card
            type="secondary"
            shadow
            header-classes="bg-white pb-5"
            body-classes="px-lg-5 py-lg-5"
            class="border-0"
          >
            <template>
              <div
                v-if="formError"
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
              >
                <span class="alert-inner--icon">
                  <i class="ni ni-like-2"></i>
                </span>
                <span class="alert-inner--text">
                  <strong>{{formError}}!</strong>
                </span>
                <button
                  type="button"
                  @click="SetLoginNotification"
                  class="close"
                  data-dismiss="alert"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div
                v-if="noification2"
                class="alert alert-success alert-dismissible fade show"
                role="alert"
              >
                <span class="alert-inner--icon">
                  <i class="ni ni-like-2"></i>
                </span>
                <span class="alert-inner--text">
                  <strong>{{noification2}}!</strong>
                </span>
                <button
                  type="button"
                  @click="SetLoginNotification"
                  class="close"
                  data-dismiss="alert"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="text-center text-muted mb-4">
                <small>{{phone}}</small>
              </div>

              <form role="form">
                <base-input
                  v-validate="'required'"
                  data-vv-as="code"
                  name="email_field"
                  v-model="code"
                  alternative
                  class="mb-3"
                  placeholder="code"
                ></base-input>
                <p
                  v-if="errors.has('email_field')"
                  class="validation_message"
                >* {{ errors.first('email_field') }}</p>

                <div class="text-center">
                  <base-button v-if="loader" type="primary" class="my-4">
                    <i class="fa fa-cog fa-spin"></i> Verify
                  </base-button>

                  <base-button v-else @click="activate" type="primary" class="my-4">Verify</base-button>
                </div>
              </form>
            </template>
          </card>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import axios from 'axios'
import Vue from 'vue'
import * as VeeValidate from 'vee-validate'
//

Vue.use(VeeValidate)
export default {
  name: 'verify',
  data() {
    return {
      noification2: 'Please submit your sms code for vrification.',
      formError: '',
      loader: false,
      phone: '',
      code: ''
    }
  },
  computed: {},

  methods: {
    SetLoginNotification() {
      ;(this.noification2 = ''), (this.formError = '')
    },
    activate() {
      var self = this
      self.loader = true;
      this.$validator.validateAll().then(result => {
        if (result) {
          this.$axios
            .get('applicant-agency/activation/' + this.phone + '/' + this.code)
            .then(response => {
              self.loader = false;
              this.$notify.success({
                title: 'Verify Info',
                message: 'Succesfully verifed.'
              })
              self.$router.push('/login')
            })
            .catch(error => {
                self.loader = false;
                self.formError = error.response.data.error
            })
        }
        else{
           self.loader = false; 
        }
      })
    }
  },
  mounted() {
    this.phone = this.$route.params.phone
  }
}
</script>
<style>
</style>
