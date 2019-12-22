import CustomFieldService from 'Api/CustomFieldService'

const state = {
  list: [],
  customField: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  customField: (state) => state.customField,
}

const actions = {
	fetchList({commit, state}) {
    return CustomFieldService.getList().then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return CustomFieldService.get(id).then((res) => {
      commit('setCustomField', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return CustomFieldService.create(data)
  },
  update({dispatch}, data) {
    return CustomFieldService.update(data.id, data.data)
  },
  delete({dispatch}, id) {
    return CustomFieldService.delete(id)
  }
}

const mutations = {
  setList(state, data) {
    state.list = data
  },
  setCustomField(state, data) {
    state.customField = data
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
