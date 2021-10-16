<template>
  <div class="main-body">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <JobFilter />
        </div>
        <div class="col-md-8 col-lg-8">
          <div class="company-profile-layout">
            <!-- people info -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JobFilter from '~/components/customDesign/JobFilter/JobFilter.vue'
export default {
  layout: 'customDesign',
  components: {
    JobFilter
  }
}
</script>

<style lang="scss">
$cv-primary: #0ba88c;
$cv-font: #1d3146;
.main-body {
  margin-top: 100px;
}
</style>
