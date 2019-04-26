<template>
	<div class="profil_container">
		<deletemodal v-bind:delete="showDelete"
                  	 v-if="showDelete"
                  	 :userID="userID"
                  	 :resID="resID"
                  	 @close="showDelete = false" 
                  	 @closeanddelete="deleteReservation"></deletemodal>
		<div class="profil_header">
			<settingsdropdown></settingsdropdown>
			<div class="avatar">
				<img class="avatar_icon":src="'img/logo.png'"/>
				<img class="rank_icon" :src="'img/logo.png'"/>
				<p>Név: {{user.name}}</p>
				<p>Szint: {{user.lvl}}</p>
				<p>Bónusz Pont: {{user.battle_points}}</p>
			</div>
			<div class="profil_nav_container">
				<div class="columns profil_nav">
					  <div class="column is-one-quarter is-paddingless">
					  	<a class="stat_nav" @click='showS()'
							v-bind:class="{statstyle:statstyle}"
					  	>Statisztikak</a>
					  	</div>
					  <div class="column is-paddingless"><a class="history_nav" @click='showH()' v-bind:class="{historystyle:historystyle}">Meccs elozmenyek</a></div>
					  <div class="column is-paddingless"><a class="booking_nav" @click='showB()' v-bind:class="{bookingstyle:bookingstyle}">Foglalas</a></div>
					  <div class="column is-paddingless"><a class="personal_nav" @click='showP()' v-bind:class="{personalstyle:personalstyle}">Nevjegy</a></div>
				</div>
			</div>
		</div>
		<progress class="progress is-info is-marginless" :value="value" :max="max"></progress>
		<div class="profil_content">
			<div class="stats" v-bind:class="{showStat:showStat}">
				Statisztikak és kitüntetések
			</div>
			<div class="history" v-bind:class="{showHistory:showHistory}">
				Elozmenyek
			</div>
			<div class="bookings_container" v-bind:class="{showBookings:showBookings}">
				<h1 class="title is-3">Foglalásaid</h1>
				<div class="bookings" v-bind:class="{show:show}">
					<div class="reserved_card" v-for="reservation in reservations">
						<div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Név: </span>
					      <span class="tag is-info is-medium second_tag">{{reservation.lastname}} {{reservation.firstname}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Dátum: </span>
					      <span class="tag is-info is-medium second_tag">{{reservation.year}}-{{reservation.month}}-{{reservation.day}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Óra: </span>
					      <span class="tag is-info is-medium second_tag"></span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Csomag: </span>
					      <span class="tag is-info is-medium second_tag">{{reservation.package_id}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Játékosok: </span>
					      <span class="tag is-info is-medium second_tag">{{reservation.players}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag">Ár: </span>
					      <span class="tag is-info is-medium second_tag">{{reservation.price}}</span>
					    </div>
					    <a class="button is-danger is-medium is-fullwidth" @click="showDelete = true, selectReservation(reservation.id)">Foglalás lemondása</a>
					</div>
				</div>
				<div class="new_reservation" @click="showCalendar">
		        	<p id="add">Új foglalás</p>
		        </div>
				<div>
					<bookingcalendar v-bind:showcalendar="showcalendar" 
									 v-on:closeCalendar="closeCalendar"
									 :userID="userID" 
									 :userBonus="userBonus"
									 ></bookingcalendar>
				</div>
			</div>
			<div class="personal" v-bind:class="{showPersonal:showPersonal}">
				Szemelyes adatok
			</div>
		</div>
	</div>
</template>

<script>
import settingsDropdown from './settingsDropdown'
import bookingCalendar from './Calendar'
import DeleteModal from './DeleteModal';

export default {
	data() {
		return{
			user: [],
			reservations: [],
			userID: 0,
			userBonus: 0,
			value: 0,
			max: 100,
			showStat: true,
			showHistory: false,
			showBookings: false,
			showPersonal: false,
			showDelete: false,
			statstyle: true,
			historystyle: false,
			bookingstyle: false,
			personalstyle: false,
			showcalendar: false,
			show:false,
			resID: 0,
		}
    },
    created() {
		this.getUserData();
  	},
  	components: {
    	settingsdropdown: settingsDropdown,
    	bookingcalendar: bookingCalendar,
    	deletemodal: DeleteModal,
  	},
  	methods: {
  		showS(){
  			this.showStat = true
  			this.showHistory = false
  			this.showBookings = false
			this.showPersonal = false

  			this.statstyle = true
  			this.historystyle = false
  			this.bookingstyle = false
			this.personalstyle = false
  		},
  		showH(){
  			this.showStat = false
  			this.showHistory = true
  			this.showBookings = false
			this.showPersonal = false

  			this.statstyle = false
  			this.historystyle = true
  			this.bookingstyle = false
  			this.personalstyle = false
  		},
  		showB(){
  			this.showStat = false
  			this.showHistory = false
  			this.showBookings = true
			this.showPersonal = false

  			this.statstyle = false
  			this.historystyle = false
  			this.bookingstyle = true
  			this.personalstyle = false

			this.getReservations(this.userID);
  		},
  		showP(){
  			this.showStat = false
  			this.showHistory = false
  			this.showBookings = false
			this.showPersonal = true

  			this.statstyle = false
  			this.historystyle = false
  			this.bookingstyle = false
  			this.personalstyle = true
  		},
  		getUserData(){ //Laravelbe bejelentkezett user adatai
  			axios.get('profile').then(response => {
				this.user = response.data;
				this.userID = this.user.id;
				this.userBonus = this.user.battle_points;
				this.value = this.user.experience;
			});
  		},
  		showCalendar(){
  			this.showcalendar = true;
  		},
  		getReservations(userID) {
  			if(userID == 0){
  				userID = this.userID;
  			}else{
			    axios.get('./reservation/' + userID).then(response => {
			      this.reservations = response.data;
			      //console.log(this.reservations);
			      if(this.reservations.length != 0){
			      	this.show = true;
			      }else if(this.reservations.length == 0){
			      	this.show = false;
			      }
			    }).catch(function (error) {
			        console.log(error);
			      });
			}
		},
		closeCalendar(){
			this.showcalendar = false;
			this.getReservations(this.userID);
		},
		selectReservation(id){
			this.resID = id;
		},
		deleteReservation(){
			this.showDelete = false;
			axios.delete('./deleteReservedHour/' + this.resID)
			.then(response => {
				console.log("foglalas orak torolve")
				this.reservations = [];
				this.getReservations(this.userID);
			}).catch(function (error) {
		        console.log(error);
		      });
            this.getReservations(this.userID);
		},
  	},

  	computed: {
	},
}
</script>

<style>
.profil_container{
	width: 100%;
}
.profil_header{
	width: 100%;
	height: 250px;
}
.profil_content{
	width: 100%;
}
.avatar{
	width: 17em;
	height: 12.6em;
	margin: 0 auto;
	text-align: center;
}
.avatar p{
	margin: 0;
}
.avatar_icon{
	height: 7em;
}
.rank_icon{
	width:3em; 
	height:3em; 
	margin-bottom:64px; 
	margin-left:-52px;
}
.profil_nav_container{
	width: 100%;
	background-color: grey;
}
.profil_nav{
	margin: 0 auto;
	padding: 0;
	overflow: hidden;
	background-color: grey;
}

.profil_nav a {
	  display: block;
	  color: white;
	  text-align: center;
	  padding: .75em;
	  text-decoration: none;
}

.profil_nav a:hover {
 	background-color: #111;
}
.stats{
	display:none;
	width: 100%;
	min-height: 400px;
	background-color: purple;
}
.showStat.stats{
	display:block;
}
.statstyle.stat_nav{
	background-color: #111;
}
.history{
	display:none;
	width: 100%;
	min-height: 400px;
	background-color: orange;
}
.showHistory.history{
	display:block;
}
.historystyle.history_nav{
	background-color: #111;
}
.bookings_container{
	display:none;
	width: 100%;
	min-height: 400px;
}
.showBookings.bookings_container{
	display:block;
}
.bookingstyle.booking_nav{
	background-color: #111;
}
.personal{
	display:none;
	width: 100%;
	min-height: 400px;
}
.showPersonal.personal{
	display:block;
}
.personalstyle.personal_nav{
	background-color: #111;
}
.bookings{
	text-align: center;
 	display: none;
 	width: 100%;
 	height: 20em;
 	max-height: 40em;
}
.new_reservation{
 	background-color: #121d6e;
 	height: 40px;
 	cursor: pointer;
 	text-align: center;
 	margin-bottom: 1em;
}
#add{
  font-size: 1.5em;
  color: #0cd4f5;
}
.reserved_card{
	background-color: #1b6f96;
 	height: 300px;
 	width: 15em; 
 	box-shadow: 0px 0px 5px black;
 	border-radius: 13px;
 	margin-left: 1em;
 	margin-bottom: 1em;
 	padding: .5em;
 	float:left;
}
.show.bookings{
	display: block;
}
.first_tag{
	width: 5em;
}
.second_tag{
	width: 9em;
}
</style>