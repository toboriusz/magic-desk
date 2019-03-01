const state = {

	menu_state: true,

	main_menu: [
	  { header: 'Main menu' },
	  {
	    title: 'Dashboard',
	    group: 'main',
	    icon: 'dashboard',
	    name: 'Dashboard',
	  },
	  {
	    title: 'Page',
	    group: 'main',
	    icon: 'web_asset',
	    name: 'Page',
	  }, 
	  // {
	  //   title: 'Settings',
	  //   group: 'main',
	  //   component: '',
	  //   icon: 'settings',
	  //   items: [
	  //     { name: 'general', title: 'General', component: 'Page' },
	  //     { name: 'config', title: 'Configuration', badge: 'new', component: 'Page' },
	  //     { name: 'units', title: 'Units', component: 'Page' },
	  //     { name: 'theme', title: 'Dashboard theme', component: 'Page' },
	  //   ]
	  // },  
	  // { divider: true },
	  // { header: 'Assets' },
	  // {
	  //   title: 'Desktop',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'desktop_windows',
	  // },
	  // {
	  //   title: 'Laptop',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'laptop_windows',
	  // },
	  // {
	  //   title: 'Mobile Phone',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'phone_android',
	  // },
	  // {
	  //   title: 'Printer',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'print',
	  // },
	  // {
	  //   title: 'Network item',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'router',
	  // },
	  // {
	  //   title: 'Custom asset',
	  //   group: 'assets',
	  //   name: 'Page',
	  //   icon: 'widgets',
	  // }
	],

	user_menu: [
    {
      icon: 'account_circle',
      to: 'Page',
      title: 'Profile'
    },
    {
      icon: 'settings',
      to: 'Page',
      title: 'Settings',
    },
    {
      icon: 'lock',
      to: 'Logout',
      title: 'Logout'
    }
  ]
}

const getters = {
	menuState: (state) => state.menu_state,
	mainMenu: (state) => state.main_menu,
	userMenu: (state) => state.user_menu
}

const actions = {
	toggle({commit}, value = null) {
		if(null === value)
			commit('toggle')
		else
			commit('setMenuState', value)
	}
}

const mutations = {
	toggle(state, value = null) {
			state.menu_state = !state.menu_state
	},
	setMenuState(state, value) {
		state.menu_state = value
	}
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}