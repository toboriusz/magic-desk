<template>
  <v-layout row wrap align-center class="v-header mb-4">
    <slot ></slot>
  </v-layout>
</template>

<script>
  export default {
    
    name: 'v-header'

  } 
  
</script>

<style lang="sass">
  .v-header
    font-size: 24px

    h2,
    & > span,
    & > a
      margin: 0
      margin-right: 10px
      
    & > span,
    & > a
      &:before
        content: '\/'
        margin-right: 10px

    & > a
      font-weight: 400

    & > span
      font-weight: 300

    a
      text-decoration: none

</style>
