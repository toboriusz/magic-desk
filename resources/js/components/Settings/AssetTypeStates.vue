<template>
  <v-card flat>
    <md-crud-table
      ref="table"
      :actions="actions"
      class="mt-3"
      :headers="headers"
      :predefined-filters="{ asset_type_id: $route.params.id }"
      :filter-options="filterOptions"
      store-module-name="states"
      @edit="editAssetType"
      @show="showAssetType">
    </md-crud-table>

    <modal-state-form
        ref="modalStateForm"
        :asset-type-id="$route.params.id"
        @success="$refs.table.$emit('refresh')">
    </modal-state-form>
  </v-card>
</template>

<script>

  import { mapGetters } from 'vuex'
  import MdCrudTable from 'Components/MdCrudTable'
  import MdHeader from 'Components/MdHeader'
  import ModalStateForm from 'Components/Modals/StateForm'

  export default {

    name: 'SettingsAssetTypesStates',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', align: 'left' },
          { text: 'Description', value: 'description' },
          { text: 'Assets', value: 'assets_count', width: '50px' } 
        ],
        filterOptions: [
          'with_trashed'
        ],
        actions: {
          add: {
            title: 'Add new',
            clicked: () => { this.$refs.modalStateForm.$emit('open') }
          }
        },
        loading: false
      }
    },

    methods: {
      editAssetType(assetType) {
        this.$refs.modalStateForm.$emit('open', assetType.id)
      },
      showAssetType(assetType) {
        this.$router.push({ name: 'SettingsAssetTypesShow', params: { id: assetType.id }})
      }
    },

    components: {
      MdCrudTable,
      MdHeader,
      ModalStateForm
    }

  }
</script>
