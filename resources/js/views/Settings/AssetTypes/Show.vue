<template>
  <v-container>
    <md-header>
      <h2>Settings</h2>
      <router-link :to="{ name: 'SettingsAssetTypes' }">Asset Types</router-link>
      <span>{{ assetType.name }}</span>
    </md-header>

    <v-tabs
      v-model="activeTab"
      color="transparent"
      slider-color="black">
      <v-tab ripple>General</v-tab>
      <v-tab ripple>Product models</v-tab>
      <v-tab ripple>Asset states</v-tab>

      <v-tab-item :transition="false" :reverse-transition="false">
        <settings-assets-type-general></settings-assets-type-general>  
      </v-tab-item>
      <v-tab-item :transition="false" :reverse-transition="false">
        <settings-assets-type-products></settings-assets-type-products> 
      </v-tab-item>
      <v-tab-item :transition="false" :reverse-transition="false">
        <settings-assets-type-states></settings-assets-type-states> 
      </v-tab-item>
    </v-tabs>
  </v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import SettingsAssetsTypeGeneral from 'Components/Settings/AssetTypeGeneral'
  import SettingsAssetsTypeProducts from 'Components/Settings/AssetTypeProducts'
  import SettingsAssetsTypeStates from 'Components/Settings/AssetTypeStates'
  import { mapGetters } from 'vuex'

  export default {
    name: 'ViewSettingsAssetTypeShow',

    computed: {
      ...mapGetters('assetTypes', {
        assetType: 'assetType'
      })
    },

    data() {
      return {
        activeTab: 0
      }
    },

    mounted () {
      this.$store.dispatch('assetTypes/fetch', this.$route.params.id)
    },

    components: {
      MdHeader,
      SettingsAssetsTypeGeneral,
      SettingsAssetsTypeProducts,
      SettingsAssetsTypeStates
    }
  }

</script>

