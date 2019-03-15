<template>
  <v-flex class="v-header mb-4 grey--text">
    <slot ></slot>
  </v-flex>
</template>

<script>
  export default {
    
    name: 'v-header'

  }
  
</script>

<style lang="sass">
  .v-header
    display: flex
    align-items: center

    h2,
    & > span,
    & > a
      margin: 0
      margin-right: 10px
      text-decoration: none

    & > span
      font-weight: 300
      font-size: 24px
      &:before
        content: '>'
        margin-right: 10px


</style>
