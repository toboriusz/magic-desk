import StateService from 'Api/StateService'

const state = {
  list: [],
  state: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  state: (state) => state.state,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return StateService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return StateService.get(id).then((res) => {
      commit('setProduct', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return StateService.create(data)
  },
  update({dispatch}, data) {
    return StateService.update(data.id, data.data)
  },
  delete({dispatch}, id) {
    return StateService.delete(id)
  },
  deletePerm({dispatch}, id) {
    return StateService.delete(id, true)
  },
  restore({dispatch}, id) {
    return StateService.restore(id)
  },
  updateFilter({commit}, filter) {
    commit('setFilter', filter)
  },
  resetFilter({commit}) {
    commit('setFilter', null)
  }
}

const mutations = {
  setList(state, data) {
    state.list = data
  },
  setProduct(state, data) {
    state.state = data
  },
  setFilter(state, filter) {
    state.filter = filter
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
