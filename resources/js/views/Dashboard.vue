<template>
	<v-container grid-list-xl fluid>
    <md-header><h2>Dashboard</h2></md-header>
    <v-layout row wrap>
      <v-flex lg4 sm12 xs12>
        <md-widget title="Assets" content-bg="white">
          <div slot="widget-content">
              <e-chart 
              :path-option="[
                ['dataset.source', locationData],
                ['legend.bottom', '0'],
                ['color', [color.lightBlue.base, color.indigo.base, color.pink.base, color.green.base, color.cyan.base, color.teal.base]],
                ['xAxis.show', false],
                ['yAxis.show', false],
                ['series[0].type', 'pie'],
                ['series[0].avoidLabelOverlap', true],         
                ['series[0].radius', ['50%', '70%']],                      
              ]"
              height="400px"
              width="100%"
              >
              </e-chart>
          </div>
        </md-widget>  
      </v-flex>
    </v-layout>
	</v-container>
</template>

<script>
  import MdHeader from 'Components/MdHeader'
  import MdWidget from 'Components/MdWidget'
  import EChart from '@/components/Chart/EChart'
  import Material from 'vuetify/es5/util/colors'
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
      EChart
    }

  }
</script>