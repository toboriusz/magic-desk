import AssetTypeService from 'Api/AssetTypeService'

const state = {
  list: [],
  assetType: {},
  filter: []
}

const getters = {
  list: (state) => state.list,
  assetType: (state) => state.assetType,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}) {
    return AssetTypeService.getList(state.filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return AssetTypeService.get(id).then((res) => {
      commit('setAssetType', res.data.data)
      return res
    })
  },
  add({dispatch}, data) {
    return AssetTypeService.create(data).then((res) => {
      dispatch('updateMenu')
      return res
    })
  },
  update({dispatch, commit}, data) {
    return AssetTypeService.update(data.id, data.data).then((res) => {
      commit('setAssetType', res.data.data)
      dispatch('updateMenu')
      return res
    })
  },
  delete({dispatch}, id) {
    return AssetTypeService.delete(id).then((res) => {
      dispatch('updateMenu')
      return res
    })
  },
  deletePerm({dispatch}, id) {
    return AssetTypeService.delete(id, true)
  },
  restore({dispatch}, id) {
    return AssetTypeService.restore(id).then((res) => {
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
  setAssetType(state, data) {
    state.assetType = data
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
