<template>
   <v-form class="p-srpass" @submit.prevent="sendResetEmail">
    <h3 class="text-xs-center">Forgot your password</h3>
    
    <div class="p-srpass__container">
      <div class="p-srpass__loader" :class="{ 'shown' : success }">
        <response-loader class="mt-5" v-model="loaderState"></response-loader>
        <p class="text-xs-center mt-3 green--text font-weight-bold">{{ message }}&nbsp;</p>
      </div>
    
      <div  class="p-srpass__form" :class="{ 'hidden' : success }">
        <p class="text-xs-center mb-5">To reset your password, enter your email address.</p>
        <v-text-field append-icon="email" name="email" label="Email" type="email" v-model="email" autofocus :disabled="loading" placeholder=" "></v-text-field>
        <div class="layout-row">
          <v-btn type="submit" block color="primary" :loading="loading">Continue</v-btn>
        </div>
        <p class="text-xs-center ma-0 mt-3 red--text font-weight-bold">{{ error }}&nbsp;</p>
      </div>  
    </div>
    
    
  </v-form>
</template>

<script>
  import ResponseLoader from 'Components/ResponseLoader'

  export default {

    name: 'ViewSendResetEmail',

    data () {
      return {
        loading: false,
        email: this.$route.query.email || '',
        message: '',
        error: '',
        success: false,
        loaderState: 'idle'
      }
    },

    methods: {
      sendResetEmail () {
        this.message = ''
        this.error = ''
        this.loading = true
        this.$store.dispatch('auth/sendResetEmail', {
          email: this.email
        }).then( (res) => {
          this.message = res.data.message
          this.lodaing = false
          this.success = true
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
  .p-srpass
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