<template>
    <div>
        <base-nav class="navbar-main" transparent type="" effect="light" expand>
            <nuxt-link slot="brand" class="navbar-brand mr-lg-5" to="/">
                <img src="/argon/img/logo.png">
            </nuxt-link>
            <div class="row" slot="content-header" slot-scope="{closeMenu}">
                <div class="col-6 collapse-brand">
                    <nuxt-link to="/">
                        <img src="/argon/img/logo.png">
                    </nuxt-link>
                </div>
                <div class="col-6 collapse-close">
                    <close-button @click="closeMenu"></close-button>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">হোম</span>
                    </nuxt-link>
                </li>
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/notice-of-appointment">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">নিয়োগ বিজ্ঞপ্তি</span>
                    </nuxt-link>
                </li>
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/list/recruiting-agency">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">সরকার অনুমোদিত এজেন্সি</span>
                    </nuxt-link>
                </li>
                 <li>
                    <nuxt-link  class="nav-link"  role="button" to="/list/training-centers">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">প্রশিক্ষণ কেন্দ্র</span>
                    </nuxt-link>
                </li>
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/list/financial-organization">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">আর্থিক সংস্থা</span>
                    </nuxt-link>
                </li>
                <!-- <li>
                    <nuxt-link  class="nav-link"  role="button" to="/list/recruiting-institute">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">অভিবাসন প্রতিষ্ঠান</span>
                    </nuxt-link>
                </li>
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/list/training-centers">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">প্রশিক্ষন কেন্দ্র</span>
                    </nuxt-link>
                </li> -->
                <!-- <li>
                    <nuxt-link  class="nav-link"  role="button" to="/complain">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">অভিযোগ</span>
                    </nuxt-link>
                </li> -->
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/forms-downloads">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">ফরম ডাউনলোড</span>
                    </nuxt-link>
                </li>
                <li>
                    <nuxt-link  class="nav-link"  role="button" to="/প্রবাসে-করণীয়">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">প্রবাসে করণীয়</span>
                    </nuxt-link>
                </li>
                <!-- <li>
                    <nuxt-link  class="nav-link"  role="button" to="/অভিবাসন-প্রক্রিয়া">
                    <i class="ni ni-ui-04 d-lg-none"></i>
                    <span class="nav-link-inner--text">অভিবাসন প্রক্রিয়া</span>
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.loggedIn" class="nav-item dropdown" v-show="isMobile">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">{{$auth.user.name}}</span>
                    </a>
                    <div class="dropdown-menu">
                        <nuxt-link to="/dashboard/profile" class="dropdown-item">Profile</nuxt-link>
                         <a href="#" @click="logout" class="dropdown-item">লগআউট</a>
                    </div>
                </li> -->
                <li  class="nav-item" v-show="isMobile">
                     <nuxt-link to="/login" class="nav-link" role="button">
                      <i class="ni ni-ui-04 d-lg-none"></i>
                        <span class="nav-link-inner--text">লগইন</span>
                     </nuxt-link>
                </li>
                <li  class="nav-item" v-show="isMobile">
                     <nuxt-link to="/register" class="nav-link" role="button">
                     
                     <i class="ni ni-ui-04 d-lg-none"></i>
                        <span class="nav-link-inner--text">নিবন্ধন</span>
                     </nuxt-link>
                </li>
            </ul>
        </base-nav>
        <PageHeader></PageHeader>
    </div>
</template>
<script>
import BaseNav from "~/components/argon/BaseNav";
import CloseButton from "~/components/argon/CloseButton";
import PageHeader from "~/components/argon/PageHeader";
import { isMobile } from 'mobile-device-detect';
export default {
  middleware: 'auth',
  components: {
    BaseNav,
    CloseButton,
    PageHeader
  },
  data() {
    return {
      strategy: this.$auth.$storage.getUniversal('strategy'),
      isMobile:isMobile
    }
  },
  methods: {
    async logout() {
      await this.$auth.logout()
    }
  }
}
</script>
<style scoped>
.navbar-transparent{
   position: relative;
}
.navbar-transparent .navbar-nav .nav-link {
    color: rgba(13, 11, 11, 0.95);
    padding-top: 0;
}
.navbar-brand img {
    height: 100px;
    margin-top: -36px;
}
.navbar-main .navbar-nav .nav-item.dropdown{
    padding: 0px;
    margin: -8px;
}
.navbar-expand-lg .navbar-nav .nav-link {
    padding-right: 0rem;
    padding-left: 1rem;
}
</style>
