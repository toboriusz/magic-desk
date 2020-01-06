<template>
  <v-container>
    <md-header>
      <h2>Settings</h2>
      <span>Asset Types</span>
      <v-btn class="primary" @click="$refs.modalAssetTypeForm.$emit('open')">Add new</v-btn>
    </md-header>
    <md-crud-table
      ref="table"
      class="mt-3"
      :headers="headers"
      :filter-options="filterOptions"
      :itemsPerPageOptions="[-1]"
      store-module-name="assetTypes"
      @edit="editAssetType"
      @show="showAssetType">
    </md-crud-table>

    <modal-asset-type-form
        ref="modalAssetTypeForm"
        @success="$refs.table.$emit('refresh')">
    </modal-asset-type-form>
  </v-container>
</template>

<script>

  import { mapGetters } from 'vuex'
  import MdCrudTable from 'Components/MdCrudTable'
  import MdHeader from 'Components/MdHeader'
  import ModalAssetTypeForm from 'Components/Modals/AssetTypeForm'

  export default {

    name: 'SettingsAssetTypes',

    data() {
      return {
        headers: [
          { text: '', value: 'icon', sortable: false, width: '50px', type: 'icon'},
          { text: 'Name', value: 'name', align: 'left', class: 'pl-0'},
          { text: 'Assets', value: 'assets_count'}
        ],
        filterOptions: [
          'with_trashed'
        ],
        loading: false
      }
    },

    methods: {
      editAssetType(assetType) {
        this.$refs.modalAssetTypeForm.$emit('open', assetType.id)
      },
      showAssetType(assetType) {
        this.$router.push({ name: 'SettingsAssetTypesShow', params: { id: assetType.id }})
      }
    },

    components: {
      MdCrudTable,
      MdHeader,
      ModalAssetTypeForm
    }

  }
</script>