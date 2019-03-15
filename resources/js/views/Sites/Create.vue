<template>
  <v-container class="c-list">
    <v-header>
      <h2 class="primary--text">Sites</h2>
      <span>{{ form.name || 'Site name' }}</span>
    </v-header>
    <v-flex lg12>
      <v-widget title="Create new Site">
        <div slot="widget-content">
          <v-form @submit.prevent="validate">
            <h5>General</h5>
            <v-text-field
              name="name"
              label="Site name*"
              type="text"
              v-model="form.name"
              autofocus
              data-vv-name="name"
              v-validate="'required'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('email')">
            </v-text-field>
            <v-text-field
              name="shortcode"
              label="Site shortcode*"
              type="text"
              v-model="form.shortcode"
              autofocus
              data-vv-name="shortcode"
              v-validate="'required|max:5'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('shortcode')">
            </v-text-field>
            <v-text-field
              name="name"
              label="Site name"
              type="text"
              v-model="form.name"
              autofocus
              data-vv-name="name"
              v-validate="'required|name'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('email')">
            </v-text-field>
            <h5>Details</h5>
            <location-picker :place.sync="form.place"></location-picker>
          </v-form>
        </div>
      </v-widget>
    </v-flex>
  </v-container>
</template>

<script>
  import VWidget from 'Components/VWidget'
  import VHeader from 'Components/VHeader'
  import LocationPickerInit from 'vue-location-picker/src/init'
  import LocationPicker from 'vue-location-picker'
  export default {

    name: 'ViewSitesCreate',

    data () {
      return {
        form: {
          name: '',
          place: null
          
        }
      }
    },

    created () {
      LocationPickerInit(
        this,

        // config object
        {
          key: 'AIzaSyDuz5EpZvOB2ijvtRNTJoAx5wck14uFv3g', // required
          language: 'en-US'        // optional
        },

        // options object
        {
          map: {
            center: { lat: 0, lng: 0 },
            /** other map options **/
          },
          marker: { /** marker options **/ },
          infoWindow: { /** info window options **/ },
          autocomplete: { /** autocomplete options **/ }
        }
      )
    },

    components: {
      VHeader,
      VWidget,
      LocationPicker 
    }

  }
</script>