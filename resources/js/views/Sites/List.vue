<template>
  <v-container class="c-list">
    <v-header >
      <router-link :to="{ name: 'Sites' }"><h2>Sites</h2></router-link>
      <v-btn class="primary" :to="{ name: 'SitesCreate' }">Add new</v-btn>
    </v-header>
    <v-flex lg12>
      <v-crud-table
        :headers="headers"
        :items="sites"
        :filter-options="filterOptions"
        :loading="loading"
        @filters-changed="updateList">
      </v-crud-table>
    </v-flex>  
	</v-container>
</template>

<script>
  import VHeader from 'Components/VHeader'
  import MenuItem from 'Components/Menu/MenuItem'
  import VCrudTable from 'Components/VCrudTable'
  import {mapGetters} from 'vuex'


  export default {

    name: 'ViewSitesList',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', class: 'pl-0'},
          { text: 'Shortcode', value: 'shortcode'},
          { text: 'Address', value: 'address'},
          { text: 'Assets', value: 'assets_count'}
        ],
        filterOptions: [
          'with_trashed'
        ],
        loading: false
      }
    },

    computed: {
      ...mapGetters('site', {
        sites: 'list'
      })
    },

    methods: {
      updateList(filters) {
        this.loading = true
        this.$store.dispatch('site/fetchList', filters).finally((res) => {
          this.loading = false
        })
      }
    },

    mounted() {
      this.loading = true
      this.$store.dispatch('site/fetchList').finally(() => {
        this.loading = false
      })
    },

    components: {
      VHeader,
      MenuItem,
      VCrudTable
    }

  }
</script>
