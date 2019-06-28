<template>
  <v-card flat>
    <md-crud-table
      ref="table"
      :actions="actions"
      class="mt-3"
      selectable
      :headers="headers"
      :predefined-filters="{ asset_type_id: $route.params.id }"
      :filter-options="filterOptions"
      store-module-name="products"
      @edit="editAssetType"
      @show="showAssetType">
    </md-crud-table>

    <modal-product-form
        ref="modalProductForm"
        :asset-type-id="$route.params.id"
        @success="$refs.table.$emit('refresh')">
    </modal-product-form>
  </v-card>
</template>

<script>

  import { mapGetters } from 'vuex'
  import MdCrudTable from 'Components/MdCrudTable'
  import MdHeader from 'Components/MdHeader'
  import ModalProductForm from 'Components/Modals/ProductForm'

  export default {

    name: 'SettingsAssetTypesProducts',

    data() {
      return {
        headers: [
          { text: 'Brand', value: 'brand', align: 'left', class: 'pl-0' },
          { text: 'Model', value: 'model' },
          { text: 'Part number', value: 'part_no' },
          { text: 'Description', value: 'description' },
          { text: 'Assets', value: 'assets_count', width: '50px' } 
        ],
        filterOptions: [
          'with_trashed'
        ],
        actions: {
        	add: {
        		title: 'Add new',
        		clicked: () => { this.$refs.modalProductForm.$emit('open') }
        	}
        },
        loading: false
      }
    },

    methods: {
      editAssetType(assetType) {
        this.$refs.modalProductForm.$emit('open', assetType.id)
      },
      showAssetType(assetType) {
        this.$router.push({ name: 'SettingsAssetTypesShow', params: { id: assetType.id }})
      }
    },

    components: {
      MdCrudTable,
      MdHeader,
      ModalProductForm
    }

  }
</script>
