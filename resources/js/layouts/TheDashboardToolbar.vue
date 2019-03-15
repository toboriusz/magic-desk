<template>
 <v-toolbar
    color="primary"
    fixed
    dark
    app
    >
    <v-toolbar-title>
      <v-toolbar-side-icon @click.stop="drawerToggle"></v-toolbar-side-icon>
    </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        append-icon="search"
        label="Search"
        class="hidden-sm-and-down ml-5 toolbar-margin-fix"
        >
      </v-text-field>
      <v-spacer></v-spacer>   
      <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
        <v-btn flat slot="activator">
          {{ $auth.user().first_name }}
          <v-icon class="ml-1">keyboard_arrow_down</v-icon>
        </v-btn>
        <v-list class="pa-0">
          <menu-item :to="{ name: 'Settings', params: { page: 'technicians' }, query: { id: $auth.user().id } }" icon="account_circle">Profile</menu-item>
          <menu-item @click="handleFullScreen" icon="fullscreen">Fullscreen</menu-item>
          <menu-item :to="{ name: 'Logout' }" icon="lock">Logout</menu-item>
        </v-list>
      </v-menu>
  </v-toolbar>
</template>

<script>
import Utils from 'Utils'
import MenuItem from 'Components/Menu/MenuItem'

export default {
	name: 'the-dashboard-toolbar',

  methods: {
    drawerToggle () {
      this.$store.dispatch('menu/toggleDrawer')
    },
    handleFullScreen () {
      Utils.toggleFullScreen()
    }
  },

  components: {
    MenuItem
  }

}
</script>

<style lang="sass">
  .toolbar-margin-fix
    .v-input__slot
      margin-bottom: 0
</style>