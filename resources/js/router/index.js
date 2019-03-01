import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

let router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '',
      redirect: {
        name: 'Dashboard'
      }
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: require('Views/Dashboard').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/page',
      name: 'Page',
      component: require('Views/Page').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/logout',
      name: 'Logout',
      component: require('Views/Auth/Logout').default,
      meta: {
        auth: true,
        layout: 'public'
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: require('Views/Auth/Login').default,
      meta: {
        auth: false,
        layout: 'public'
      }
    },
    {
      path: '/reset-password/:token',
      name: 'ResetPassword',
      component: require('Views/Auth/ResetPassword').default,
      meta: {
        auth: false,
        layout: 'public'
      }
    },
    {
      path: '/send-reset-email',
      name: 'SendResetEmail',
      component: require('Views/Auth/SendResetEmail').default,
      meta: {
        auth: false,
        layout: 'public'
      }
    },
    {
      path: '/verify-email/:token',
      name: 'VerifyEmail',
      component: require('Views/Auth/VerifyEmail').default,
      meta: {
        layout: 'public'
      }
    },
    {
      path: '*',
      name: '404',
      component: require('Views/404').default,
      meta: {
        layout: 'public'
      }
    }
  ]
})

export default router