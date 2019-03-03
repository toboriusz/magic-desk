<template>
  <v-list-group v-if="hasSubmenu" @click="click"  :prepend-icon="icon" no-action="no-action">
    <v-list-tile slot="activator" ripple="ripple">
      <v-list-tile-content>
        <v-list-tile-title>{{ title }}</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
    <slot></slot>
  </v-list-group>

  <v-list-tile v-else @click="click" :to="to" ripple="ripple" rel="noopener">
    <v-list-tile-action>
      <v-icon>{{ icon }}</v-icon>
    </v-list-tile-action>
    <v-list-tile-content>
      <v-list-tile-title>
        <slot></slot>
      </v-list-tile-title>
    </v-list-tile-content>
  </v-list-tile>
</template>

<script>
  export default {
    
    name: 'MenuItem',

    props: {
      title: String,
      to: {
        types: [Object, String],
        default: null
      },
      icon: String,
      hasSubmenu: Boolean
    },

    methods: {
      click (e) {
        return this.$emit('click', e)
      }
    }

  }
</script>
