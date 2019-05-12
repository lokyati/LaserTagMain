<template>
<section>
	<table>
		<thead>
		  <tr> 
		  	  <th>ID</th>
		      <th>Felhasználónév</th>
			  <th>Rang</th>
			  <th>Vezetéknév</th>
			  <th>Keresztnév</th>
			  <th>Email</th>
			  <th>Telefonszám</th>
			  <th>Bónusz pontok</th>
			  <th>Regisztrált</th>
		  </tr>
		</thead>
		<tbody v-for="user in users">
		  <tr>
		  	   <td>{{user.id}}</td>
			   <td>{{user.name}}</td>
			   <td>{{user.rank_id}}</td>
			   <td>{{user.firstname}}</td>
			   <td>{{user.lastname}}</td>
			   <td>{{user.email}}</td>
			   <td>{{user.tel}}</td>
			   <td>{{user.battle_points}}</td>
			   <td>{{user.created_at}}</td>
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
	      rankData: [],

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
	  		axios.get('../rank').then(response => {
		      this.rankData = response.data;
		      this.rankName();
		    }).catch(function (error) {
		        console.log(error);
		      });

		    axios.get('../alluser').then(response => {
		      this.users = response.data;
		      for(let i = 0; i < this.users.length; i++){
				for(let z = 0; z < this.rankData.length; z++){
					if(this.rankData[z].id == this.users[i].rank_id){
		      		this.users[i].rank_id = this.rankData[z].rank_name;
		      	}
		      }
		    }
		    }).catch(function (error) {
		        console.log(error);
		      });

			
	  	},
	  	rankName(){
	  		console.log("lol")
	  		
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