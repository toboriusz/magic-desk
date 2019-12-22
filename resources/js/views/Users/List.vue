<template>
  <v-container class="c-list">
    <md-header >
      <h2><router-link :to="{ name: 'Users' }">Users</router-link></h2>
      <v-btn class="primary" @click="$refs.modalUserForm.$emit('open')">Add new</v-btn>
    </md-header>
    <v-flex lg12>
      <md-crud-table
        ref="table"
        :headers="headers"
        :filter-options="filterOptions"
        selectable
        store-module-name="users"
        @edit="editUser"
        @show="showUser">
      </md-crud-table>
    </v-flex>
    <modal-user-form
      ref="modalUserForm"
      @success="$refs.table.$emit('refresh')">
    </modal-user-form>
	</v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import MdCrudTable from 'Components/MdCrudTable'
  import ModalUserForm from 'Components/Modals/UserForm'
  import {mapGetters} from 'vuex'

  export default {

    name: 'ViewUsersList',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', class: 'pl-0'},
          { text: 'Job Title', value: 'job_title'},
          { text: 'Service', value: 'site.name'},
          { text: 'Assets', value: 'assets_count'}
        ],
        filterOptions: [
          'with_trashed'
        ]
      }
    },

    methods: {
      editUser(user) {
        this.$refs.modalUserForm.$emit('open', user.id)
      },
      showUser(user) {
        this.$router.push({ name: 'UserShow', params: { id: user.id }})
      }
    },

    components: {
      MdHeader,
      MdCrudTable,
      ModalUserForm
    }

  }
</script>
