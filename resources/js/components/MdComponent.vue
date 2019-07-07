<template>
  <div>Content</div>
</template>

<script>
  import VBtn from '@/components/VBtn'
  export default {
    
    name: 'md-name',

    mixins: [],

    extends: {},
    
    props: {},

    data () {
      return {}
    },

    computed: {},

    watch: {},

    methods: {},

    //Lifecycle hooks
    beforeCreate () {},
    created () {},
    beforeMount () {},
    mounted () {},
    beforeUpdate () {},
    updated () {},
    beforeDestroy () {},
    destroyed () {},

    components: {
      VBtn
    }

  }
  
</script>

<style lang="sass">

  @import '~Style/_utils.sass'

  .md-component_name

    &__element
      
      &-sub_element

      &--modifier

</style>
