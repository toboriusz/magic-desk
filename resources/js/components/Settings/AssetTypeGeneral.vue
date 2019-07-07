<template>
  <v-card flat class="pa-5">
    <v-layout row wrap>
      <v-icon class="asset-type__icon mr-5" color="grey lighten-2">{{ icon || 'help' }}</v-icon>
      <v-flex>
        <v-layout align-center justify-space-between>
          <h4 class="font-weight-regular">General informations</h4>
          <span v-if="editMode">
            <v-btn icon @click="cancelEditMode">
              <v-icon>close</v-icon>
            </v-btn>
            <v-btn icon :loading="loadingGeneral" @click="updateAssetType">
              <v-icon>save</v-icon>
            </v-btn>
          </span> 
          <v-btn v-else icon @click="turnOnEditMode">
            <v-icon>edit</v-icon>
          </v-btn>  
        </v-layout>
        <v-form data-vv-scope="asset-type-general">
          <v-text-field
            name="name"
            label="Name"
            type="text"
            v-model="name"
            ref="firstField"
            :disabled="!editMode"
            data-vv-name="name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-autocomplete
            name="icon"
            label="Icon"
            v-model="icon"
            :items="iconList"
            cache-items
            auto-select-first
            data-vv-name="icon"
            :disabled="!editMode"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('icon')">
            <template v-slot:item="data">
              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
            </template>
          </v-autocomplete>
          <v-textarea
            max-height="10"
            name="description"
            label="Description"
            v-model="description"
            data-vv-name="description"
            rows="1"
            auto-grow
            :disabled="!editMode"
            @change="error = ''"
            :error-messages="$validator.errors.collect('description')">
          </v-textarea>
        </v-form>
      </v-flex>
    </v-layout>
    <v-layout align-center justify-space-between pt-5>
      <h4 class="font-weight-regular">Custom fields</h4>
      <span>
        <v-btn flat>
          Add group
          <v-icon right>featured_play_list</v-icon>
        </v-btn>
        <v-btn class="mr-0" flat>
          Add field
          <v-icon right>add_box</v-icon>
        </v-btn>
      </span>
    </v-layout>
    <p v-if="!this.assetType.custom_fields" class="grey--text lighten-5 headline py-5 text-xs-center">No custom fields</p>
    <md-custom-fields v-model="assetType.custom_fields">
    </md-custom-fields>
  </v-card>
</template>

<script>

  import { mapGetters } from 'vuex'
  import MdCrudTable from 'Components/MdCrudTable'
  import MdHeader from 'Components/MdHeader'
  import ModalAssetTypeForm from 'Components/Modals/AssetTypeForm'
  import MdCustomFields from 'Components/MdCustomFields'

  export default {

    name: 'SettingsAssetTypes',

    data() {
      return {
        name: '',
        icon: '',
        description: '',
        loading: false,
        editMode: false,
        loadingGeneral: false
      }
    },

    computed: {
      ...mapGetters('assetTypes', {
        assetType: 'assetType'
      }),
      ...mapGetters('icons', {
          iconList: 'list'
      })
    },

    methods: {
      updateAssetType () {
        this.loadingGeneral = true
        this.$validator.validateAll('asset-type-general').then(( isValid ) => {
          if(isValid) {
            this.$store.dispatch('assetTypes/update', {
              id: this.assetType.id,
              data: {
                name: this.name,
                icon: this.icon,
                description: this.description
              }
            }).finally(() => {
              this.loadingGeneral = false
              this.editMode = false
            })
          } else {
            this.loadingGeneral = false
          }
        })
      },
      cancelEditMode() {
        this.name = this.noReact(this.assetType.name)
        this.icon = this.noReact(this.assetType.icon)
        this.description = this.noReact(this.assetType.description)
        this.editMode = false
      },
      turnOnEditMode() {
        this.editMode = true
        this.$nextTick(() => {
          this.$refs.firstField.focus()
        })
      }
    },

    mounted () {
      this.name = this.noReact(this.assetType.name)
      this.icon = this.noReact(this.assetType.icon)
      this.description = this.noReact(this.assetType.description)
    },

    components: {
      MdCrudTable,
      MdHeader,
      ModalAssetTypeForm,
      MdCustomFields
    }

  }
</script>

<style lang="sass">
  .asset-type
    &__icon 
      font-size: 250px
</style> 
