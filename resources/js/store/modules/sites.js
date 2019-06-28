import SiteService from 'Api/SiteService'

const state = {
  list: [],
  site: [],
  filter: []
}

const getters = {
  list: (state) => state.list,
  site: (state) => state.site,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return SiteService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return SiteService.get(id).then((res) => {
      commit('setSite', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return SiteService.create(data).then((res) => {
      dispatch('fetchList')
      return res
    })
  },
  delete({dispatch}, id) {
    return SiteService.delete(id).then((res) => {
      dispatch('fetchList')
      return res
    })
  },
  deletePerm({dispatch}, id) {
    return SiteService.delete(id, true).then((res) => {
      dispatch('fetchList')
      return res
    })
  },
  restore({dispatch}, id) {
    return SiteService.restore(id).then((res) => {
      dispatch('fetchList')
      return res
    })
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

    data.map((item) => {
      var rItem = item
      rItem.address= ''
      rItem.address += (item.address1) ? (item.address1): ''
      rItem.address += (item.address2) ? (', ' + item.address2): ''
      rItem.address += (item.city) ? (', ' + item.city): ''
      rItem.address += (item.postcode) ? (', ' + item.postcode): ''
      return rItem
    })
    state.list = data
  },
  setSite(state, data) {
    state.site = data
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
