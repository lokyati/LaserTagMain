<template>
	<div class="profil_container">
		<div class="profil_header">
			<settingsdropdown></settingsdropdown>
			<div class="avatar">
				<img class="avatar_icon":src="'img/logo.png'"/>
				<img class="rank_icon" :src="'img/logo.png'"/>
				<p>Név: {{user.name}}</p>
				<p>Szint: {{user.lvl}}</p>
				<p>Lézer Pont: {{user.battle_point_balance}}</p>
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
		<progress class="progress is-info is-marginless" value="xp" max="100"><p>Tapasztalat</p></progress>
		<div class="profil_content">
			<div class="stats" v-bind:class="{showStat:showStat}">
				Statisztikak és kitüntetések
			</div>
			<div class="history" v-bind:class="{showHistory:showHistory}">
				Elozmenyek
			</div>
			<div class="bookings" v-bind:class="{showBookings:showBookings}">
				<div>
					<bookingcalendar :userID="userID"></bookingcalendar>
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

export default {
	data() {
		return{
			user: [],
			userID: 0,
			xp: '',
			showStat: true,
			showHistory: false,
			showBookings: false,
			showPersonal: false,
			statstyle: true,
			historystyle: false,
			bookingstyle: false,
			personalstyle: false,
		}
    },
    created() {
		this.getUserData();
  	},
  	components: {
    	settingsdropdown: settingsDropdown,
    	bookingcalendar: bookingCalendar
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
				this.xp = this.user.experience;
				console.log(this.user);
			})

  		},
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
	.bookings{
		display:none;
		width: 100%;
		min-height: 400px;
	}
	.showBookings.bookings{
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
</style>