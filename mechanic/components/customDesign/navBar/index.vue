<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
    <div class="container">
      <nuxt-link class="navbar-brand" to="/"
        ><img src="~/assets/icon/logo_custom.png" class="logoImage"
      /></nuxt-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      @click="mobilenav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        class="collapse navbar-collapse main-menu-item"
        id="navbarSupportedContent"
      >
       <span class="nav_close" v-show="isMobile" @click="hideMobileNav">X</span>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-1" v-for="(nav, i) in navs" :key="i">
            <nuxt-link class="nav-link" :to="nav.link">{{
              nav.label
            }}</nuxt-link>
          </li>
           <li class="nav-item mx-1" v-show="$auth.loggedIn!=true">
            <nuxt-link class="nav-link" to="/login">Login</nuxt-link>
          </li>
          <li class="nav-item mx-1" v-show="$auth.loggedIn!=true">
            <nuxt-link class="nav-link" to="/register">Registration</nuxt-link>
          </li>
        </ul>

        <!-- <location-dropdown class="ml-1 mr-2 mb-0"></location-dropdown> -->
        <!-- <nuxt-link class="btn btn-sm bg-custom-primary ml-1" to="/login">Login</nuxt-link> -->

        <b-dropdown size="sm" class="profile-dropdown" v-show="$auth.loggedIn">
          <template #button-content>
            <img class="u_p" src="~/assets/image/u.png">
            <!-- <fa icon="user"></fa> -->
            <!-- <i class="fas fa-user"></i> -->
            <!-- <i class="far fa-user-circle"></i> -->
          </template>
          <b-dropdown-item-button
            ><nuxt-link to="/dashboard">Dashboard</nuxt-link
            ></b-dropdown-item-button
          >
          <b-dropdown-item-button
            ><nuxt-link to="/dashboard/profile"
              >Profile</nuxt-link
            ></b-dropdown-item-button
          >
          <!-- <b-dropdown-item-button
            ><nuxt-link to="/user/orders"
              >Your Orders</nuxt-link
            ></b-dropdown-item-button
          > -->
          <!-- <b-dropdown-item-button
            ><nuxt-link to="/user/offers"
              >Offers</nuxt-link
            ></b-dropdown-item-button
          > -->
          <b-dropdown-item-button  @click="logout">Logout</b-dropdown-item-button>
        </b-dropdown>
      </div>
    </div>
  </nav>
</template>

<script>
import LocationDropdown from '../inc/LocationDropDown.vue'
import { isMobile } from 'mobile-device-detect';
export default {
  components: {
    LocationDropdown
  },
  data: () => ({
    isMobile:isMobile,
    navs: [
      {
        label: 'Home',
        link: '/'
      },
      // {
      //   label: "Shop",
      //   link: "#",
      // },
      // {
      //   label: "Rent",
      //   link: "#",
      // },
      {
        label: 'Job-Search',
        link: '/job-search'
      },
      {
        label: 'About',
        link: '/about'
      },
      {
        label: 'Contact',
        link: '/contact'
      }
      // {
      //   label: "Terms & conditions",
      //   link: "terms_conditions",
      // },
    ],
    locations: [
      {
        name: 'Kallyanpur',
        value: 'kallyanpur'
      },
      {
        name: 'Rampura',
        value: 'Rampura'
      },
      {
        name: 'Mirpur',
        value: 'Mirpur'
      },
      {
        name: 'Uttara',
        value: 'Uttara'
      },
      {
        name: 'Dhanmondi',
        value: 'Dhanmondi'
      }
    ]
  }),

methods: {
    async logout() {
       this.$auth.logout()
    },
    mobilenav(){
      var element = document.getElementById("navbarSupportedContent");
      element.classList.add("show");
    },
    hideMobileNav(){
       var element = document.getElementById("navbarSupportedContent");
      element.classList.remove("show");
    }
 }
}
</script>

<style lang="scss" scoped>
.u_p{
  width: 18px;
  height: 100%;
}
.nav_close{
  padding: 4px;
  cursor: pointer;
  float: right;
  border: 1px solid;
}
.navbar-nav {
  .nav-item {
    .nav-link {
      color: #1d3146;
      &.nuxt-link-exact-active,
      &:hover {
        color: #0ba88c;
      }
    }
  }
}
</style>

<style lang="scss">
.location-dropdown,
.profile-dropdown {
  .btn-secondary,
  &.show > .btn-secondary {
    color: #1d3146;
    background-color: #f9f9f9;
    border-color: #e4e4e4;
    padding-left: 10px;
    padding-right: 10px;
  }
}
.profile-dropdown {
  .dropdown-toggle::after {
    content: none;
  }
  svg path {
    fill: #0ba88c;
  }
}
.logoImage {
  min-height: 50px;
}
</style>
