<template>
  <v-container class="c-list">
    <md-header >
      <h2><router-link :to="{ name: 'Employees' }">Employees</router-link></h2>
      <v-btn class="primary" @click="$refs.modalEmployeeForm.$emit('open')">Add new</v-btn>
    </md-header>
    <v-flex lg12>
      <md-crud-table
        ref="table"
        :headers="headers"
        :items="employees"
        :filter-options="filterOptions"
        selectable
        store-module-name="employees"
        @edit="editEmployee"
        @show="showEmployee">
      </md-crud-table>
    </v-flex>
    <modal-employee-form
      ref="modalEmployeeForm"
      @success="$refs.table.$emit('refresh')">
    </modal-employee-form>
	</v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import MdCrudTable from 'Components/MdCrudTable'
  import ModalEmployeeForm from 'Components/Modals/EmployeeForm'
  import {mapGetters} from 'vuex'

  export default {

    name: 'ViewEmployeesList',

    data() {
      return {
        headers: [
          { text: 'Name', value: 'name', class: 'pl-0'},
          { text: 'Job Title', value: 'job_title'},
          { text: 'Service', value: 'site'},
          { text: 'Assets', value: 'assets_count'}
        ],
        filterOptions: [
          'with_trashed'
        ]
      }
    },

    computed: {
      ...mapGetters('employees', {
        employees: 'list'
      })
    },

    methods: {
      editEmployee(employee) {
        this.$refs.modalEmployeeForm.$emit('open', employee.id)
      },
      showEmployee(employee) {
        this.$router.push({ name: 'EmployeeShow', params: { id: employee.id }})
      }
    },

    components: {
      MdHeader,
      MdCrudTable,
      ModalEmployeeForm
    }

  }
</script>
