<template>

  <div id="app">
    <component v-if="$auth.ready()" :is="layout">
      <router-view></router-view>
    </component>
  </div>

</template>


<script>

  import LayoutPublic from 'Layouts/LayoutPublic'
  import LayoutDashboard from 'Layouts/LayoutDashboard'

  const default_layout = 'dashboard'

  export default {

    name: 'App',

    computed: {
      layout () {
        return 'layout-' + (this.$route.meta.layout || default_layout)
      }
    },

    mounted () {
        document.body.classList.add('loaded')
    },

    components: {
      LayoutDashboard,
      LayoutPublic
    }
  }

</script>

<style lang="sass">

  #app
    width: 100%
    height: 100%

</style>
