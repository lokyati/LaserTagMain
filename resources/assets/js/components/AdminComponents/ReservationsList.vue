<template>
	<div>

	</div>
</template>

<script>
	export default {
		data() {
			return {
				reservations: [],
				reservations: {
					id:'',
					user_id: '',
					package_id: '',
					players: '',
					dateTime: '',
					tel: '',
					email: '',
					note: '',
					bonus_used: '',
					price: '',
					paid_status: '',
					crated_at: '',
					updated_at: ''
				}
			}
		},
		methods: {
			getReservations(){
					axios.get('./api/reservations').then(response => {
		        	console.log(response)
		        	this.reservations = response.data
		        })
			}
		},
		mounted(){
			this.getReservations();
		}
	}
</script>

<style>
	
</style>