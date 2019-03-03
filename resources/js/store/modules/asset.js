const state = {
	types: [
    {
      id: 1,
      title: 'Desktops',
      name: 'desktops',
      icon: 'desktop_windows'
    },
    {
      id: 2,
      title: 'Laptops',
      name: 'laptops',
      icon: 'laptop_windows'
    }
  ]
}

const getters = {
	types: (state) => state.types
}

const actions = {
	//Actions
}

const mutations = {
	//Mutations
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}