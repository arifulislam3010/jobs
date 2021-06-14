<template>
    <div>
        <large v-if="this.$auth.user.role_id == 6"></large>
        <Agent v-if="this.$auth.user.role_id == 3"></Agent>
        <basic v-if="this.$auth.user.role_id == 9 || this.$auth.user.role_id == 1"></basic>
    </div>
</template>
<script>
import basic from "~/components/dashboard/profile/basic";
import large from "~/components/dashboard/profile/large/index";
import Agent from "~/components/dashboard/profile/agency/index";

export default {
  layout:'dashboard',
  middleware:'auth',
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
    large,
    Agent
  }
};
</script>