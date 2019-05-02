<template>
	<div class="profil_container">
		<deletemodal v-bind:delete="showDelete"
                  	 v-if="showDelete"
                  	 :userID="userID"
                  	 :resID="resID"
                  	 @close="showDelete = false" 
                  	 @closeanddelete="deleteReservation"></deletemodal>
        <editormodal v-bind:editor="showEditor"
        			 v-if="showEditor"
        			 :userID="userID"
        			 @close="showEditor = false"
        			 v-on:closeEditor="closeEditor($event)"></editormodal>
        <updatemodal v-bind:update="showUpdate"
                  	 v-if="showUpdate"
                  	 :userID="userID"
                  	 :unprocessed="unprocessed"
                  	 @close="showUpdate = false"
                  	 v-on:closeUpdate="closeUpdate"></updatemodal>
		<div class="profil_header">
			<settingsdropdown></settingsdropdown>
			<div class="avatar">
				<img class="avatar_icon":src="'img/avatar.png'"/>
				<img class="rank_icon" :src="'img/' + rank_src"/>
				<p>Név: {{user.name}}</p>
				<p>Bónusz Pont: {{user.battle_points}}</p>
			</div>
			<div class="profil_nav_container">
				<div class="columns profil_nav">
					  <div class="column is-one-third is-paddingless">
					  	<a class="stat_nav" @click='showS()'
							v-bind:class="{statstyle:statstyle}"
					  	>Statisztikák és névjegy</a>
					  	</div>
					  <div class="column is-paddingless"><a class="history_nav" @click='showH()' v-bind:class="{historystyle:historystyle}">Meccs előzmények</a></div>
					  <div class="column is-paddingless"><a class="booking_nav" @click='showB()' v-bind:class="{bookingstyle:bookingstyle}">Foglalás</a></div>
					  <!--<div class="column is-paddingless"><a class="personal_nav" @click='showP()' v-bind:class="{personalstyle:personalstyle}">Névjegy</a></div>-->
				</div>
			</div>
		</div>
		<div class="profil_content">
			<div class="stats" v-bind:class="{showStat:showStat}">
				<div class="columns is-paddingless is-marginless">
					<div class="column is-half">
						<div class="field is-grouped is-grouped-multiline profile_tag_container">
							<div class="progress_container">
								<div class="control centered_tags">
									<div class="tags has-addons profile_tag">
								      <span class="tag is-dark is-large">Tapasztalat ({{userStat.experience}})</span>
								      <div class="progress_bar">
								      	<progress class="progress is-primary is-marginless" :value="value" :max="max"></progress>
								      </div>
								    </div>
								 </div>
							</div>
						<div class="columns lvlrank">
							<div class="column is-two-thirds is-paddingless">
								<div class="control centered_tags">
									<div class="tags has-addons profile_tag">
								      <span class="tag is-dark is-large">Rangod</span>
								      <span class="tag is-info is-large rank_tag">{{rank_name}}</span>
								    </div>
								 </div>
							</div>
							<div class="column is-paddingless">
								<div class="control centered_tags">
									<div class="tags has-addons profile_tag">
								      <span class="tag is-dark is-large">Szinted</span>
								      <span class="tag is-info is-large lvl_tag">{{userStat.lvl}}</span>
								    </div>
								 </div>
							</div>
						</div>
						  <div class="control centered_tags">
						    <div class="tags has-addons profile_tag">
						      <span class="tag is-dark is-large profile_tag_1">Vezeteknév</span>
						      <span class="tag is-info is-large profile_tag_2">{{user.lastname}}</span>
						    </div>
						  </div>

						  <div class="control centered_tags">
						    <div class="tags has-addons profile_tag">
						      <span class="tag is-dark is-large profile_tag_1">Keresztnév</span>
						      <span class="tag is-info is-large profile_tag_2">{{user.firstname}}</span>
						    </div>
						  </div>
							
						  <div class="control centered_tags">
						    <div class="tags has-addons profile_tag">
						      <span class="tag is-dark is-large profile_tag_1">Telefonszám +40</span>
						      <span class="tag is-primary is-large profile_tag_2">{{tel}}</span>
						    </div>
						  </div>

						  <div class="control centered_tags">
						    <div class="tags has-addons profile_tag">
						      <span class="tag is-dark is-large profile_tag_1">E-mail</span>
						      <span class="tag is-primary is-large profile_tag_2">{{user.email}}</span>
						    </div>
						  </div>

						  <div class="control centered_tags">
						    <div class="tags has-addons profile_tag">
						      <span class="tag is-dark is-large profile_tag_1">Regisztrált ekkor</span>
						      <span class="tag is-success is-large profile_tag_2">{{user.created_at}}</span>
						    </div>
						  </div>
						  <div class="control centered_tags">
						  	<a id="editor_btn" class="button is-warning is-fullwidth" @click="edit">Adatok módositása</a>
						  </div>
						</div>
					</div>
					<div class="column stats_container">
						<div class="columns">
							<div class="column is-half">
								<div class="win_container">
									<div class="counter_title">
										<p>Győzelmek</p>
									</div>
									<div class="roundstat_win">
										<div class="nmbr_win">
											<p>{{userStat.wins}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Összes meccs</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.matches}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Leadott lövések</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.all_shot}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Találatok</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.all_hit}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Kiesések</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.all_out}}</p>
										</div>
									</div>
								</div>
							</div>
							<div class="column">
								<div class="lose_container">
									<div class="counter_title">
										<p>Vereségek</p>
									</div>
									<div class="roundstat_lose">
										<div class="nmbr_lose">
											<p>{{userStat.loses}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Legjobb helyezés</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.bestplace}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Átlag lövés</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.avg_shot}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Átlag találat</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.avg_hit}}</p>
										</div>
									</div>
								</div>
								<div class="counter_container">
									<div class="counter_title">
										<p>Pontosság</p>
									</div>
									<div class="roundstat_counter">
										<div class="nmbr">
											<p>{{userStat.avg_acc}}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="history" v-bind:class="{showHistory:showHistory}">
				<h1 class="title is-1 historyInfo" v-bind:class="{showHistoryInfo}">Nincs lejátszott meccs az adatbázisban.</h1>
				<simplecarousel class="carousel" :userID="userID" :Matches="matches" v-bind:class="{showCarousel}"></simplecarousel>
			</div>
			<div class="bookings_container" v-bind:class="{showBookings:showBookings}">
				<h1 class="title is-3">Foglalásaid</h1>
				<div class="bookings" v-bind:class="{show:show}">
					<div class="reserved_card" v-for="reservation in reservations">
						<div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Név </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.lastname}} {{reservation.firstname}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Dátum </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.year}}-{{reservation.month}}-{{reservation.day}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Időpont </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.first_hour}}:00</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Csomag: </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.package_id}}</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Játékosok </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.players}} fő</span>
					    </div>
					    <div class="tags has-addons is-marginless">
					      <span class="tag is-dark is-medium first_tag_booking">Ár </span>
					      <span class="tag is-info is-medium second_tag_booking">{{reservation.price}} Lei</span>
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
									 :firstname="firstname"
									 :lastname="lastname"
									 :tel="tel"
									 ></bookingcalendar>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import settingsDropdown from './settingsDropdown'
