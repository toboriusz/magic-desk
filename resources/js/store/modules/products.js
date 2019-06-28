import ProductService from 'Api/ProductService'

const state = {
  list: [],
  product: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  product: (state) => state.product,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return ProductService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return ProductService.get(id).then((res) => {
      commit('setProduct', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return ProductService.create(data)
  },
  update({dispatch}, data) {
    return ProductService.update(data.id, data.data)
  },
  delete({dispatch}, id) {
    return ProductService.delete(id)
  },
  deletePerm({dispatch}, id) {
    return ProductService.delete(id, true)
  },
  restore({dispatch}, id) {
    return ProductService.restore(id)
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
    state.product = data
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
