import AssetService from 'Api/AssetService'

const state = {
	list: [],
  asset: {},
  fliter: []
}

const getters = {
	list: (state) => state.list,
  asset: (state) => state.asset,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return AssetService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return AssetService.get(id).then((res) => {
      commit('setAssetType', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return AssetService.create(data).then((res) => {
      dispatch('fetchList')
      dispatch('updateMenu')
      return res
    })
  },
  delete({dispatch}, id) {
    return AssetService.delete(id).then((res) => {
      dispatch('fetchList')
      dispatch('updateMenu')
      return res
    })
  },
  deletePerm({dispatch}, id) {
    return AssetService.delete(id, true).then((res) => {
      dispatch('fetchList')
      dispatch('updateMenu')
      return res
    })
  },
  restore({dispatch}, id) {
    return AssetService.restore(id).then((res) => {
      dispatch('fetchList')
      dispatch('updateMenu')
      return res
    })
  },
  updateFilter({commit}, filter) {
    commit('setFilter', filter)
  },
  resetFilter({commit}) {
    commit('setFilter', null)
  },
  updateMenu({dispatch}){
    dispatch('menu/fetchAssetTypes', null, { root: true })
  }
}

const mutations = {
	setList(state, data) {
    state.list = data
  },
  setAsset(state, data) {
    state.asset = data
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