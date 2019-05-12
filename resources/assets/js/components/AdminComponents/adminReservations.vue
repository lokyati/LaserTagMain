<template>
<section>
	<table>
		<thead>
		  <tr>
			  <th>Id</th>  
		      <th>Felhasználó</th>
			  <th>Csomag</th>
			  <th>Vezetéknév</th>
			  <th>Keresztnév</th>
			  <th>Foglalt Dátum</th>
			  <th>Lefoglalt órák</th>
			  <th>Játékosok száma</th>
			  <th>Telefonszám</th>
			  <th>Email cim</th>
			  <th>Megjegyzés</th>
			  <th>Felhasznált bónusz</th>
			  <th>Ár</th>
			  <th>Foglalás ideje</th>
		  </tr>
		</thead>
		<tbody v-for="reservation in reservations">
		  <tr>
			   <td>{{reservation.id}}</td>
			   <td>{{reservation.user_id}}</td>
			   <td>{{reservation.package_id}}</td>
			   <td>{{reservation.lastname}}</td>
			   <td>{{reservation.firstname}}</td>
			   <td>{{reservation.year}}. {{reservation.month}}. {{reservation.day}}.</td>
			   <td>{{reservation.updated_at}}</td>
			   <td>{{reservation.players}}</td>
			   <td>{{reservation.tel}}</td>
			   <td>{{reservation.email}}</td>
			   <td>{{reservation.note}}</td>
			   <td>{{reservation.bonus_used}}</td>
			   <td>{{reservation.price}}</td>
			   <td>{{reservation.created_at}}</td>
		  </tr>
		</tbody>
	</table>
</section>
</template>
<script>
export default ({
	props:{
	},
	data() {
	  return {
	  	  users: [],
	      reservations: [],
	      packages: [],
	      reservedHours: [],
	      reservedhoursByID: [],
	      reservations_number: 0,
	      reservedHoursString: '',
	    }
	  },
	  created() {
	    this.getData();
	  },
	  components: {
	  },
	  computed:{
	    
	  },
	  methods: {
	  	getData(){
		    axios.get('../api/reservations').then(response => {
		      this.reservations = response.data;
		      for(let i = 0; i < this.reservations.length; i++){
		      	this.reservations_number += 1;
		      }
		    }).catch(function (error) {
		        console.log(error);
		      });

		    axios.get('../allpackage/').then(response => {
			      this.packages = response.data;
			      for(let i = 0; i < this.reservations.length; i++){
			    	for(let k = 0; k < this.packages.length; k++){
			    		if(this.reservations[i].package_id == this.packages[k].id){
			    			this.reservations[i].package_id = this.packages[k].package_name;
			    		}
			    	}
			    }
			    }).catch(function (error) {
			        console.log(error);
			      });

			axios.get('../api/Reservedhours').then(response => {
				this.reservedHours = response.data;
				console.log(this.reservedHours)
				for(let i = 0; i < this.reservations.length; i++){
			    	for(let k = 0; k < this.reservedHours.length; k++){
			    		if(this.reservations[i].id == this.reservedHours[k].reservation_id){
			    			this.reservedhoursByID.push(this.reservedHours[k].hour);
			    		}
			    	}
			    	this.reservedHoursString = this.reservedhoursByID.toString();
			    	this.reservations[i].updated_at = this.reservedHoursString;
			    	this.reservedhoursByID = [];
			    	this.reservedHoursString = '';
			    }
			});

			axios.get('../alluser').then(response => {
		      this.users = response.data;
		      for(let i = 0; i < this.users.length; i++){
				for(let z = 0; z < this.reservations.length; z++){
					if(this.reservations[z].user_id == this.users[i].id){
		      		this.reservations[z].user_id = this.users[i].name
		      	}
		      }
		    }
		    }).catch(function (error) {
		        console.log(error);
		      });
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