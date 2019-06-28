<template>
  <v-dialog
    v-model="dialog"
    max-width="550">
    <v-card>
      <v-card-title class="headline">Add new asset type</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="name"
            label="Name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="Name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-autocomplete
            name="icon"
            label="Icon"
            v-model="form.icon"
            :items="iconList"
            cache-items
            data-vv-name="icon"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('icon')">
            <template v-slot:selection="data">
              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
            </template>
            <template v-slot:item="data">
              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
            </template>
          </v-autocomplete>
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
  import { mapGetters } from 'vuex'

  export default {

    name: 'modal-asset-type-form',

    data () {
      return {
        loading: false,
        dialog: false,
        form: {
          name: '',
          icon: '',
          description: ''
        }
      }
    },

    computed: {
        ...mapGetters('icons', {
            iconList: 'list'
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
        this.$store.dispatch('assetTypes/add', this.form).then( (res) => {
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
        this.$refs.form.reset()
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
