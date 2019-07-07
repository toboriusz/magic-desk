const state = {
	loading: false
}

const getters = {
	loading: (state) => state.loading,
}

const actions = {
	on({commit}){
		commit('setLoading', true)
	},
	off({commit}){
		commit('setLoading', false)
	}
}

const mutations = {
	setLoading(state, data) {
		state.loading = data
	}
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}