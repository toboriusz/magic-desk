import Vue from 'vue'
import Vuex from 'vuex'

import menu from 'StoreModules/menu'
import auth from 'StoreModules/auth'
import icons from 'StoreModules/icons'
import assets from 'StoreModules/assets'
import assetTypes from 'StoreModules/assetTypes'
import sites from 'StoreModules/sites'
import products from 'StoreModules/products'
import users from 'StoreModules/users'
import states from 'StoreModules/states'
import pageLoader from 'StoreModules/pageLoader'

Vue.use(Vuex)

let store = new Vuex.Store({
  modules: {
    menu,
    auth,
    assets,
    icons,
    assetTypes,
    sites,
    products,
    users,
    states,
    pageLoader
  }
})

export default store
