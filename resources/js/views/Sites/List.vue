<template>
  <v-container class="c-list">
    <md-header >
      <h2><router-link :to="{ name: 'Sites' }">Services</router-link></h2>
      <v-btn class="primary" @click="$refs.modalSiteForm.$emit('open')">Add new</v-btn>
    </md-header>
    <v-flex lg12>
      <md-crud-table
        ref="table"
        :headers="headers"
        :filter-options="filterOptions"
        selectable
        store-module-name="sites"
        @edit="editSite"
        @show="showSite">
      </md-crud-table>
    </v-flex>
    <modal-site-form
        ref="modalSiteForm"
        @success="$refs.table.$emit('refresh')">
    </modal-site-form>
	</v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import MenuItem from 'Components/Menu/MenuItem'
  import MdCrudTable from 'Components/MdCrudTable'
  import ModalSiteForm from 'Components/Modals/SiteForm'
  import {mapGetters} from 'vuex'

  export default {

    name: 'ViewSitesList',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', class: 'pl-0'},
          { text: 'Phone', value: 'phone'},
          { text: 'Address', value: 'address'},
          { text: 'Assets', value: 'assets_count'},
          { text: 'Employees', value: 'employees_count'}
        ],
        filterOptions: [
          'with_trashed'
        ],
        loading: false
      }
    },

    methods: {
      editSite(site) {
        this.$refs.modalSiteForm.$emit('open', site.id)
      },
      showSite(site) {
        this.$router.push({ name: 'SitesShow', params: { id: site.id }})
      }
    },

    components: {
      MdHeader,
      MenuItem,
      MdCrudTable,
      ModalSiteForm
    }

  }
</script>
