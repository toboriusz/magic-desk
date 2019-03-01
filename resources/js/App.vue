<template>

  <div id="app">
    <component v-if="$auth.ready()" :is="layout">
      <router-view></router-view>
    </component>
  </div>

</template>


<script>

  import LayoutPublic from 'Layouts/Public'
  import LayoutDashboard from 'Layouts/Dashboard'
  
  const default_layout = 'dashboard'
  
  export default {

    name: 'App',

    computed: {
      layout () {
        return (this.$route.meta.layout || default_layout)
      }
    },

    components: {
      'dashboard': LayoutDashboard,
      'public': LayoutPublic
    }

  }

</script>

<style lang="sass">

  #app
    width: 100%
    height: 100%

</style>