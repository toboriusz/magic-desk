import Vue from 'vue'
import Auth from '@websanova/vue-auth'

const AuthService = {
  init (router) {

    Vue.router = router

    Vue.use(Auth, {
      auth: {
        request: function(req, token) { 
          token = token.split(';')[0]
          this.options.http._setHeaders.call(this, req, {Authorization: 'Bearer ' + token})
        },
        response: function(res) { 
          let data = res.data.data || null
          if (data && data.token && data.token_expires_at) {
            return data.token + ';' + data.token_expires_at
          }
        }
      },
      http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
      router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
      refreshData: {url: 'auth/refresh-token', method: 'POST', enabled: true, interval: 30},
      authRedirect: { name: 'Login' },
      notFoundRedirect: { path: '/' }
    });
    
  }
}

export default AuthService