<template>
  <v-navigation-drawer
    class="l-d-menu main-menu"
    :mini-variant.sync="mini"
    fixed
    :dark="$vuetify.dark"
    app
    v-model="menuOpen"
    width="260"
    >
    <v-toolbar color="primary darken-1" dark>
      <router-link to="/" class="l-d-menu__logo">
        <img :src="require('Assets/logo-light.svg')" height="50" alt="Magic Desk">   
      </router-link>
    </v-toolbar>
    <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings">
      <v-list dense expand>
        <menu-item :to="{ name: 'Dashboard' }" icon="dashboard">Dashboard</menu-item>
        <menu-item :to="{ name: 'Users' }" icon="group">Users</menu-item>
        <menu-item :to="{ name: 'Sites' }" icon="home">Sites</menu-item>
        <menu-item has-submenu title="Settings" icon="settings">
          <menu-sub-item :to="{ name: 'Settings', params: { page: 'general' } }">General</menu-sub-item>
          <menu-sub-item :to="{ name: 'Settings', params: { page: 'assets' } }">Assets</menu-sub-item>
          <menu-sub-item :to="{ name: 'Settings', params: { page: 'probe' } }">Probe</menu-sub-item>
          <menu-sub-item :to="{ name: 'Settings', params: { page: 'technicians' } }">Technicians</menu-sub-item>
          <menu-sub-item :to="{ name: 'Settings', params: { page: 'about' } }">About</menu-sub-item>
        </menu-item>
        <v-divider></v-divider>
        <v-subheader>Assets</v-subheader>
        <menu-item 
          v-for="assetType in assetTypes" 
          :key="assetType.id" 
          :to="{ name: 'Assets', params: { type: assetType.name } }" 
          :icon="assetType.icon">
          {{ assetType.title }}
        </menu-item>
        <v-divider></v-divider>
        <v-subheader>Quick actions</v-subheader>
      </v-list>
    </vue-perfect-scrollbar>
  </v-navigation-drawer>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import MenuItem from 'Components/Menu/Item'
import MenuSubItem from 'Components/Menu/SubItem'
import { mapGetters } from 'vuex'

export default {
	name: 'DashboardMenu',

  data: () => ({
    mini: false,
    menuOpen: false,
		scrollSettings: {
      maxScrollbarLength: 160
    }
  }),

  computed: {
    ...mapGetters('menu',{
      drawer: 'drawer'
    }),
    ...mapGetters('asset',{
      assetTypes: 'types'
    }),
    sideToolbarColor () {
      return this.$vuetify.options.extra.sideNav;
    } 
  },

  methods: {
    genChildTarget (item, subItem) {
      if (subItem.href) return;
      if (subItem.component) {
        return {
          name: subItem.component,
        };
      }
      return { name: `${item.group}/${(subItem.name)}` };
    }
  },

  watch: {
    drawer(value) {
      this.menuOpen = value
    },
    menuOpen(value) {
      this.$store.dispatch('menu/setDrawer', value)
    }
  },

  created () {
    this.menuOpen = this.drawer
    //this.$store.dispatch('assets/fetchTypes')
  },

  components: {
    VuePerfectScrollbar,
    MenuItem,
    MenuSubItem
  },
}
</script>

<style lang="sass">

  .l-d-menu
    &__logo
      display: flex
      align-items: center

  .main-menu
    overflow: hidden

    &--scroll
      height: calc(100vh - 48px)
      overflow: auto

    &__footer
      position: absolute
      bottom: 0
      left: 0



</style>