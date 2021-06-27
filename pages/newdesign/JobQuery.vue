<template>
  <div class="main-body ">
    <div class="container mt-5">
      <JobCard />

      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
          terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer
          labore wes anderson cred nesciunt sapiente ea proident.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JobCard from '~/components/customDesign/JobDetails/JobCard.vue'
export default {
  layout: 'customDesign',
  components: {
    JobCard
  }
}
</script>

<style lang="scss">
.main-body {
  margin-top: 100px;
}
</style>
