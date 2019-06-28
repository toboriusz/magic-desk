<template>
  <v-dialog
    v-model="dialog"
    max-width="400">
    <v-card>
      <v-card-title class="headline" v-html="title"></v-card-title>
      <v-card-text v-html="text"></v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="grey"
          flat
          @click="dialog = false">
          Cancel
        </v-btn>
        <v-btn
          color="error"
          flat
          :loading="loading"
          @click="agreed">
          Delete permanently
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  export default {

    name: 'modal-delete-permanently',

    props: {
      title: {
        type: String,
        default: 'Do you want delete this item permanently?'
      },
      text: {
        type: String,
        default: 'You will be not able to recover it.'
      },
      storeModuleName: {
        type: String,
        required: true
      }
    },

    data () {
      return {
        itemId: null,
        dialog: false,
        loading: false
      }
    },

    methods: {
      agreed() {
        this.loading = true
        this.$store.dispatch(this.storeModuleName + '/deletePerm', this.itemId).then( (res) => {
          this.$emit('success')
          this.dialog = false
        }).catch( (e) => {
          //show alert error
        }).finally( () => {
          this.loading = false
        })
      }
    },
    mounted () {
      this.$on('open', (id) => {
        this.itemId = id
        this.dialog = true
      })
    },

    beforeDestroy () {
      this.$off('open')
    }

  }
</script>
