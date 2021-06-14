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
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        class="collapse navbar-collapse main-menu-item"
        id="navbarSupportedContent"
      >
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-1" v-for="(nav, i) in navs" :key="i">
            <nuxt-link class="nav-link" :to="nav.link">{{
              nav.label
            }}</nuxt-link>
          </li>
        </ul>

        <location-dropdown class="ml-1 mr-2 mb-0"></location-dropdown>

        <!-- <button
          class="btn btn-sm bg-custom-primary ml-1"
          @click="$store.commit('popup/showPopup', 'login-options')"
        >
          Login
        </button> -->

        <b-dropdown size="sm" class="profile-dropdown">
          <template #button-content>
            <fa icon="user"></fa>
          </template>
          <b-dropdown-item-button
            ><nuxt-link to="/user/dashboard"
              >Dashboard</nuxt-link
            ></b-dropdown-item-button
          >
          <b-dropdown-item-button
            ><nuxt-link to="/user/profile"
              >Profile</nuxt-link
            ></b-dropdown-item-button
          >
          <b-dropdown-item-button
            ><nuxt-link to="/user/orders"
              >Your Orders</nuxt-link
            ></b-dropdown-item-button
          >
          <!-- <b-dropdown-item-button
            ><nuxt-link to="/user/offers"
              >Offers</nuxt-link
            ></b-dropdown-item-button
          > -->
          <b-dropdown-item-button>Logout</b-dropdown-item-button>
        </b-dropdown>
      </div>
    </div>
  </nav>
</template>

<script>
import LocationDropdown from "../inc/LocationDropDown.vue";
export default {
  components: {
    LocationDropdown,
  },
  data: () => ({
    navs: [
      {
        label: "Home",
        link: "/",
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
        label: "Services",
        link: "services",
      },
      {
        label: "About",
        link: "about",
      },
      {
        label: "Contact",
        link: "contact",
      },
      // {
      //   label: "Terms & conditions",
      //   link: "terms_conditions",
      // },
    ],
    locations: [
      {
        name: "Kallyanpur",
        value: "kallyanpur",
      },
      {
        name: "Rampura",
        value: "Rampura",
      },
      {
        name: "Mirpur",
        value: "Mirpur",
      },
      {
        name: "Uttara",
        value: "Uttara",
      },
      {
        name: "Dhanmondi",
        value: "Dhanmondi",
      },
    ],
  }),
};
</script>

<style lang='scss' scoped>
.navbar-nav {
  .nav-item {
    .nav-link {
      color:#1d3146;
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
.logoImage{
    min-height: 50px;
}
</style>