<template>
  <div class="main-body ">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <JobFilter />
        </div>
        <div class="col-md-8 col-lg-8">
          <div
            class="job-card-component-heading d-flex justify-content-between mb-3"
          >
            <div class="job-card-component-heading-content">
              <h6><span>Job for : </span> Product Designer</h6>
            </div>
            <div class="job-card-component-heading-content">
              <h6>48 jobs <span>are available</span></h6>
            </div>
          </div>
          <JobCard />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JobCard from '~/components/customDesign/JobDetails/JobCard.vue'
import JobFilter from '~/components/customDesign/JobFilter/JobFilter.vue'
export default {
  layout: 'customDesign',
  components: {
    JobCard,
    JobFilter
  }
}
</script>

<style lang="scss">
.main-body {
  margin-top: 100px;
}
.job-card-component-heading-content {
  h6 {
    font-weight: 500;
    font-size: 14px;
    color: #1d3146;
    span {
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      color: rgba(29, 49, 70, 0.6);
    }
  }
}
.job-filter-form {
  select {
    color: #1d3146;
    margin-bottom: 1rem;
  }
}
</style>
