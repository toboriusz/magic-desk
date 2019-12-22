import UserService from 'Api/UserService'

const state = {
  list: [],
  user: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  user: (state) => state.user,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return UserService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return UserService.get(id).then((res) => {
      commit('setSite', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return UserService.create(data)
  },
  update({dispatch}, data) {
    return UserService.update(data.id, data.data)
  },
  delete({dispatch}, id) {
    return UserService.delete(id)
  },
  deletePerm({dispatch}, id) {
    return UserService.delete(id, true)
  },
  restore({dispatch}, id) {
    return UserService.restore(id)
  },
  updateFilter({commit, dispatch}, filter) {
    commit('setFilter', filter)
  },
  resetFilter({commit}) {
    commit('setFilter', null)
  }
}

const mutations = {
	setList(state, data) {
    data.map((item) => {
      var rItem = item
      rItem.name= item.first_name + ' ' + item.last_name
      return rItem
    })
    state.list = data
  },
  setUser(state, data) {
    state.user = data
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
