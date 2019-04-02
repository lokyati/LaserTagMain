<template>
	<div class="profil_container">
		<div class="profil_header">
			<settingsdropdown ></settingsdropdown>
			<div class="avatar">
				<img class="avatar_icon":src="'img/logo.png'"/>
				<img class="rank_icon" :src="'img/logo.png'"/>
				<p>Warname: {{user.name}}</p>
				<p>Lvl: {{user.lvl}}</p>
				<p>Battle Points: {{user.battle_point_balance}}</p>
			</div>
			<div class="profil_nav_container">
				<div class="columns profil_nav">
					  <div class="column is-one-third is-paddingless">
					  	<a class="stat_nav" @click='showS()'
							v-bind:class="{statstyle:statstyle}"
					  	>Statisztikak</a>
					  	</div>
					  <div class="column is-paddingless"><a class="history_nav" @click='showH()' v-bind:class="{historystyle:historystyle}">Meccs elozmenyek</a></div>
					  <div class="column is-paddingless"><a class="booking_nav" @click='showB()' v-bind:class="{bookingstyle:bookingstyle}">Foglalasaim</a></div>
				</div>
			</div>
		</div>
		<progress class="progress is-danger is-marginless" value="60" max="100"></progress>
		<div class="profil_content">
			<div class="stats" v-bind:class="{showStat:showStat}">
				Statisztikak
			</div>
			<div class="history" v-bind:class="{showHistory:showHistory}">
				Elozmenyek
			</div>
			<div class="bookings" v-bind:class="{showBookings:showBookings}">
				<div>
					<bookingcalendar></bookingcalendar>
				</div>
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
			showStat: true,
			showHistory: false,
			showBookings: false,
			statstyle:true,
			historystyle: false,
			bookingstyle: false
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

  			this.statstyle = true
  			this.historystyle = false
  			this.bookingstyle = false
  		},
  		showH(){
  			this.showStat = false
  			this.showHistory = true
  			this.showBookings = false

  			this.statstyle = false
  			this.historystyle = true
  			this.bookingstyle = false
  		},
  		showB(){
  			this.showStat = false
  			this.showHistory = false
  			this.showBookings = true

  			this.statstyle = false
  			this.historystyle = false
  			this.bookingstyle = true
  		},
  		getUserData(){ //Laravelbe bejelentkezett user adatai
  			axios.get('profile').then(response => {
				this.user = response.data;
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
		background-color: blue;
	}
	.profil_content{
		width: 100%;
		background-color: green;
	}
	.avatar{
		width: 17em;
		height: 12.6em;
		background-color: yellow;
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
		background-color: black;
	}
	.showBookings.bookings{
		display:block;
	}
	.bookingstyle.booking_nav{
		background-color: #111;
	}

</style>