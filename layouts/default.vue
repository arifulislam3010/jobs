<template>
  <v-app class="customDesign">
    <div class="mainnav">
      <main-nav></main-nav>
    </div>
    <div class="customBody mt-5">
      <Nuxt />
    </div>
  </v-app>
</template>

<script>
import $ from 'jquery'
import StarterHeader from '~/components/argon-layout/starter/StarterHeader'
import TopBar from '~/components/argon-layout/starter/TopBar'
import StarterFooter from '~/components/argon-layout/starter/StarterFooter'
import MainNav from '~/components/customDesign/navBar/index.vue'
import { mapState, mapMutations, mapGetters, mapActions } from 'vuex'
import { setInterval } from 'timers'
export default {
  components: {
    StarterHeader,
    StarterFooter,
    TopBar,
    MainNav
  },
  data() {
    return {
      initialLoading: true
    }
  },
  beforeRouteEnter(to, from, next) {
    // this.initialCall();
  },
  mounted() {
    $('#close_button').on('click', function() {
      var $btn = $(this)
      var $li = $btn.closest('div')
      var btnOffsetTop = $btn.offset().top
      var btnOffsetRight = window.innerWidth - $btn.offset().left
      $btn
        .parent('.content_popup')
        .parent('.registration_popup')
        .css({ background: 'transparent' })
      $li.find('img').css({ width: '20%', height: '20%' })
      $li
        .find('img')
        .clone()
        .css({ top: btnOffsetTop, right: btnOffsetRight, opacity: 1 })
        .addClass('zoom')
        .appendTo($li)

      $li.find('img').css({ opacity: 0 })
      $btn.css({ opacity: 0 })
      // $btn.siblings().css({ "opacity": 0});
      setTimeout(function() {
        $('.zoom').remove()
        $btn
          .parent('.content_popup')
          .parent('.registration_popup')
          .css({ display: 'none' })
      }, 1500)
    })
    var self = this
    $('#register_button').on('click', function() {
      var $btn = $(this)
      $btn
        .parent('.content_popup')
        .parent('.registration_popup')
        .css({ display: 'none' })
      self.$router.push('/register')
    })
  },
  methods: {
    async initialCall() {
      if (localStorage.getItem('access_token') != null) {
        var getuser = ''
        this.$axios.defaults.headers.common['Authorization'] =
          'Bearer ' + localStorage.getItem('access_token')
        if (localStorage.getItem('isAuthenticated')) {
          let Authenticated = false
          await this.$axios.get('api/user/info').then(response => {
            this.initialLoading = false
            Authenticated = true
            this.$router.push({
              path: $nuxt.$route.path
            })
            alert($nuxt.$route.path)
            this.$store.commit('admin/user/login/SET_USER', response.data, {
              root: true
            })
          })
          if (!Authenticated) {
            var authdata = {}
            var authdata = {}
            authdata = {
              grant_type: 'client_credentials',
              client_id: 1,
              client_secret: 'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu'
            }

            await this.$axios.post('oauth/token', authdata).then(response => {
              this.initialLoading = false
              localStorage.setItem('access_token', response.data.access_token)
              localStorage.setItem('expires_in', response.data.expires_in)
              localStorage.setItem('isAuthenticated', false)
              this.$axios.defaults.headers.common['Authorization'] =
                'Bearer ' + response.data.access_token
            })
          }
        } else {
          var token = localStorage.getItem('access_token')
          var expiration = localStorage.getItem('expires_in')

          if (Date.now() > parseInt(expiration)) {
            var authdata = {}
            var authdata = {}
            authdata = {
              grant_type: 'client_credentials',
              client_id: 1,
              client_secret: 'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu'
            }

            await this.$axios.post('oauth/token', authdata).then(response => {
              this.initialLoading = false
              localStorage.setItem('access_token', response.data.access_token)
              localStorage.setItem('expires_in', response.data.expires_in)
              localStorage.setItem('isAuthenticated', false)
              axios.defaults.headers.common['Authorization'] =
                'Bearer ' + response.data.access_token
              // commit('ACCESS_TOKEN',response.data)
              // resolve(response)
            })
          }
        }
      } else {
        var authdata = {}
        var authdata = {}
        authdata = {
          grant_type: 'client_credentials',
          client_id: 1,
          client_secret: 'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu'
        }

        await this.$axios.post('oauth/token', authdata).then(response => {
          localStorage.setItem('access_token', response.data.access_token)
          localStorage.setItem('expires_in', response.data.expires_in)
          localStorage.setItem('isAuthenticated', false)
          this.$axios.defaults.headers.common['Authorization'] =
            'Bearer ' + response.data.access_token
        })
      }
    }
  }
}
</script>

<style>
@font-face {
  font-family: solaimanlipi;
  src: url('../assets/fonts/SolaimanLipi_20-04-07.ttf') format('opentype');
}
body,
#wrapper {
  min-height: 100vh;
  font-family: SolaimanLipi;
}
.main-block {
  /* overflow: initial */
  background-color: #fff;
}

.registration_popup {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #91978ea1;
  /* opacity: 0.5; */
  z-index: 999999999999999;
  overflow: hidden;
}

.content_popup {
  position: fixed;
  width: 50%;
  height: 66%;
  left: 25%;
  top: 20%;
  transition: all 0.4s;
  z-index: 9999999999999999;
  opacity: 1;
}
.content_popup img {
  width: 100%;
  height: 100%;
}
header {
  padding: 10px 20px;
  border-bottom: 1px solid #eee;
  background: #fff;
}

header:after {
  display: block;
  content: '';
  clear: both;
}

.basket ul {
  padding: 0;
  margin-top: 40px;
}

.basket li {
  display: inline-block;
  list-style-type: none;
  width: 30%;
  margin: 30px 1.5%;
  text-align: center;
}

.basket button {
  border-radius: 10px;
  cursor: pointer;
}

.basket header div {
  float: right;
  position: relative;
  z-index: 1;
}

.basket header h1 {
  float: left;
}

/* animation */

.zoom {
  /* position: absolute; */
  position: fixed;
  width: 20%;
  height: 20%;
  opacity: 0;
  animation: zoom 1s linear forwards;
}

@keyframes zoom {
  from {
    opacity: 5;
  }
  to {
    opacity: 0;
    top: 0px;
    right: 40px;
  }
}
</style>
