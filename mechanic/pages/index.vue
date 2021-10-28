<template>
  <div class="main-body">
    <!-- <test-nav> </test-nav> -->
    <!-- hero section -->
    <HeroSection />
    <!-- job categories -->
    <JobCategory
      :category="this.$store.state.jobs.all_jobs_category"
      :jobs="this.$store.state.jobs.all_job_type"
      @change-job="updateJobs"
    />
    <div class="mb-5"></div>
    <!-- hot jobs -->
    <HotJobs
      :jobsAll="this.$store.state.jobs.job_owner_with_post"
      :category="this.$store.state.jobs.all_jobs_category"
    />
    <div class="mb-5"></div>
    <!-- career section -->
    <CarrerSection />
    <div class="mb-2"></div>
    <!-- Features -->
    <Features />
    <!-- success story -->
    <!-- <SuccessStory /> -->
    <div class="mb-5"></div>
    <!-- support -->
    <Support />
    <div class="mb-5"></div>

    <!-- vendor -->
    <!-- <Vendor /> -->
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
  },
  data() {
    return {
      category: []
    }
  },
  methods: {
    // event emit for job changes
    updateJobs(e) {
      console.log(e)
    }
  },
  created() {
    this.$store.dispatch('jobs/all_job_type')
    this.category = this.$store.dispatch('jobs/job_category')
    this.$store.dispatch('jobs/job_with_owner')

    // console.log(this.$store.state.jobs.all_jobs_category)
  },
  mounted() {
    // this.$store.dispatch('jobs/all_job_type')
  }
}
</script>

<style lang="scss"></style>
