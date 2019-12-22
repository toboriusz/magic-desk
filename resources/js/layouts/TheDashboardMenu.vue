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
        <img :src="require('Assets/logo-light.svg')" alt="Magic Desk">
      </router-link>
    </v-toolbar>
    <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings">
      <v-list dense expand>
        <menu-item :to="{ name: 'Dashboard' }" icon="dashboard">Dashboard</menu-item>
        <menu-item :to="{ name: 'Users' }" icon="group">Users</menu-item>
        <menu-item :to="{ name: 'Sites' }" icon="home">Services</menu-item>
        <menu-item has-submenu title="Settings" icon="settings">
          <menu-sub-item :to="{ name: 'SettingsGeneral' }">General</menu-sub-item>
          <menu-sub-item :to="{ name: 'SettingsAssetTypes' }">Asset Types</menu-sub-item>
          <menu-sub-item :to="{ name: 'SettingsUserPermissions' }">User permissions</menu-sub-item>
          <menu-sub-item :to="{ name: 'SettingsStates' }">Asset states</menu-sub-item>
          <menu-sub-item :to="{ name: 'SettingsAbout' }">About</menu-sub-item>
        </menu-item>
        <v-divider></v-divider>
        <v-subheader>Assets</v-subheader>
        <menu-item
          v-for="assetType in assetTypes"
          :key="assetType.id"
          :to="{ name: 'Assets', params: { assetTypeId: assetType.id } }"
          :icon="assetType.icon">
          {{ assetType.name }}
        </menu-item>
      </v-list>
    </vue-perfect-scrollbar>
  </v-navigation-drawer>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import MenuItem from 'Components/Menu/MenuItem'
import MenuSubItem from 'Components/Menu/MenuSubItem'
import { mapGetters } from 'vuex'

export default {
	name: 'the-dashbord-menu',

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
    ...mapGetters('menu',{
      assetTypes: 'assetTypes'
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
    if(window.innerWidth < 1264)
      this.$store.dispatch('menu/setDrawer', false)
    else
      this.menuOpen = this.drawer

    this.$store.dispatch('menu/fetchAssetTypes')
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
      
      & > img
        max-width: 180px
        width: 100%

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
