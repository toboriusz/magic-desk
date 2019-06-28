<template>
  <v-form @submit.prevent="validate" class="p-rpass">
  	<div class="text-xs-center">
	  	<h3>Reset password</h3>
  	</div>
    <div class="p-rpass__container">
      <div class="p-srpass__loader" :class="{ 'shown' : success }">
        <md-response-loader class="mt-2" v-model="loaderState"></md-response-loader>
        <p class="text-xs-center mt-3 green--text font-weight-bold">{{ message }}&nbsp;</p> 
        <v-btn :to="loginHref" color="primary" >Go to login page</v-btn>
      </div>
      <div class="p-rpass__form" :class="{ 'hidden' : success }">
        <v-text-field
          ref="password"
          label="Password"
          data-vv-as="Password"
          type="password"
          name="password"
          v-model="form.password"
          v-validate="'required|min:6'"
          :error-messages="$validator.errors.collect('password')">
        </v-text-field>

        <v-text-field
          label="Confirm password"
          data-vv-as="Password"
          type="password"
          name="password_confirmation"
          v-model="form.password_confirmation"
          v-validate="'confirmed:password'"
          :error-messages="$validator.errors.collect('password_confirmation')">
        </v-text-field>
        <p class="text-xs-center mt-1 mb-3 red--text font-weight-bold">{{ error }}</p>
        <div class="layout-row">
          <v-btn type="submit" class="ma-0" block color="primary" :loading="loading">Update password</v-btn>
        </div>
      </div>
    </div>
  	
  </v-form>
</template>

<script>
  import MdResponseLoader from 'Components/MdResponseLoader'

  export default {

    name: 'ViewResetPassword',

    data () {
      return {
        loaderState: 'idle',
        userEmail: null,
        loading: false,
        error: '',
        message: '',
        success: false,
        form: {
          password: '',
          password_confirmation: ''
        }
      }
    },

    computed: {
      loginHref () {
        return { 
          name: 'Login', 
          query: { 
            email: this.userEmail
          }
        }
      }
    },

    methods: {
      validate () {
        this.$validator.validateAll().then(( isValid ) => {
          //Bug fix
          if(this.form.password_confirmation === '') {
            this.$validator.errors.add({
              field: 'password_confirmation',
              msg: 'The password confirmation is required'
            })
            return false
          }

          if(isValid) {
            this.resetPassword()
          }
        })
      },
      resetPassword () {
        this.message = ''
        this.error = ''
        this.loading = true
        this.$store.dispatch('auth/resetPassword', {
          password: this.form.password,
          password_confirmation: this.form.password_confirmation,
          token: this.$route.params.token
        }).then( (res) => {
          this.message = res.data.message
          this.loading = false
          this.success = true
          this.userEmail = res.data.data.email

          setTimeout( () => {
            this.loaderState = 'success'
          }, 300)
          
        }).catch( (e) => {
          this.error = e.response.data.message
          this.loading = false
        })
      }
    },

    components: {
      MdResponseLoader
    }

  }
</script>

<style lang="sass">
  .p-rpass
    &__container
      position: relative
      width: 100%
      
    &__loader
      text-align: center
      position: absolute
      top: 0
      left: 0
      width: 100%
      opacity: 0
    
    &__form,
    &__loader
      transition: opacity .3s ease-in-out

    .shown
      opacity: 1

    .hidden
      opacity: 0
      pointer-events: none


</style>