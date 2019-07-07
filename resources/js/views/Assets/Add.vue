<template>
  <v-container class="c-list">
    <md-header >
      <h2>Assets</h2>
      <router-link :to="{ name: 'Assets' }">{{ name }}</router-link>
    	<span>{{ name }}</span>
    </md-header>
    <v-card flat class="pa-5">
			<v-layout row wrap>
			  <v-icon class="asset-type__icon mr-5" color="grey lighten-2">{{ icon || 'help' }}</v-icon>
			  <v-flex> 
		      
			    <v-form data-vv-scope="asset-type-general">
			      <v-text-field
			        name="name"
			        label="Name"
			        type="text"
			        v-model="name"
			        ref="firstField"
			        data-vv-name="name"
			        v-validate="'required'"
			        @change="error = ''"
			        :error-messages="$validator.errors.collect('name')">
			      </v-text-field>
			      <v-autocomplete
	            name="product_id"
	            label="Product"
	            v-model="product_id"
	            :items="iconList"
	            cache-items
	            data-vv-name="product_id"
	            v-validate="'required'"
	            :error-messages="$validator.errors.collect('product_id')">
	            <template v-slot:item="data">
	              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
	            </template>
	            <template v-slot:append-outer>
		            <v-icon @click="$refs.modalProductForm.$emit('open')">add</v-icon>
			        </template>
	          </v-autocomplete>
			      <v-text-field
			        name="serial_no"
			        label="Serial number"
			        type="text"
			        v-model="serial_no"
			        data-vv-name="serial_no"
			        v-validate="'required'"
			        @change="error = ''"
			        :error-messages="$validator.errors.collect('serial_no')">
			      </v-text-field>
			      <v-text-field
			        name="barcode"
			        label="Barcode"
			        type="text"
			        v-model="barcode"
			        data-vv-name="barcode"
			        v-validate="'required'"
			        @change="error = ''"
			        :error-messages="$validator.errors.collect('barcode')">
			      </v-text-field>
			      <v-select
	            name="state_id"
	            label="Asset is currently in"
	            v-model="state_id"
	            clearable
	            item-text="name"
	            item-value="id"
	            data-vv-name="state_id"
	            @change="error = ''"
	            :error-messages="$validator.errors.collect('state_id')">
	          </v-select>
			      <v-textarea
			        max-height="10"
			        name="description"
			        label="Description"
			        v-model="description"
			        data-vv-name="description"
			        rows="1"
			        auto-grow
			        @change="error = ''"
			        :error-messages="$validator.errors.collect('description')">
			      </v-textarea>
			    </v-form>
			  </v-flex>
			</v-layout>
		</v-card>
		<modal-product-form
      ref="modalProductForm"
      :asset-type-id="$route.params.id"
      @success="$refs.table.$emit('refresh')">
    </modal-product-form>
	</v-container>
</template>

<script>

  import { mapGetters } from 'vuex'
  import MdHeader from 'Components/MdHeader'

  export default {

    name: 'ViewAssetsAdd',

    data() {
      return {}
    },

    methods: {
    },

    components: {
      MdHeader
    }

  }
</script>