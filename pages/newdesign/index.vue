<template>
  <div class="main-body">
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis esse
      quo dolor ea maiores eum, voluptates, obcaecati consequuntur sunt, nam
      unde molestiae! Unde laborum facere nostrum eius eos accusantium quis.
    </p>
    <!-- <test-nav> </test-nav> -->
    <!-- hero section -->
    <HeroSection />
    <!-- job categories -->
    <JobCategory />
    <div class="mb-5"></div>
    <!-- hot jobs -->
    <HotJobs />
    <div class="mb-5"></div>
    <!-- career section -->
    <CarrerSection />
    <div class="mb-2"></div>
    <!-- Features -->
    <Features />
    <!-- success story -->
    <SuccessStory />
    <div class="mb-5"></div>
    <!-- support -->
    <Support />
    <div class="mb-5"></div>

    <!-- vendor -->
    <Vendor />
    <div class="mb-4"></div>
    <!-- footer -->
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
import HeroSection from '~/components/customDesign/HeroSection/HeroSection.vue'
import Vendor from '~/components/customDesign/Vendor/Vendor.vue'

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
    Support,
    HeroSection,
    Vendor
  }
}
</script>

<style lang="scss"></style>
