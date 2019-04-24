<template>
	<div class="page">
		<div class="result_container">
			<div class="result_card_win card">
				<p class="title is-3">Gyozelem</p>
				<p class="subtitle is-5">Pontszam: 20</p>
				<p class="subtitle is-5">Leadott lovesek: 300</p>
				<p class="subtitle is-5">Talalatok: 150</p>
				<p class="subtitle is-5">Pontossag: 20%</p>
			</div>
			<div class="result_card_lose card">
				<p class="title is-3">Vereseg</p>
				<p class="subtitle is-5">Pontszam: 50</p>
				<p class="subtitle is-5">Leadott lovesek: 310</p>
				<p class="subtitle is-5">Talalatok: 240</p>
				<p class="subtitle is-5">Pontossag: 65%</p>
			</div>
		</div>
	</div>
</template>
<script>
	
</script>
<style>
	.page{
		width: 100%;
		height: 100%;

	}
	.result_container{
		width: 75em;
		height: 340px;
		margin: 0 auto;
		background-color: #a7a7a7;
		padding: 1em 21em;
	}
	.result_card_win{
		background-color: #52cb60;
		height: 300px;
		width: 15em;
		float: left; 
	}
	.result_card_lose{
		background-color: #e13434;
		height: 300px;
		width: 15em;
		float: right;
	}
	.card{
		text-align: center;
		box-shadow: 0px 0px 5px black;
	}
	.card p{
		color: white;
	}
</style>