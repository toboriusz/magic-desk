import AssetTypeService from 'Api/AssetTypeService'

const state = {
  drawer: true,
  assetTypes: []
}

const getters = {
	drawer: (state) => state.drawer,
  assetTypes: (state) => state.assetTypes
}

const actions = {
	setDrawer({commit}, drawer) {
    commit('setDrawer', drawer)
  },
  toggleDrawer({commit}) {
    commit('toggleDrawer')
  },
  fetchAssetTypes({commit}) {
    return AssetTypeService.getList().then((res) => {
      commit('setAssetTypes', res.data.data)
      return res
    })
  },
}

const mutations = {
	setDrawer(state, drawer) {
    state.drawer = drawer
  },
  toggleDrawer(state) {
    state.drawer = !state.drawer
  },
  setAssetTypes(state, data) {
    state.assetTypes = data
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}