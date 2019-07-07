<template>
	<v-container grid-list-xl fluid>
    <md-header><h2>Dashboard</h2></md-header>
    <v-layout row wrap>
      <v-flex lg4 sm12 xs12>
      </v-flex>
      <md-input-group>
        test
      </md-input-group>  
    </v-layout>
	</v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import MdWidget from 'Components/MdWidget'
  import Material from 'vuetify/es5/util/colors'
  import MdInputGroup from 'Components/MdInputGroup'
  export default {

    name: 'view-dashboard',

    data () {
      return {
        color: Material,
        locationData: [
          {
            value: 21,
            name: 'Desktops'
          },
          {
            value: 53,
            name: 'Laptops'
          },
          {
            value: 6,
            name: 'Phones'
          },
          {
            value: 12,
            name: 'Printers'
          },
          {
            value: 4,
            name: 'Other'
          }
        ]
      }
    },

    components: {
      MdHeader,
      MdWidget,
      MdInputGroup
    }

  }
</script>