import bookingCalendar from './Calendar'
import DeleteModal from './DeleteModal'
import EditorModal from './EditorModal'
import SimpleCarousel from './SimpleCarousel'
import UpdateModal from './UpdateModal'

export default {
	data() {
		return{
			user: [],
			userStat: [],
			reservations: [],
			matches: [],
			rankData: [],
			packages: [],
			unprocessed: [],
			userID: 0,
			resID: 0,
			rankID: 1,
			pckgID: 0,
			userBonus: 0,
			value: 0,
			max: 1000,
			showStat: false,
			showHistory: false,
			showBookings: false,
			showPersonal: false,
			showDelete: false,
			showEditor: false,
			showCarousel: false,
			showUpdate: false,
			statstyle: false,
			historystyle: false,
			bookingstyle: false,
			personalstyle: false,
			showcalendar: false,
			showHistoryInfo: true,
			show:false,
			lastname: '',
			firstname: '',
			tel: '',
			rank_src: '',
			rank_name: '',
		}
    },
    created() {
		this.getUserData();
  	},
  	components: {
    	settingsdropdown: settingsDropdown,
    	bookingcalendar: bookingCalendar,
    	deletemodal: DeleteModal,
    	editormodal: EditorModal,
    	simplecarousel: SimpleCarousel,
    	updatemodal: UpdateModal,
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

			this.getUserStat();
			this.getRank();
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

  			this.getMatches(this.userID);
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
  		getUserData(){ //Laravelbe bejelentkezett user adatai
  			axios.get('profile').then(response => {
				this.user = response.data;
				this.userID = this.user.id;
				this.userBonus = this.user.battle_points;
				this.lastname = this.user.lastname;
				this.firstname = this.user.firstname;
				this.tel = this.user.tel;
				this.rank_src = this.user.rank_id + '.png';
			});
			
  		},
  		getUserStat(){
  			axios.get('./userstat/' + this.userID).then(response => {
				this.userStat = response.data;
				console.log(this.userStat);
				this.value = this.userStat.experience;
			});
  		},
  		getMatches(userID){
          axios.get('./matches/' + this.userID).then(response => {
            this.matches = response.data;
            //console.log(this.matches);
             if(this.matches.length > 0){
	          	this.showCarousel = true;
	          	this.showHistoryInfo = false;
	          }
	          for(let i = 0; i < this.matches.length; i++){
	          	if(this.matches[i].processed == 0){
	          		this.unprocessed.push(this.matches[i]);
	          	}
          	   }
          	   if(this.unprocessed.length > 0){
          	   	this.showUpdate = true;
          	   }

          }).catch(function (error) {
              console.log(error);
            });


          
      },
  		showCalendar(){
  			this.showcalendar = true;
  		},
  		getReservations(userID) {
  			if(this.userID == 0){
  				this.userID = this.user.id;
  			}else{
			    axios.get('./reservation/' + userID).then(response => {
			      this.reservations = response.data;
			      this.pckgID = this.reservations.package_id;
			      //console.log(this.reservations);
			      if(this.reservations.length != 0){
			      	this.show = true;
			      }else if(this.reservations.length == 0){
			      	this.show = false;
			      }
			    }).catch(function (error) {
			        console.log(error);
			      });

			    axios.get('./allpackage/').then(response => {
			      this.packages = response.data;
			      for(let i = 0; i < this.reservations.length; i++){
			    	for(let k = 0; k < this.packages.length; k++){
			    		if(this.reservations[i].package_id == this.packages[k].id){
			    			this.reservations[i].package_id = this.packages[k].package_name;
			    			console.log("jartam itt")
			    		}
			    	}
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
		closeEditor(){
			this.showEditor = false;
			this.getUserData();
		},
		selectReservation(id){
			this.resID = id;
		},
		deleteReservation(){
			this.showDelete = false;
			axios.delete('./deleteReservedHour/' + this.resID)
			.then(response => {
				this.reservations = [];
				this.getReservations(this.userID);
			}).catch(function (error) {
		        console.log(error);
		      });
            this.getReservations(this.userID);
		},
		edit(){
			this.showEditor = true;
		},
		getRank(){
			axios.get('./rank').then(response => {
		      this.rankData = response.data;
		      this.getRankName(this.rankData,this.user);
		    }).catch(function (error) {
		        console.log(error);
		      });
		    console.log(this.userStat);
		},
		getRankName(rankData,user){
			for(let i = 0; i < rankData.length; i++){
		      	if(rankData[i].id === user.rank_id){
		      		this.rank_name = rankData[i].rank_name;
		      	}
		      }
		},
		closeUpdate(){
			this.showUpdate = false;
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
	height: 266px;
}
.profil_content{
	width: 100%;
	min-height: 20em;
}
.avatar{
	width: 17em;
	height: 13.6em;
	margin: 0 auto;
	text-align: center;
}
.avatar p{
	margin: 0;
}
.avatar_icon{
	height: 7em;
	border-radius: 50%;
	border: solid 3px black;
}
.rank_icon{
	width:2em; 
	height:3em; 
	margin-bottom:67px; 
	margin-left:-35px;
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
	overflow: hidden;
	padding: 2em;
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
.first_tag_booking{
	width: 5em;
}
.second_tag_booking{
	width: 9em;
}
.profile_tag_container{
	padding: 4em;
}
.profile_tag{
	margin-bottom: 1.5rem !important;
}
.profile_tag_1{
	width: 12.4em;
}
.profile_tag_2{
	width: 10em;
}
.editor{
	cursor: pointer;
}
.carousel{
	display: none;
}
.showCarousel.carousel{
	display: block;
}
.historyInfo{
	display:none;
}
.showHistoryInfo.historyInfo{
	display: block;
}
.centered_tags{
	margin: 0 auto;
}
#editor_btn{
	margin: 0 auto;
}

.stats_container{
	padding:2em;
}
.win_container{
	width: 8em;
}
.win_container p{
	font-size: 1.5em;
	font-weight: bold;
}
.roundstat_win{
	width: 9em;
	height: 9em;
	border-radius: 50%;
	border: 8px solid #38c016;
	padding: 1em;
}
.nmbr_win p{
	font-size: 36px;
	font-weight: bold;
	margin: 0 auto;
	margin-top: .5em;
	color: #38c016;
}
.lose_container{
	width: 8em;
}
.lose_container p{
	font-size: 1.5em;
	font-weight: bold;
}
.roundstat_lose{
	width: 9em;
	height: 9em;
	border-radius: 50%;
	border: 8px solid #c0150e;
	padding: 1em;
}
.nmbr_lose p{
	font-size: 36px;
	font-weight: bold;
	margin: 0 auto;
	color: #c0150e;
	margin-top: .5em;
}
.counter_container{
	width: 9em;
}
.counter_container p{
	font-size: 1.1em;
	font-weight: bold;
	height: 3em;
	padding-top: 1em;
}
.roundstat_counter{
	width: 9em;
	height: 9em;
	border-radius: 50%;
	border: 8px solid orange;
	padding: 1em;
}
.nmbr{
	width: 6em;
	height: 4em;
	margin: 0 auto;
	text-align: center;
	margin-top: -.6em;
}
.nmbr_win{
	width: 5em;
	height: 4em;
	margin: 0 auto;
	text-align: center;
}
.nmbr_lose{
	width: 5em;
	height: 4em;
	margin: 0 auto;
	text-align: center;
}
.nmbr p{
	font-size: 33px;
	font-weight: bold;
	margin: 0 auto;
	color: orange;
}
.counter_title{
	text-align: center;
}
.lvlrank{
	width: 100%;
	margin: 0 auto;
}
.rank_tag{
	width: 9.7em;
}
.lvl_tag{
	width: 2.7em;
}
.progress{
	border-radius: 0;
	height: 2.5rem;
	width: 16.9em;
	background-color: #fff;
	border: 1px solid #363636;
}
.progress_bar{
	margin-bottom: .5rem;
}
</style>