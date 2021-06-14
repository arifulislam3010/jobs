<template>
  <v-app class="customDesign">
      <div class="mainnav">
          <main-nav></main-nav>
      </div>
      <div class="customBody">
          <Nuxt />
      </div>
  </v-app>
</template>

<script>
import MainNav from '~/components/customDesign/navBar/index.vue'
export default {
components:{
    MainNav
}
}
</script>

<style>

</style>