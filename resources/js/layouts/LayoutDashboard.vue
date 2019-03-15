<template>
  <v-app>
  	<the-dashboard-menu></the-dashboard-menu>
    <the-dashboard-toolbar></the-dashboard-toolbar>
    <v-content>
      <slot></slot>
    </v-content>
    
  </v-app>
</template>

<script>
	import TheDashboardMenu from 'Layouts/TheDashboardMenu'
  import TheDashboardToolbar from 'Layouts/TheDashboardToolbar'

  export default {

    name: 'layout-dashboard',

    components: {
    	TheDashboardMenu,
      TheDashboardToolbar
    }

  }
</script>