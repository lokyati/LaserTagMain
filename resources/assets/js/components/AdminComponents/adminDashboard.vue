<template>
<section>
<div class="info-tiles">
    <div class="tile is-ancestor has-text-centered">
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title">{{usernumber}}</p>
                <p class="subtitle">Regisztrált felhasználók</p>
            </article>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title">{{loggedin_number}}</p>
                <p class="subtitle">Online felhasználók</p>
            </article>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title">{{reservations_number}}</p>
                <p class="subtitle">Foglalások</p>
            </article>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title">{{reservations_today_number}}</p>
                <p class="subtitle">Foglalások a mainap</p>
            </article>
        </div>
    </div>
</div>
</section>
</template>
<script>
export default ({
	props:{
	},
	data() {
	  return {
	      users:[],
	      usernumber: 0,
	      reservations: [],
	      reservations_number: 0,
	      reservations_today: [],
	      reservations_today_number: 0,
	      loggedin_number: 0,
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
	  		axios.get('../alluser').then(response => {
		      this.users = response.data;
		      console.log("valasz: " + this.users);
		      for(let i = 0; i < this.users.length; i++){
		      	this.usernumber += 1;
		      }
		    }).catch(function (error) {
		        console.log(error);
		      });

		    axios.get('../api/reservations').then(response => {
		      this.reservations = response.data;
		      for(let i = 0; i < this.reservations.length; i++){
		      	this.reservations_number += 1;
		      }
		    }).catch(function (error) {
		        console.log(error);
		      });

		    axios.get('../restoday').then(response => {
		      this.reservations_today = response.data;
		      for(let i = 0; i < this.reservations_today.length; i++){
		      	this.reservations_today_number += 1;
		      }
		    }).catch(function (error) {
		        console.log(error);
		      });

		    axios.get('../api/loggedinusers').then(response => {
	    		this.allloggedinuser = response.data;
	    		for(let i = 0; i < this.allloggedinuser.length; i++){
	    			this.loggedin_number += 1;
	    		}
	    	});
	  	},
	  }
});
</script>
<style>
	
</style>