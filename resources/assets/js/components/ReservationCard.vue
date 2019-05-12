<template>
	<div class="reservations_container">
    <div class="reserved_card" v-for="reservation in card.slice(m,n)">
            <div class="tags has-addons is-marginless">
                <span class="tag is-dark is-medium first_tag_booking">Név </span>
                <span class="tag is-info is-medium second_tag_booking">{{reservation.lastname}} {{reservation.firstname}}</span>
              </div>
              <div class="tags has-addons is-marginless">
                <span class="tag is-dark is-medium first_tag_booking">Dátum </span>
                <span class="tag is-info is-medium second_tag_booking">{{reservation.year}}.{{reservation.month}}.{{reservation.day}}.</span>
              </div>
              <div class="tags has-addons is-marginless">
                <span class="tag is-dark is-medium first_tag_booking">Órák </span>
                <span class="tag is-info is-medium second_tag_booking">{{reservation.first_hour}}</span>
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
              <a class="button is-danger is-medium is-fullwidth" @click="selectReservation(reservation.id)">Foglalás lemondása</a>
          </div>
  </div>
</template>
<script>
export default{
	props: {
		card: {
			type: Array, //checking type, if it's not array, make error in console
			required: true
		},
		n: {
			type: Number,
			required: true
		},
		m: {
			type: Number,
			required: true
		}
	},
		data(){
			return {
				itemsPerRow: 4,
        ID: 0,
			}
		},
		mounted() {
		},
		methods: {
      selectReservation(id){
        this.ID = id;
        console.log(this.ID);
        this.$emit('selectReservation',this.ID);
      },
		},
		computed: {
		},
		created() {
		}
	}
</script>
<style>
.reserved_card{
  font-family: 'Oswald', sans-serif !important;
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
.first_tag_booking{
  width: 5em;
}
.second_tag_booking{
  width: 9em;
}
</style>