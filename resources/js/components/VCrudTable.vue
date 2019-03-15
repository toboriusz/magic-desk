<template>
  <v-card>
    <v-toolbar card color="grey lighten-4">
      <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition" :disabled="!selected.length">
        <v-btn icon slot="activator" class="mr-3 ml-1" :disabled="!selected.length">
          <v-icon>list</v-icon>
        </v-btn>
        <v-list class="pa-0">
          <menu-item icon="delete">Delete selected</menu-item>
        </v-list>
      </v-menu>
      <v-text-field flat solo append-icon="search" :placeholder="searchText" v-model="search" hide-details background-color="grey lighten-5">
      </v-text-field>
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
        :items="items"
        :rows-per-page-items="itemsPerPageOptions"
        item-key="name"
        select-all
        v-model="selected"
        :loading="loading">
        <template slot="items" slot-scope="props">
          <tr :active="props.selected" class="cursor-pointer" :class="{'red lighten-5 grey--text': props.item.deleted_at}">
            <td width="30">
              <v-checkbox
                color="primary"
                hide-details
                v-model="props.selected">
              </v-checkbox>
            </td>              
            <td 
              v-for="(col, index) in headers" 
              :key="index" 
              @click="show" 
              class="no-wrap"
              :class="col.class">
              {{ props.item[col.value] }}
            </td>
            <td class="text-xs-right no-wrap pr-2" v-if="props.item.deleted_at">
              <v-btn depressed icon small @click="restore(props.item)" class="mr-0">
                <v-icon color="teal">settings_backup_restore</v-icon>
              </v-btn>
              <v-btn depressed icon small @click="deletePermanent(props.item)">
                <v-icon color="red">delete_forever</v-icon>
              </v-btn>
            </td>
            <td class="text-xs-right no-wrap pr-2" v-else>
              <v-btn depressed icon small @click="edit(props.item)" class="mr-0">
                <v-icon color="indigo">edit</v-icon>
              </v-btn>
              <v-btn depressed icon small @click="delete(props.item)">
                <v-icon color="red">delete</v-icon>
              </v-btn>
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
  import MenuItem from 'Components/Menu/MenuItem'

  export default {
    name: 'v-crud-table',

    props: {
      headers: {
        value: Array,
        default: () => [],
        required: true
      },
      items: Array,
      filterOptions: Array,
      searchText: {
        value: String,
        default: 'Search item'
      },
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
        selected: []
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
      },
      show(item){
        this.$emit('show', item)
      },
      edit(item){
        this.$emit('edit', item)
      },
      delete(item){
        this.$emit('delete', item)
      },
      deletePermanently(item){
        this.$emit('delete-permanently', item)
      },
      restore(item){
        this.$emit('restore', item)
      }

    },

    components: {
      MenuItem
    }
  }
</script>
