<template>
 <v-toolbar
    class=""
    color="primary"
    fixed
    dark
    app
    >
    <v-toolbar-title class="ml-0 pl-3">
      <v-toolbar-side-icon @click.stop="handleDrawerToggle"></v-toolbar-side-icon>
    </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        prepend-icon="search"
        label="Search"
        class="hidden-sm-and-down ml-5 toolbar-margin-fix"
        >
      </v-text-field>
      <v-spacer></v-spacer>   
      <v-btn icon @click="handleFullScreen()">
        <v-icon>fullscreen</v-icon>
      </v-btn>
      <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
        <v-btn flat slot="activator">
          {{ $auth.user().name }}
          <v-icon class="ml-1">keyboard_arrow_down</v-icon>
        </v-btn>
        <v-list class="pa-0">
          <v-list-tile v-for="(item,index) in userMenu" :to="item.to ? { name: item.to } : null" @click="" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="index">
            <v-list-tile-action v-if="item.icon">
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
  </v-toolbar>
</template>

<script>
import Utils from 'Utils'
import {mapGetters} from 'vuex'

export default {
	name: 'DashboardToolbar',

  computed: {
    ...mapGetters('menu', [
      'userMenu'
    ])
  },

  methods: {
    handleDrawerToggle () {
      this.$store.dispatch('menu/toggle')
    },
    handleFullScreen () {
      Utils.toggleFullScreen();
    }
  }  

}
</script>

<style lang="sass">
  .toolbar-margin-fix
    .v-input__slot
      margin-bottom: 0
</style>