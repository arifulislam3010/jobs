<template>
  <div class="main-body">
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis esse
      quo dolor ea maiores eum, voluptates, obcaecati consequuntur sunt, nam
      unde molestiae! Unde laborum facere nostrum eius eos accusantium quis.
    </p>
    <!-- <test-nav> </test-nav> -->
    <div class="mt-5"></div>
    <!-- hot jobs -->
    <HotJobs />
    <!-- success story -->
    <SuccessStory />
    <!-- career section -->
    <CarrerSection />
    <Footer />
  </div>
</template>

<script>
// import TestNav from '~/components/customDesign/test/test.vue'
import Footer from '~/components/customDesign/Footer/Footer.vue'
import CarrerSection from '~/components/customDesign/Career/Career.vue'
import HotJobs from '~/components/customDesign/HotJobs/HotJobs.vue'
import SuccessStory from '~/components/customDesign/SuccessSotry/SuccessStory.vue'

export default {
  layout: 'customDesign',

  components: {
    // TestNav,
    Footer,
    CarrerSection,
    HotJobs,
    SuccessStory
  }
}
</script>

<style lang="scss"></style>
