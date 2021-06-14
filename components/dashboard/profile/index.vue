<template>
    <div>
       Hello
        <!-- <large v-if="this.$auth.user.role_id == 6"></large>
        <basic v-else></basic> -->
    </div>
</template>
<script>
import basic from "~/components/dashboard/profile/basic";
import large from "~/components/dashboard/profile/large";

export default {
  
  components: {
    // Hero,
    // BasicElements,
    // Inputs,
    // CustomControls,
    // Navigation,
    // JavascriptComponents,
    // Carousel,
    // Icons,
    // Examples,
    // DownloadSection
    basic,
    large
  }
};
</script>