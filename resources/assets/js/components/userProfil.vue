<template>
	<div class="profil_container">
		<div class="profil_header">
			<div class="avatar">
				<img class="avatar_icon":src="'img/logo.png'"/>
				<img class="rank_icon" :src="'img/logo.png'"/>
				<p>Warname</p>
				<p>LVL</p>
				<p>BTP</p>
			</div>
			<div class="profil_nav_container">
				<div class="profil_nav">
					<ul>
					  <li><a>Foglalasaim</a></li>
					  <li><a>Meccs elozmenyek</a></li>
					  <li><a>Statisztikak</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="profil_content">
			
		</div>
	</div>
</template>

<script>
	export default {

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
		height: 400px;
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
	.profil_nav ul {
		width: 100%;
		list-style-type: none;
		margin: 0 auto;
		padding: 0;
		overflow: hidden;
		background-color: grey;
	}

	.profil_nav li {
	  margin-right: 8em;
	  display: inline-flex;
	  margin-left: 9em;
	}

	.profil_nav li a {
	  display: block;
	  color: white;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	}

	.profil_nav li a:hover {
	  background-color: #111;
	}
</style>