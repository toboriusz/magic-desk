<template>
  <v-app>
  	<the-dashboard-menu></the-dashboard-menu>
    <the-dashboard-toolbar></the-dashboard-toolbar>
    <v-content class="p-rel">
      <slot></slot>
      <md-loading :loading="pageLoading" color="grey lighten-5"></md-loading>  
    </v-content>
  </v-app>
</template>

<script>
	import TheDashboardMenu from 'Layouts/TheDashboardMenu'
  import TheDashboardToolbar from 'Layouts/TheDashboardToolbar'
  import MdLoading from 'Components/MdLoading'
  import {mapGetters} from 'vuex'

  export default {

    name: 'layout-dashboard',

    computed: {
      ...mapGetters('pageLoader', {
        pageLoading: 'loading'
      })
    },

    components: {
    	TheDashboardMenu,
      TheDashboardToolbar,
      MdLoading
    }

  }
</script>
