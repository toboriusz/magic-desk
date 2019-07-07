<template>
  <v-container>
  	<md-header>
  		<h2>Assets</h2>
  		<span>{{ assetType.name }}</span>
  		<v-btn class="primary" :to="{ name: 'AssetsAdd' }">Add new</v-btn>
  	</md-header>
		<md-crud-table
      class="mt-3" 
      :headers="headers"
      :items="assets"
      :filter-options="filterOptions"
      :loading="loading"
      selectable
      @filters-changed="updateFilter"
      @delete="deleteAsset"
      @delete-permanently="deletePermAsset"
      @restore="restoreAsset"
      @edit="editAsset"
      @show="showAsset">
    </md-crud-table>

    <modal-asset-form
        ref="modalAssetForm"
        @success="fetchList">
    </modal-asset-form>
	</v-container>
</template>

<script>
	import { mapGetters } from 'vuex'
	import MdHeader from 'Components/MdHeader'
	import MdCrudTable from 'Components/MdCrudTable'
	import ModalAssetForm from 'Components/Modals/AssetForm'
  import store from 'Store'

  export default {

    name: 'ViewAssets',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', align: 'left', class: 'pl-0'},
          { text: 'Assets', value: 'assets_count'}
        ],
        filterOptions: [
          'with_trashed'
        ],
        loading: false
      }
    },


    computed: {
    	...mapGetters('assetTypes', {
    		assetType: 'assetType'
    	}),
    	...mapGetters('assets', {
    		assets: 'list'
    	})
    },

    watch: {
			'$route.params': {
				handler(newValue) {
					const { assetTypeId } = newValue

			    this.fetchAssetType(assetTypeId)
			    this.fetchList()
			    this.$store.dispatch('assets/updateFilter', [])

				},
				immediate: true,
			}
		},

    methods: {
    	fetchList() {
        this.loading = true
        this.$store.dispatch('assets/fetchList', this.$route.params.assetTypeId).finally((res) => {
          this.loading = false
        })
      },
      updateFilter(filter) {
        this.$store.dispatch('assets/updateFilter', filter)
        this.fetchList()
      },
      deleteAsset(assets) {
        this.$store.dispatch('assets/delete', assets.id)
      },
      deletePermAsset(assets) {
        this.$refs.modalAssetDeletePerm.$emit('open', assets.id)
      },
      editAsset(assets) {
        this.$refs.modalAssetForm.$emit('open', assets.id)
      },
      showAsset(assets) {
        this.$router.push({ name: 'AssetsShow', params: { id: assets.id }})
      },
      restoreAsset(assets) {
        this.$store.dispatch('assets/restore', assets.id)
      },
      fetchAssetType(assetTypeId) {
      	this.$store.dispatch('assetTypes/fetch', assetTypeId).catch( (e) => {
	    		if(404 === e.status.code)
	    			this.$router.push({ name: '404' })
	    	})
      }
    },

    beforeRouteEnter (to,from,next) {
      store.dispatch('pageLoader/on')
      store.dispatch('assets/fetchList', to.params.id).finally( () => {
        store.dispatch('pageLoader/off')
        next()
      })
    },

    beforeRouteUpdate (to,from,next) {
      store.dispatch('pageLoader/on')
      store.dispatch('assets/fetchList', to.params.id).finally( () => {
        store.dispatch('pageLoader/off')
        next()
      })
    },

    components: {
    	MdHeader,
    	MdCrudTable,
    	ModalAssetForm,
    }

  }
</script>