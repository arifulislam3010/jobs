<template>
  <div class="d-flex align-items-center">
    <b-dropdown size="sm" class="m-2 location-dropdown">
      <template #button-content>
        <fa icon="map-marker-alt"></fa>
        Kallyanpur
      </template>
      <b-dropdown-item-button
        v-for="location in locations"
        :key="location.value"
      >
        {{ location.name }}
      </b-dropdown-item-button>
    </b-dropdown>
  </div>
</template>

<script>
export default {
  data: () => ({
    locations: [
      {
        name: "Kallyanpur",
        value: "kallyanpur",
      },
      {
        name: "Rampura",
        value: "Rampura",
      },
      {
        name: "Mirpur",
        value: "Mirpur",
      },
      {
        name: "Uttara",
        value: "Uttara",
      },
      {
        name: "Dhanmondi",
        value: "Dhanmondi",
      },
    ],
  }),
};
</script>

<style lang="scss" scoped>
svg path {
  fill: #0ba88c;
}
</style>