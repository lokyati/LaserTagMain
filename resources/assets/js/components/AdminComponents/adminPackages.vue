<template>
<section>
	<packageeditmodal v-bind:edit="showEdit"
                  	  v-if="showEdit"
                  	  @close="showEdit = false" 
                  	  :pckgID="pckgID"
                  	  v-on:closeEditor="closeEditor($event)"></packageeditmodal>
    <deletepackagemodal v-bind:delete="showDelete"
                  	    v-if="showDelete"
                  	    @close="showDelete = false" 
                  	    :pckgID="pckgID"
                  	    :pckgName="pckgName"
                  	    v-on:closeDeleter="closeDeleter($event)"></deletepackagemodal>
    <creatermodal v-bind:creater="showCreater"
          	      v-if="showCreater"
          	      @close="showCreater = false" 
          	      v-on:closeCreater="closeCreater($event)"></creatermodal>
	<table>
		<thead>
		  <tr> 
		  	  <th>ID</th>
		      <th>Csomag neve</th>
			  <th>Ár</th>
			  <th>Meccs hossza</th>
			  <th>Meccsek száma</th>
			  <th>Teljes idő</th>
			  <th>Népszerűség</th>
			  <th>Leirás</th>
			  <th>Műveletek</th>
		  </tr>
		</thead>
		<tbody v-for="package in packages">
		  <tr>
		  	   <td>{{package.id}}</td>
			   <td>{{package.package_name}}</td>
			   <td>{{package.price}}</td>
			   <td>{{package.match_length}}</td>
			   <td>{{package.match_number}}</td>
			   <td>{{package.total_time}}</td>
			   <td>{{package.popularity}}</td>
			   <td>{{package.description}}</td>
			   <td>
			   		<div class="buttons are-small">
			   			<a class="button is-warning" @click="editPackage(package.id)">Szerkesztés</a> 
			   			<a class="button is-danger" @click='deletePackage(package.id,package.package_name)'>Törlés</a>
			   		</div>
			   </td>
		  </tr>
		</tbody>
	</table>
	<a class="button is-fullwidth is-info" @click="newPckg">Új csomag létrehozása</a>
</section>
</template>
<script>

import adminPackageEditModal from './adminPackageEditModal'
import adminPackageDeleteModal from './adminPackageDeleteModal'
import adminPackageCreaterModal from './adminPackageCreaterModal'

export default ({
	props:{
	},
	data() {
	  return {
	      packages: [],
	      packages_number: 0,
	      showEdit: false,
	      showDelete: false,
	      showCreater: false,
	      pckgID: 0,
	    }
	  },
	  created() {
	    this.getData();
	  },
	  components: {
	  	packageeditmodal: adminPackageEditModal,
	  	deletepackagemodal: adminPackageDeleteModal,
	  	creatermodal: adminPackageCreaterModal,
	  },
	  computed:{
	    
	  },
	  methods: {
	  	getData(){
		    axios.get('../api/allpackage').then(response => {
		      this.packages = response.data;
		    }).catch(function (error) {
		        console.log(error);
		      });


	  	},
	  	editPackage(id,name){
	  		this.showEdit = true;
	  		this.pckgID = id;	
	  	},
	  	deletePackage(id,name){
	  		this.showDelete = true;
	  		this.pckgID = id;
	  		this.pckgName = name;	
	  	},
	  	newPckg(){
	  		this.showCreater =true;
	  	},
	  	closeEditor(){
	  		this.showEdit = false;
	  		this.pckgID = 0;
	  		this.getData();
	  	},
	  	closeDeleter(){
	  		this.showDelete = false;
	  		this.pckgID = 0;
	  		this.pckgName = '';
	  		this.getData();
	  	},
	  	closeCreater(){
	  		this.showCreater = false;
	  		this.getData();
	  	},
	  }
});
</script>
<style>
* {
  box-sizing: border-box;
}
html {
  font-family: helvetica;
}

html, body {
  max-width: 100vw;
}

table {
 margin: auto;
  border-collapse: collapse;
  overflow-x: auto;
  display: block;
  width: fit-content;
  max-width: 100%;
  box-shadow: 0 0 1px 1px rgba(0, 0, 0, .1);
}

td, th {
  border: solid rgb(200, 200, 200) 1px;
  padding: .5rem;
}

th {
  text-align: left;
  background-color: rgb(190, 220, 250);
  text-transform: uppercase;
  padding-top: 1rem;
  padding-bottom: 1rem;
  border-bottom: rgb(50, 50, 100) solid 2px;
  border-top: none;
}

td {
  /*white-space: nowrap;*/
  border-bottom: none;
  color: rgb(20, 20, 20);
}

td:first-of-type, th:first-of-type {
  border-left: none;
}

td:last-of-type, th:last-of-type {
  border-right: none;
}

</style>