<template>
	<div class="packages_container">
		<div class="package_card" 
			 v-for="package in packages"
			 @click="selectPackage(package.id)">
			<p class="title is-3">{{package.package_name}}</p>
			<p class="subtitle is-5">Ar/fo: {{package.price}}</p>
			<p class="subtitle is-5">Meccsek hossza: {{package.match_length}} perc</p>
			<p class="subtitle is-5">Meccsek száma: {{package.match_number}}</p>
			<p class="subtitle is-5">Teljes játekidő: {{package.total_time}} ora</p>
			<p>{{package.description}}</p>
		</div>
	</div>
</template>
<script>
	export default ({
    props:{
      packages:{
      	type: Array,
      	required: true,
      }
    },
    data() {
      return {
          ID: 0,
        }
      },
      components: {
    },
    methods: {
    	selectPackage(id){
			this.ID = id;
			this.$emit('close',id);
    	}
    },
  });
</script>
<style>
	.packages_container{
		display: flex;
		font-family: 'Oswald', sans-serif !important;
	}
	.package_card{
		background-color: #ff9f63;
		height: 325px;
		width: 14em;
		margin: 0 auto; 
		cursor: pointer;
		text-align: center;
		box-shadow: 0px 0px 5px black;
	}
	.package_card p{
		color: white;
	}
</style>