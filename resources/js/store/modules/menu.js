const state = {
  drawer: true
}

const getters = {
	drawer: (state) => state.drawer
}

const actions = {
	setDrawer({commit}, drawer) {
    commit('setDrawer', drawer)
  },
  toggleDrawer({commit}) {
    commit('toggleDrawer')
  }
}

const mutations = {
	setDrawer(state, drawer) {
    state.drawer = drawer
  },
  toggleDrawer(state) {
    state.drawer = !state.drawer
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}