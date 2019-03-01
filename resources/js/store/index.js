'use strict'

import Vue from 'vue'
import Vuex from 'vuex'

//import moduleName from 'StoreModules/moduleName'
import auth from 'StoreModules/auth'
import menu from 'StoreModules/menu'

Vue.use(Vuex)

let store = new Vuex.Store({
  modules: {
    //moduleName,
    auth,
    menu
  }
})

export default store