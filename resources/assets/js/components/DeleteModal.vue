<template> 
  <div id="success" class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title has-text-danger">Biztosan törölni szeretnéd ezt a foglalást?</p>
      </header>
      <section class="modal-card-body">
        A törlés gombra kattintva a foglalás törlődik az adatbázisunkból. Az időpont pedig felszabadúl, igy újra foglalhatóvá válik.
      </section>
      <footer class="modal-card-foot">
        <button class="button is-danger" @click="$emit('closeanddelete')">Törlés</button>
        <button class="button is-info" @click="$emit('close')">Vissza</button>
      </footer>
    </div>
  </div>
</template>

<script>
  export default ({
    props:{
      success: Boolean,
      userID: Number,
      resID: Number,
    },
    data() {
      return {
        reservations: [],
        }
      },
      methods:{
        deleteReservation(){
          axios.delete('./deleteReservedHour/' + this.resID)
          .then(response => {
            console.log("foglalas orak torolve")
            //this.reservations = [];
            //this.getReservations(this.userID);
          }).catch(function (error) {
                console.log(error);
              });
          this.$emit('deleteReservation');
        }
      }
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
</style>