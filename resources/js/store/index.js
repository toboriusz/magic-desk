import Vue from 'vue'
import Vuex from 'vuex'

import menu from 'StoreModules/menu'
import auth from 'StoreModules/auth'
import asset from 'StoreModules/asset'
import site from 'StoreModules/site'

Vue.use(Vuex)

let store = new Vuex.Store({
  modules: {
    menu,
    auth,
    asset,
    site
  }
})

export default store