<template>
  <v-form @submit.prevent="resetPassword" class="p-rpass">
  	<div class="text-xs-center">
	  	<h3>Reset password</h3>
  	</div>
    <div class="p-rpass__container">
      <div class="p-srpass__loader" :class="{ 'shown' : success }">
        <response-loader class="mt-4" v-model="loaderState"></response-loader>
        <p class="text-xs-center mt-3 green--text font-weight-bold">{{ message }}&nbsp;</p> 
        <v-btn :to="loginHref" color="primary" >Go to login page</v-btn>
      </div>
      <div class="p-rpass__form" :class="{ 'hidden' : success }">
        <v-text-field name="password" label="New password" type="password" v-model="password"></v-text-field>
        <v-text-field name="password_confirmation" label="Confirm new password" type="password" v-model="password_confirmation"></v-text-field>
        <div class="layout-row">
          <v-btn type="submit" block color="primary" :loading="loading">Update password</v-btn>
        </div>
        <p class="text-xs-center ma-0 mt-3 red--text font-weight-bold">{{ error }}&nbsp;</p>
      </div>
    </div>
  	
  </v-form>
</template>

<script>
  import ResponseLoader from 'Components/ResponseLoader'

  export default {

    name: 'ViewResetPassword',

    data () {
      return {
        loaderState: 'idle',
        userEmail: null,
        loading: false,
        password: '',
        password_confirmation: '',
        error: '',
        message: '',
        success: false
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
      resetPassword () {
        this.message = ''
        this.error = ''
        this.loading = true
        this.$store.dispatch('auth/resetPassword', {
          password: this.password,
          password_confirmation: this.password_confirmation,
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
      ResponseLoader
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