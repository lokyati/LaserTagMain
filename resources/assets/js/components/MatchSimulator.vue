<template>
	<div class="simulator_container">
		<div class="header">
			<h1 class="title is-large">Meccs szimulátor</h1>
		</div>
		<div class="simulator_form_container">
			<div class="simulator_form">
				<div class="login_form">
		            <div class="field">
		              	<p>Felhasználó ID</p>
		                <input class="input is-fullwidth" v-model="userid">
		            </div>
		            <div class="field">
		              	<p>Helyezés</p>
		                <input class="input is-fullwidth" v-model="placed">
		            </div>
		            <div class="field">
		              	<p id="result">Eredmény</p>
		                <div class="select is-primary" required>
			              <select v-model="result">
			                <option v-for="result in results">{{result}}</option>
			              </select> 
			            </div>
		            </div>
		            <div class="field">
		              	<p>Leadott lövések</p>
		                <input class="input is-fullwidth" v-model="shots">
		            </div>
		            <div class="field">
		              	<p>Találatok</p>
		                <input class="input is-fullwidth" v-model="hits">
		            </div>
		            <div class="field">
		              	<p>Kiesések</p>
		                <input class="input is-fullwidth" v-model="out">
		            </div>
		            <div class="field">
		              <p>Dátum</p>
		                <input class="input is-fullwidth" v-model="date">
		            </div>
		              <p class="control">
		                <button class="button is-info is-fullwidth" @click="send">
		                  Szimuláció
		                </button>
		              </p>
		        </div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
	data() {
		return{
			userid: '1',
			score: '',
			shots: '250',
			hits: '110',
			bonus: '',
			out: '120',
			date: '2019-05-01',
			processed: false,
			placed: 1,
			results: ["Győzelem","Vereség"],
			result_value: false, 
			result: '',
		}
    },
    created() {
		
  	},
  	components: {
    	
  	},
  	methods: {
  		send(){
  			this.acc = (this.hits*100)/this.shots;
  			this.score = (this.hits * 2) - this.out;
  			this.bonus = this.placed;
  			axios.post('./simulation',{
            user_id: this.userid,
            score: this.score,
            all_shot: this.shots,
            all_hit: this.hits,
            acc: this.acc,
            all_out: this.out,
            bonus: this.bonus,
            match_date: this.date,
            placed: this.placed,
            result: this.result,
            processed: this.processed,
          });
  		},
  	},

  	computed: {
	},
}
</script>
<style>
	.simulator_container{
		width: 75em;
		height: 700px;
		background-color: #e6e6ff;
		margin: 0 auto;
	}
	.simulator_form_container{
		padding: 2em;
	}
	.simulator_form{
		width: 30em;
		margin: 0 auto;
	}
	.header{
		width: 100%;
		height: 50px;
		background-color: #adad85;
		text-align: center;
	}
	.field{
		display: inline-flex;
	}
	.field p{
		width: 12em;
		font-size: 25px;
	}
	.input{
		width: 19em;
		float: right;
		margin-bottom: 0.75em;
	}
	select{
		width: 19em;
	}
	#result{
		width: 7em;
	}
</style>