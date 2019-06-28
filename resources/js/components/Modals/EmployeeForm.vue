<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title class="headline">Add new employee</v-card-title>
      <v-icon class="c-m-emp-add__bg" size="400" color="grey lighten-4">account_circle</v-icon>
      <v-card-text>
        <v-form @submit.prevent="validate" ref="form">
        <v-text-field
            name="first_name"
            label="First name"
            type="text"
            v-model="form.first_name"
            autofocus
            data-vv-name="First name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('first_name')">
        </v-text-field>
        <v-text-field
            name="last_name"
            label="Last name"
            type="text"
            v-model="form.last_name"
            data-vv-name="Last name"
            @change="error = ''"
            :error-messages="$validator.errors.collect('last_name')">
        </v-text-field>
        <v-text-field
            name="job_title"
            label="Job title"
            type="text"
            v-model="form.job_title"
            data-vv-name="Job title"
            @change="error = ''"
            :error-messages="$validator.errors.collect('job_title')">
        </v-text-field>
        <v-select
            name="site_id"
            label="Service"
            v-model="form.site_id"
            clearable
            item-text="name"
            item-value="id"
            :items="sitesList"
            @change="error = ''"
            :error-messages="$validator.errors.collect('site_id')">
        </v-select>
        <h4>Contact details</h4>
        <v-text-field
            name="email"
            label="Email"
            type="email"
            v-model="form.email"
            data-vv-name="Email"
            @change="error = ''"
            :error-messages="$validator.errors.collect('email')">
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
            name="mobile"
            label="Mobile phone"
            type="text"
            v-model="form.mobile"
            data-vv-name="mobile"
            @change="error = ''"
            :error-messages="$validator.errors.collect('mobile')">
        </v-text-field>
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

    name: 'modal-employee-form',

    data () {
      return {
        dialog: false,
        loading: false,
        form: {
            first_name: '',
            last_name: '',
            job_title: '',
            site_id: null,
            email: '',
            phone: '',
            mobile: '',
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
        this.$store.dispatch('employees/add', this.form).then( (res) => {
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
        this.$store.dispatch('sites/fetchList')
      })
    },

    beforeDestroy () {
      this.$off('open')
    }

  }
</script>

<style lang="sass">
    .c-m-emp-add
        &__bg
            position: absolute
            top: 100px
            left: 50%
            transform: translateX(-50%)
            z-index: 0
</style>
