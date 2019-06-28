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
      path: '/sites',
      name: 'Sites',
      component: require('Views/Sites/List').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/sites/:id',
      name: 'SitesShow',
      component: require('Views/Sites/Show').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/employees',
      name: 'Employees',
      component: require('Views/Employees/List').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/settings/general',
      name: 'SettingsGeneral',
      component: require('Views/Settings/General').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/settings/asset-types',
      name: 'SettingsAssetTypes',
      component: require('Views/Settings/AssetTypes').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/settings/asset-types/:id',
      name: 'SettingsAssetTypesShow',
      component: require('Views/Settings/AssetTypes/Show').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/settings/technicians',
      name: 'SettingsTechnicians',
      component: require('Views/Settings/Technicians').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/settings/about',
      name: 'SettingsAbout',
      component: require('Views/Settings/About').default,
      meta: {
        auth: true,
        layout: 'dashboard'
      }
    },
    {
      path: '/assets/:assetTypeId',
      name: 'Assets',
      component: require('Views/Assets').default,
      props: true,
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
      path: '/register',
      name: 'Register',
      component: require('Views/Auth/Register').default,
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
