<template>
  <fieldset class="md-input-group">
    <legend class="md-input-group__legend">{{ title }}</legend>
    <slot />
 </fieldset>
</template>

<script>
  export default {
    
    name: 'md-input-group',

    props: {
      title: String
    }

  }
  
</script>

<style lang="sass">

  .md-input-group
    border: 2px solid rgba(0,0,0,0.54)
    border-radius: 4px
    padding: 12px

    &__legend
      padding: 0 3px
      margin-left: -3px

</style>
