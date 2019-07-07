<template>
  <v-card :flat="flat">
    <v-toolbar card color="grey lighten-4">
      <v-menu v-if="selectable" offset-y origin="center center" :nudge-bottom="10" transition="scale-transition" :disabled="!selected.length">
        <v-btn icon slot="activator" class="mr-3 ml-1" :disabled="!selected.length">
          <v-icon>list</v-icon>
        </v-btn>
        <v-list class="pa-0">
          <menu-item icon="delete">Delete selected</menu-item>
        </v-list>
      </v-menu>
      <v-text-field flat solo append-icon="search" :placeholder="searchText" v-model="search" hide-details background-color="grey lighten-5"></v-text-field>
      <v-btn 
        v-for="(btn, index) in actions"
        :key="index"
        :color="btn.color"
        :icon="btn.icon"
        :light="btn.light"
        :dark="btn.dark || true"
        :flat="btn.flat"
        @click="btn.clicked()">
        {{ btn.title }}
      </v-btn>

      <v-btn v-if="filterOptions" icon class="ml-3 mr-0" @click="openFilterDialog">
        <v-badge :value="filterCount" right color="red" class="filter-badge">
          <v-icon>filter_list</v-icon>
          <template v-slot:badge>
            <span>{{ filterCount }}</span>
          </template>
        </v-badge>
      </v-btn>
      <v-dialog lazy v-model="filterDialog" max-width="400px">
        <v-card>
          <v-card-title primary-title class="headline grey lighten-3" color="grey">
            Filter options
          </v-card-title>
          <v-card-text>
            <v-list three-line>
              <v-list-tile avatar>
                <v-list-tile-action>
                  <v-checkbox color="primary" v-model="filterPresets.with_trashed" true-value="1" false-value="0"></v-checkbox>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>Show deleted</v-list-tile-title>
                  <v-list-tile-sub-title>Add to list elements not permanently deleted</v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="grey" flat @click="filterDialog = false">Cancel</v-btn>
            <v-btn color="green" flat @click="applyFilters">Apply</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text class="pa-0">
      <v-data-table
        :headers="headersWithActions"
        :search="search"
        :items="storeModuleName ? getItemsInternal : items" 
        :rows-per-page-items="itemsPerPageOptions"
        item-key="name"
        :select-all="selectable"
        v-model="selected"
        :loading="loading || loadingInternal">
        <template slot="items" slot-scope="props">
          <tr :active="props.selected" class="cursor-pointer" :class="{'red lighten-5 grey--text': props.item.deleted_at}">
            <td v-if="selectable" width="30">
              <v-checkbox
                color="primary"
                hide-details
                v-model="props.selected">
              </v-checkbox>
            </td>
            <td
              v-for="(col, index) in headers"
              :key="index"
              @click="show(props.item)"
              class="no-wrap"
              :width="col.width"
              :class="col.class">
                <v-icon v-if="col.type === 'icon'">{{ getValue(props.item, col.value) }}</v-icon>
                <span v-else v-html="getValue(props.item, col.value)"></span
            </td>
            <td class="text-xs-right no-wrap pr-2" v-if="props.item.deleted_at">
              <v-btn depressed icon small @click="deletePermanently(props.item)" class="mr-0">
                <v-icon color="red">delete_forever</v-icon>
              </v-btn>
              <v-btn depressed icon small @click="restore(props.item)">
                <v-icon color="teal">settings_backup_restore</v-icon>
              </v-btn>
            </td>
            <td class="text-xs-right no-wrap pr-2" v-else>
              <v-btn depressed icon small @click="edit(props.item)" class="mr-0">
                <v-icon color="indigo">edit</v-icon>
              </v-btn>
              <v-btn depressed icon small @click="deleteSoft(props.item)">
                <v-icon color="red">delete</v-icon>
              </v-btn>
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card-text>
    <modal-delete-permanently 
      v-if="storeModuleName"
      :store-module-name="storeModuleName"
      :title="deleteModalTitle"
      :text="deleteModalText"
      ref="modalDeletePermanently" 
      @success="fetchList">
    </modal-delete-permanently>  
  </v-card>
</template>

<script>
  import MenuItem from 'Components/Menu/MenuItem'
  import ModalDeletePermanently from 'Components/Modals/DeletePermanently'
  import { mapGetters } from 'vuex'

  export default {
    name: 'v-crud-table',

    props: {
      headers: {
        value: Array,
        default: () => [],
        required: true
      },
      actions: Object,
      selectable: Boolean,
      items: Array,
      filterOptions: Array,
      predefinedFilters: {
        type: Object,
        default: () => { return {} }
      },
      flat: Boolean,
      searchText: {
        value: String,
        default: 'Search item'
      },
      deleteModalTitle: String,
      deleteModalText: String,
      storeModuleName: String,
      itemsPerPageOptions: {
        value: Array,
        default: () => [ 10, 25, 50, { text:'All', 'value':-1 } ]
      },
      loading: Boolean
    },

    data () {
      return {
        search: '',
        filterDialog: false,
        filterPresets: {},
        filters: {},
        selected: [],
        loadingInternal: false
      }
    },

    computed: {
      filterCount () {
        let count = 0
        this.filterOptions.forEach((name) => {
          if(this.filters[name] === '1')
            count+= 1
        })
        return count
      },
      headersWithActions() {
        let headersWithActions = this.noReact(this.headers)
        headersWithActions.push({ text: 'Actions', value: 'actions', align: 'right', sortable: false })
        return headersWithActions
      },
      getItemsInternal(){
        if(this.storeModuleName)
          return this.$store.getters[this.storeModuleName + '/list']
        return null
      }
    },

    methods: {
      openFilterDialog() {
        this.filterPresets = this.noReact(this.filters)
        this.filterDialog = true
      },
      applyFilters () {
        this.filters = this.noReact(this.filterPresets)
        this.filterDialog = false
        this.$emit('filters-changed', this.filters)
        if(this.storeModuleName){
          this.$store.dispatch(this.storeModuleName + '/updateFilter', Object.assign(this.predefinedFilters, this.filters))
          this.fetchList()
        }
      },
      fetchList() {
        this.loadingInternal = true
        this.$store.dispatch(this.storeModuleName + '/fetchList').finally((res) => {
          this.loadingInternal = false
        })
      },
      show(item){
        this.$emit('show', item)
      },
      edit(item){
        this.$emit('edit', item)
      },
      deleteSoft(item){
        this.$emit('delete', item)
        if(this.storeModuleName){
          this.$store.dispatch(this.storeModuleName + '/delete', item.id)
          this.fetchList()
        }
      },
      deletePermanently(item){
        this.$emit('delete-permanently', item)
        if(this.storeModuleName){
          this.$refs.modalDeletePermanently.$emit('open', item.id)
          this.fetchList()
        }
      },
      restore(item){
        this.$emit('restore', item)
        if(this.storeModuleName){
          this.$store.dispatch(this.storeModuleName + '/restore', item.id)
          this.fetchList()
        }
      },
      getValue(obj, route) {
        var val = obj
        route.split('.').map((key) => {
          val = val[key]
        })

        return val
      }
    },

    mounted () {
      if(this.storeModuleName) {
        this.$store.dispatch(this.storeModuleName + '/updateFilter', this.predefinedFilters)
        this.$on('refresh', this.fetchList)
        this.fetchList()
      }
    },

    beforeDestroy () {
      if(this.storeModuleName)
        this.$off('refresh')
    },

    components: {
      MenuItem,
      ModalDeletePermanently
    }
  }
</script>
