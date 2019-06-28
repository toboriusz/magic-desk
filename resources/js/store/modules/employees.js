import EmployeeService from 'Api/EmployeeService'

const state = {
  list: [],
  employee: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  employee: (state) => state.employee,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return EmployeeService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return EmployeeService.get(id).then((res) => {
      commit('setSite', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return EmployeeService.create(data)
  },
  delete({dispatch}, id) {
    return EmployeeService.delete(id)
  },
  deletePerm({dispatch}, id) {
    return EmployeeService.delete(id, true)
  },
  restore({dispatch}, id) {
    return EmployeeService.restore(id)
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
  setEmployee(state, data) {
    state.employee = data
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
