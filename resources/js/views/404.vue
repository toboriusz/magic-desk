<template functional>
  <v-flex class="text-xs-center mt-2 mb-5 p-404">
    <h2 class="p-404__title">404</h2>
    <h3 class="p-404__subtitle">Page not found</h3>
    <v-btn to="/" class="primary mt-4">Go back</v-btn>
  </v-flex>
</template>


<script>
  export default {

    name: 'view-404'

  }
</script>

<style lang="sass">
  .p-404
    &__title
      font-size: 60px
      font-weight: bold
    &__subtitle
      font-size: 30px
      
</style>

