const pkg = require('./package');
// const env = require('./env').config();
require('dotenv').config();
module.exports = {
  mode: 'universal',

  /*
  ** Headers of the page
  */
  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { name: 'X-UA-Compatible', content: 'IE=edge' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1.0, maximum-scale=1.5, user-scalable=1, shrink-to-fit=no' },
      { hid: 'description', name: 'description', content: pkg.description },
      { name: 'author', content: 'Ariful Islam, Arad Bin' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Hind+Siliguri:500,600,700&display=swap&subset=bengali' }
    ]
  },

  /*
  ** Configuration for @nuxtjs/pwa
  ** https://developer.mozilla.org/en-US/docs/Web/Manifest
  */
  manifest: {
    name: 'অভিবাসী বাতায়ন',
    short_name: 'অভিবাসী বাতায়ন',
    description: 'অভিবাসী বাতায়ন',
    theme_color: '#172b4d',
  },

  meta: {
    // apple-mobile-web-app-capable=yes
    // https://medium.com/@firt/dont-use-ios-web-app-meta-tag-irresponsibly-in-your-progressive-web-apps-85d70f4438cb
    mobileAppIOS: true,
    appleStatusBarStyle: '#172b4d'
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: 'red',
  height: '10px'},

  /*
  ** Global CSS
  */
  css: [
    '~assets/style.css',
    '~assets/argon/vendor/nucleo/css/nucleo.css',
    '@fortawesome/fontawesome-free/css/all.css',
    // '~assets/argon/scss/argon.scss',
    // 'bootstrap-vue/dist/bootstrap-vue.css',
    '~assets/transitions.css',
    '~assets/argon/css/argon-design-system.mine209.css',
    '~assets/argon/vendor/font-awesome/css/font-awesome.min.css',
  ],
  izitoast: {
    position: 'bottomRight',
    transitionIn: 'bounceInLeft',
    transitionOut: 'fadeOutRight',
  },

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    { src: '~/plugins/flipbook', mode: 'client'},
    { src: '~/plugins/editor', mode: 'client'},
    { src: '~/plugins/ant-design', mode: 'client'},
    { src: '~/plugins/b-v', mode: 'client'},
    { src: '~/plugins/tree', mode: 'client'},
    { src: '~/plugins/argon/argon-kit' },
    { src: '~/plugins/excel', mode: 'client' },
    { src: '~/plugins/lightbox', mode: 'client' },
    { src: '~/plugins/rating_input', mode: 'client' },
    // '~/packages/Auth',
    // '~/plugins/argon/glide'
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    [
      'vue-sweetalert2/nuxt',
      {
        confirmButtonColor: '#41b882',
        cancelButtonColor: '#ff7674'
      }
    ],
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    // Doc: https://bootstrap-vue.js.org/docs/
    ['bootstrap-vue/nuxt', {
      bootstrapCSS: false,
      bootstrapVueCSS: true,
      componentPlugins: [
        'Carousel',
        'Spinner'
      ],
      directivePlugins: [
        'Tooltip',
        'Popover'
      ]
    }],
    '@nuxtjs/pwa',
    '@nuxtjs/auth',
    '@nuxtjs/dotenv',
    'nuxt-izitoast',
  ],
  /*
  ** Axios module configuration
  */
 axios: {
  baseURL: process.env.LARAVEL_ENDPOINT
},

auth: {
  redirect: {
    login: '/login',
    logout: '/',
    callback: '/login',
    home: '/dashboard'
  },
  strategies: {
    local: false,
    password_grant: {
      _scheme: 'local',
      endpoints: {
        login: {
          url: 'oauth/login',
          method: 'post',
          propertyName: 'access_token'
        },
        logout: false,
        user: {
          url: 'api/auth/me',
          method: 'get',
          propertyName: 'user'
        }
      }
    }
  }
},

  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {

    }
  },
  // router: {
  //   middleware: ['index']
  // },
}
