<template>
<div>
    <div class="alert alert-primary text-center" v-if="processing">
    <img src="/sidepej/public/images/preloader.gif" />
    </div>
    <v-server-table ref="table" :columns="columns" :url="url" :options="options">
        <div slot="sucursal_id" slot-scope="props">
           {{props.row.sucursal.sucursal}}
        </div>
        <div slot="filter__sucursal_id" @change="filterBySucursal">
        	<select class="form-control" v-model="sucursal_id">
        	    <option value="0" selected>Seleccione</option>
        	    <option v-for="suc in sucursales" :value="suc.id">{{suc.sucursal}}</option>
        	</select>
        </div>
    </v-server-table>
</div>
</template>
<script>
 import {Event} from 'vue-tables-2'
export default{
    name: "documentos",
    props: {
      labels: {
        type: Object,
        required : true
      },
      route: {
        type: String,
        required : true
      }
    },
    mounted: function(){
     this.fetchsucurales();
    },
	data(){
	  return {
	    processing: false,
	    sucursal_id: null,
	    sucursales: [],
	    url: this.route,
	    columns: ['id','numeroResolucion','fechaResolucion','razonSocial','provincia','municipio','localidad','sucursal_id'],
	    options: {
	        filterByColumn: true,
	        perPage: 10,
	        perPageValues: [10,25,50,100,500],
	        headings: {
	        id: 'ID',
	        numeroResolucion: this.labels.numeroResolucion,
	        fechaResolucion: this.labels.fechaResolucion,
	        razonSocial: this.labels.razonSocial,
	        provincia: this.labels.provincia,
	        municipio: this.labels.municipio,
          localidad: this.labels.localidad,
	        sucursal_id: this.labels.sucursal_id
	        },
	        customFilters: ['sucursal_id'],
		    sortable: ['id','razonSocial','provincia','municipio'],
		    filterable: ['razonSocial','provincia','municipio','localidad'],
		    requestFunction(data){
	          return axios.get(this.url,{
	            params: data
	          })
	          .catch(e => {
	            this.dispatch('error',e)
	          });
		    }
	    }
	    
	  }
	},
	methods: {
	    filterBySucursal(){ 
	    let vm = this
         Event.$emit('vue-tables.filter::sucursal_id', vm.sucursal_id);
	    },
	    fetchsucurales(){
          axios.get('/sidepej/public/api/sucursales')
            .then(response => {
            console.log(response.data)
            this.sucursales = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .finally(function () {
            // always executed
            });
        }
	}
}
</script>
<style scoped>
 .table-bordered>thead>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>td {
   text-align: center !important;
 } 
</style>