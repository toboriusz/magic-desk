import AssetService from 'Api/AssetService'

const state = {
	list: [],
  asset: {},
  filter: {}
}

const getters = {
	list: (state) => state.list,
  asset: (state) => state.asset,
  filter: (state) => state.filter
}

const actions = {
	fetchList({commit, state}, assetTypeId) {
    var filter = state.filter
    filter.asset_type_id = assetTypeId
    return AssetService.getList(filter).then((res) => {
      commit('setList', res.data.data)
      return res
    })
  },
  fetch({commit}, id) {
    return AssetService.get(id).then((res) => {
      commit('setAsset', res.data.data)
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
  update({dispatch}, data) {
    return AssetService.update(data.id, data.data)
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
    data.map((asset) => {
      if(asset.user)
        asset.user.fullname = asset.user.first_name + ' ' + asset.user.last_name

      asset.product.name = asset.product.brand + ' ' + asset.product.model
      return asset
    })
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