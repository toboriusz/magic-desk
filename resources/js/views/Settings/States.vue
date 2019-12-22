<template>
	<v-container>
	  <md-header>
		  <h2>Settings</h2>
		  <span>Asset states</span>
		  <v-btn class="primary" @click="$refs.modalStateForm.$emit('open') ">Add new</v-btn>
		</md-header>
		<v-card flat>
			<md-crud-table
				ref="table"
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
	</v-container>
</template>

<script>
	import MdHeader from 'Components/MdHeader'
	import { mapGetters } from 'vuex'
  import MdCrudTable from 'Components/MdCrudTable'
  import ModalStateForm from 'Components/Modals/StateForm'

  export default {

    name: 'SettingsAssetStates',

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
