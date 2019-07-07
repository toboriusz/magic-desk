import SiteService from 'Api/SiteService'

const state = {
  list: [],
  basicList: [],
  site: [],
  filter: []
}

const getters = {
  list: (state) => state.list,
  projects: (state) => {
    return state.basicList.filter((site) => {
      return site.parent_id === null
    }) 
  },
  basicList: (state) => state.basicList,
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
  fetchBasicList({commit, state}) {
    return SiteService.getList({ basic: true }).then((res) => {
      commit('setBasicList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return SiteService.get(id).then((res) => {
      commit('setSite', res.data.data)
      return res
    })
  },
  update({dispatch}, data) {
    return SiteService.update(data.id, data.data)
  },
  add({dispatch}, data) {
    return SiteService.create(data)
  },
  delete({dispatch}, id) {
    return SiteService.delete(id)
  },
  deletePerm({dispatch}, id) {
    return SiteService.delete(id, true)
  },
  restore({dispatch}, id) {
    return SiteService.restore(id)
  },
  updateFilter({commit}, filter) {
    commit('setFilter', filter)
  },
  resetFilter({commit}) {
    commit('setFilter', null)
  }
}

const mutations = {
  setBasicList(state, data) {
    state.basicList = data
  },
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
