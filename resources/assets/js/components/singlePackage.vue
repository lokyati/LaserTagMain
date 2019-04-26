<template>
	<div class="packages_container">
		<div class="package_card" @click="packageSelect">
			<p class="title is-3">{{package.package_name}}</p>
			<p class="subtitle is-5">Ar/fo: {{package.price}}</p>
			<p class="subtitle is-5">Jatekido: {{package.time}} ora</p>
			<p>{{package.description}}</p>
		</div>
	</div>
</template>
<script>
	export default ({
    props:{
      package:{
      	type: Array,
      	required: true,
      }
    },
    data() {
      return {
          ID: 0,
          packagePrice: 0,
        }
      },
      components: {
    },
    methods: {   
    	packageSelect(){
		  this.$emit('selectagain');
		},
    },
  });
</script>
<style>
	.packages_container{
		display: flex;
	}
	.package_card{
		background-color: #ff9f63;
		height: 300px;
		width: 15em;
		margin: 0 auto; 
		cursor: pointer;
		text-align: center;
		box-shadow: 0px 0px 5px black;
	}
	.package_card p{
		color: white;
	}
</style>