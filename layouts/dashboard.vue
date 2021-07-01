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
import MainNav from '~/components/customDesign/navBar/index.vue'
export default {
  components: {
    MainNav
  }
}
</script>

<style lang="scss">
.customDesign {
  font-family: Poppins;
  h1,
  h2,
  h3,
  h4,
  h5,
  p,
  a,
  span,
  li {
    font-family: Poppins !important;
  }
}
</style>
