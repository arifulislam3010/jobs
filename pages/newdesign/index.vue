<template>
  <div class="main-body">
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis esse
      quo dolor ea maiores eum, voluptates, obcaecati consequuntur sunt, nam
      unde molestiae! Unde laborum facere nostrum eius eos accusantium quis.
    </p>
    <!-- <test-nav> </test-nav> -->
    <div class="mt-5"></div>
    <!-- job categories -->
    <JobCategory />
    <!-- hot jobs -->
    <HotJobs />
    <!-- success story -->
    <SuccessStory />
    <!-- support -->
    <Support />
    <!-- career section -->
    <CarrerSection />
    <!-- Features -->
    <Features />
    <Footer />
  </div>
</template>

<script>
// import TestNav from '~/components/customDesign/test/test.vue'
import Footer from '~/components/customDesign/Footer/Footer.vue'
import CarrerSection from '~/components/customDesign/Career/Career.vue'
import HotJobs from '~/components/customDesign/HotJobs/HotJobs.vue'
import SuccessStory from '~/components/customDesign/SuccessSotry/SuccessStory.vue'
import Features from '~/components/customDesign/Features/Features.vue'
import JobCategory from '~/components/customDesign/JobCategory/JobCategory.vue'
import Support from '~/components/customDesign/Support/Support.vue'

export default {
  layout: 'customDesign',

  components: {
    // TestNav,
    Footer,
    CarrerSection,
    HotJobs,
    SuccessStory,
    Features,
    JobCategory,
    Support
  }
}
</script>

<style lang="scss"></style>
