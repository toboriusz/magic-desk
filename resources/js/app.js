'use strict'

//IE11 polyfills
import "babel-polyfill"
import 'whatwg-fetch'

import Vue from 'vue'
import router from 'Router'
import store from 'Store'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import App from './App.vue'
import Api from 'Api/Api'
import Auth from 'Api/Auth'

Api.init()
Auth.init(router)

Vue.use(Vuetify)
Vue.use(VeeValidate, {inject: true })

Vue.config.productionTip = false

Vue.mixin({
  methods: {
  	showValidationErrors(e, scope = null) {
    	if(e.response.status === 422 && e.response.data.data) {
		    const errors = e.response.data.data.validation_errors || []
		    for(let key in errors) {
		      this.$validator.errors.add({
		        field: key, 
		        msg: errors[key].join(' '),
		        scope: scope 
		      })
		    }
		  }
  	} 
  }
})

const app = new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

export default app