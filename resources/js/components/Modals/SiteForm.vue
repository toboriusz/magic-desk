<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title class="headline">Add new service</v-card-title>
      <v-icon class="c-m-site-add__bg" size="400" color="grey lighten-4">home</v-icon>
      <v-card-text>
        <v-form @submit.prevent="validate">
          <v-text-field
            name="name"
            label="Site name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-text-field
            name="phone"
            label="Phone"
            type="text"
            v-model="form.phone"
            data-vv-name="Phone"
            @change="error = ''"
            :error-messages="$validator.errors.collect('phone')">
          </v-text-field>
          <v-text-field
            name="address1"
            label="Address"
            type="text"
            v-model="form.address1"
            data-vv-name="Address"
            @change="error = ''"
            :error-messages="$validator.errors.collect('address1')">
          </v-text-field>
          <v-text-field
            name="address2"
            label="Address (line 2)"
            type="text"
            v-model="form.address2"
            data-vv-name="Address"
            @change="error = ''"
            :error-messages="$validator.errors.collect('address2')">
          </v-text-field>
          <v-text-field
            name="city"
            label="City"
            type="text"
            v-model="form.city"
            data-vv-name="City"
            @change="error = ''"
            :error-messages="$validator.errors.collect('city')">
          </v-text-field>
          <v-text-field
            name="country"
            label="Country"
            type="text"
            v-model="form.country"
            data-vv-name="Country"
            @change="error = ''"
            :error-messages="$validator.errors.collect('country')">
          </v-text-field>
          <v-text-field
            name="postcode"
            label="Postcode"
            type="text"
            v-model="form.postcode"
            data-vv-name="Postcode"
            @change="error = ''"
            :error-messages="$validator.errors.collect('postcode')">
          </v-text-field>
          <v-select
              name="parent"
              label="Service"
              v-model="form.parent"
              item-text="name"
              item-value="id"
              clearable
              :items="sitesList"
              @change="error = ''"
              :error-messages="$validator.errors.collect('parent')">
          </v-select>
          <v-textarea
            name="description"
            label="Description"
            v-model="form.description"
            data-vv-name="Description"
            @change="error = ''"
            :error-messages="$validator.errors.collect('description')">
          </v-textarea>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="grey"
          flat
          @click="dialog = false">
          Cancel
        </v-btn>
        <v-btn
          color="green"
          flat
          :loading="loading"
          @click="validate">
          Create
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters } from 'vuex';
  export default {

    name: 'modal-site-form',

    data () {
      return {
        loading: false,
        dialog: false,
        form: {
          name: '',
          phone: '',
          address1: '',
          address2: '',
          country: '',
          postcode: '',
          parent: null,
          description: ''
        }
      }
    },

    computed: {
        ...mapGetters('sites', {
            sitesList: 'list'
        })
    },

    methods: {
    validate () {
        this.$validator.validateAll().then(( isValid ) => {
          if(isValid) {
            this.submit()
          }
        })
      },
      submit() {
        this.loading = true
        this.$store.dispatch('sites/add', this.form).then( (res) => {
          this.$emit('success')
          this.dialog = false
        }).catch( (e) => {
          //show alert error
          this.showValidationErrors(e)
        }).finally( () => {
          this.loading = false
        })
      }
    },
    mounted () {
      this.$on('open', () => {
        this.dialog = true
      })
    },

    beforeDestroy () {
      this.$off('open')
    }

  }
</script>

<style lang="sass">
    .c-m-site-add
        &__bg
            position: absolute
            top: 100px
            left: 50%
            transform: translateX(-50%)
            z-index: 0
</style>
