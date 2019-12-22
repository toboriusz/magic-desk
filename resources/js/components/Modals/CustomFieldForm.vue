<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit custom field</v-card-title>
      <v-card-title v-else class="headline">Add new custom field</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="name"
            label="Field name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="name"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('name')"
            @input="generateShortcode">
          </v-text-field>
          <v-text-field
            name="shortcode"
            label="Field shortcode"
            type="text"
            v-model="form.shortcode"
            autofocus
            data-vv-name="shortcode"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('shortcode')">
          </v-text-field>
          <v-select
            name="type"
            label="Field type"
            v-model="form.type"
            :items="fieldTypes"
            data-vv-name="type"
            @change="error = ''"
            :error-messages="$validator.errors.collect('type')">
            <template v-slot:selection="data">
              <v-icon class="pr-3">{{ data.item.icon }}</v-icon> {{ data.item.name }}
            </template>
            <template v-slot:item="data">
              <v-icon class="pr-3">{{ data.item.icon }}</v-icon> {{ data.item.name }}
            </template>
          </v-select>
          <v-text-field
            name="default_value"
            label="Default value"
            type="text"
            v-model="form.default_value"
            autofocus
            data-vv-name="default_value"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('default_value')">
          </v-text-field>
        </v-form>
        <md-loading :loading="loadingData"></md-loading>
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
          :disabled="loadingData"
          @click="validate">
          {{ editMode ? 'Update' : 'Add' }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  const slugify = require('@sindresorhus/slugify');

  import { mapGetters } from 'vuex'
  import MdLoading from 'Components/MdLoading'

  export default {

    name: 'modal-custom-field-form',

    props: {
      assetTypeId: null
    },

    data () {
      return {
        customFieldId: null,
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        form: {
          name: '',
          shortcode: '',
          type: null,
          default_value: '',
          options: null
        },
        fieldTypes: [
          {
            icon: 'exposure_plus_1',
            name: 'numeric'
          },
          {
            icon: 'text_format',
            name: 'text'
          },
          {
            icon: 'insert_link',
            name: 'URL'
          },
          {
            icon: 'email',
            name: 'email'
          },
          {
            icon: 'check_box',
            name: 'boolean'
          }
        ]
      }
    },

    methods: {
      validate() {
        this.$validator.validateAll().then(( isValid ) => {
          if(isValid) {
            if(this.editMode) {
              this.submitUpdate()
            } else {
              this.submitNew()
            }
          }
        })
      },
      submitNew() {
        this.loading = true
        this.form.asset_type_id = this.assetTypeId
        this.$store.dispatch('customFields/add', this.form).then( (res) => {
          this.$emit('success', res.data.data)
          this.dialog = false
        }).catch( (e) => {
          //show alert error
          this.showValidationErrors(e)
        }).finally( () => {
          this.loading = false
        })
      },
      submitUpdate() {
        this.loading = true
        this.$store.dispatch('customFields/update', {
          id: this.customFieldId,
          data: this.form
        }).then( (res) => {
          this.$emit('success')
          this.dialog = false
        }).catch( (e) => {
          //show alert error
          this.showValidationErrors(e)
        }).finally( () => {
          this.loading = false
        })
      },
      generateShortcode () {
        this.form.shortcode = slugify(this.form.name, {
          separator: '_'
        })
      }
    },

    mounted () {
      this.$on('open', (id) => {
        this.customFieldId = id || null
        
        if(this.customFieldId) {
          this.editMode = true
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('customFields/fetch', this.customFieldId).then( (res) => {
            this.form.name = res.data.data.name
          }).finally(() => {
              this.loadingData = false
          })
        } else {
          this.editMode = false
          this.$refs.form.reset()
          this.$nextTick(() => {
            this.$validator.reset();
            this.dialog = true
          })
        }
      })
    },

    beforeDestroy () {
      this.$off('open')
    },

    components: {
      MdLoading
    }

  }
</script>
