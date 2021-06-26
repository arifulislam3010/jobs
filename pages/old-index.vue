<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <Slider></Slider>
        <breackingNews></breackingNews>
      </div>
      <div class="col-md-12">
        <Content1></Content1>
      </div>
    </div>
    <Content2></Content2>
    <div class="col-md-12">
      <div class="container">
        <div class="row">
          <div class="col-12 on-mobile-col-12">
            <Content3></Content3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <form v-if="!$store.state.authUser" @submit.prevent="login">
      <p v-if="formError" class="error">
        {{ formError }}
      </p>
      <p><i>To login, use <b>demo</b> as username and <b>demo</b> as password.</i></p>
      <p>Username: <input v-model="formUsername" type="text" name="username"></p>
      <p>Password: <input v-model="formPassword" type="password" name="password"></p>
      <button type="submit">
        Login
      </button>
    </form> -->
  <!-- <hero>
            <div class="mt-4 mb-5">
                <logo></logo>
                <p class="lead text-white">Hello World</p>
            </div>
        </hero> -->
</template>
<script>
import { isMobile } from 'mobile-device-detect'
import Hero from '~/components/argon-demo/Hero'
import Slider from '~/components/custom/slider/index.vue'
import breackingNews from '~/components/custom/breackingNews.vue'
import Content1 from '~/components/custom/home/content1.vue'
import Content2 from '~/components/custom/home/content2.vue'
import Content3 from '~/components/custom/home/content3.vue'
import Logo from '~/components/Logo.vue'
export default {
  components: {
    Hero,
    Content1,
    Content2,
    Content3,
    Logo,
    Slider,
    breackingNews
  },
  data() {
    return {
      formError: null,
      formUsername: '',
      formPassword: '',
      isMobile: isMobile
    }
  },
  methods: {
    async login() {
      try {
        await this.$store.dispatch('login', {
          username: this.formUsername,
          password: this.formPassword
        })
        this.formUsername = ''
        this.formPassword = ''
        this.formError = null
        alert('ss')
      } catch (e) {
        this.formError = e.message
      }
    },
    async logout() {
      try {
        await this.$store.dispatch('logout')
      } catch (e) {
        this.formError = e.message
      }
    }
  },
  mounted() {}
}
</script>
<style>
@media (max-width: 425px) {
  .on-mobile-col-12 {
    padding: 0;
  }
}
</style>
