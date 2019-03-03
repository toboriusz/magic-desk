<template>
  <v-list-tile :to="to" ripple="ripple">
    <v-list-tile-content>
      <v-list-tile-title>
        <slot></slot>
      </v-list-tile-title>
    </v-list-tile-content>
  </v-list-tile>
</template>

<script>
  export default {
    
    name: 'MenuSubItem',

    props: {
      to: {
        types: [Object, String],
        default: null
      }
    }

  }
</script>
