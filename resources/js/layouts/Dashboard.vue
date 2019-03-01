<template>
  <v-app>
  	<dashboard-menu></dashboard-menu>
    <dashboard-toolbar></dashboard-toolbar>
    <v-content>
      <slot></slot>
    </v-content>
    
  </v-app>
</template>

<script>
	import DashboardMenu from 'Layouts/DashboardMenu'
  import DashboardToolbar from 'Layouts/DashboardToolbar'

  export default {

    name: 'LayoutDashboard',

    components: {
    	DashboardMenu,
      DashboardToolbar
    }

  }
</script>