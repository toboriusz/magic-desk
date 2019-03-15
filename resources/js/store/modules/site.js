import SiteService from 'Api/SiteService'

const state = {
  list: [],
  site: []
}

const getters = {
  list: (state) => state.list,
  site: (state) => state.site
}

const actions = {
	fetchList({commit}, filters = null) {
    return SiteService.getList(filters).then((res) => {
      commit('setList', res.data.data) 
      return res
    })
  },
  fetch({commit}, id) {
    return SiteService.get(id).then((res) => {
      commit('setSite', res.data.data) 
      return res
    })
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
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}